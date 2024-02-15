<?php

namespace LaraDumps\LaraDumps\Observers;

use Illuminate\Queue\Events\{JobFailed, JobProcessed, JobProcessing, JobQueued};
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Event;
use LaraDumps\LaraDumps\Actions\Config;
use LaraDumps\LaraDumps\Observers\Concerns\SendPayload;
use LaraDumps\LaraDumps\Observers\Contracts\GeneratePayload;
use LaraDumps\LaraDumpsCore\Concerns\Traceable;
use LaraDumps\LaraDumpsCore\Contracts\TraceableContract;
use LaraDumps\LaraDumpsCore\LaraDumps;
use LaraDumps\LaraDumpsCore\Payloads\{DumpPayload, Payload};
use LaraDumps\LaraDumpsCore\Support\Dumper;

class JobsObserver implements TraceableContract, GeneratePayload
{
    use Traceable;
    use SendPayload;

    private bool $enabled = false;

    private ?string $label = null;

    public function register(): void
    {
        Event::listen([
            JobQueued::class,
            JobProcessing::class,
            JobProcessed::class,
            JobFailed::class,
        ], function (object $event) {
            if (!$this->isEnabled()) {
                return;
            }

            $this->trace = array_slice($this->findSource(), 0, 5)[0] ?? [];

            $this->sendPayload(
                $this->generatePayload($event),
                get_class($event)
            );
        });
    }

    public function getLabelClassNameBased($className): string
    {
        return match ($className) {
            JobQueued::class     => 'Job - Queued',
            JobProcessing::class => 'Job - Processing',
            JobProcessed::class  => 'Job - Processed',
            JobFailed::class     => 'Job - Failed',
        };
    }

    public function enable(string $label = null): void
    {
        if ($label) {
            $this->label = $label;
        }

        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }

    public function isEnabled(): bool
    {
        if (!boolval(Config::get('send_jobs'))) {
            return $this->enabled;
        }

        return boolval(Config::get('send_jobs'));
    }

    public function generatePayload(object $event): Payload
    {
        [$pre, $id] = Dumper::dump(
            /* @phpstan-ignore-next-line */
            $event->job instanceof Job && $event->job->payload()
                ? unserialize($event->job->payload()['data']['command'], ['allowed_classes' => true])
                : $event->job
        );

        $payload = new DumpPayload($pre);
        $payload->setDumpId($id);

        return $payload;
    }
}
