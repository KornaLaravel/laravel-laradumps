<?php

namespace LaraDumps\LaraDumps\Observers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use LaraDumps\LaraDumps\Actions\Trace;
use LaraDumps\LaraDumps\LaraDumps;
use LaraDumps\LaraDumps\Payloads\QueriesPayload;

class QueryObserver
{
    private bool $enabled = false;

    private ?string $label = null;

    private array $trace = [];

    public function register(): void
    {
        DB::listen(function (QueryExecuted $query) {
            if (!$this->isEnabled()) {
                return;
            }

            $sqlQuery = str_replace(['?'], ['\'%s\''], $query->sql);
            $sqlQuery = vsprintf($sqlQuery, $query->bindings);

            if (str_contains($sqlQuery, 'telescope')) {
                return;
            }

            $queries = [
                'sql'            => $sqlQuery,
                'time'           => $query->time,
                'database'       => $query->connection->getDatabaseName(),
                'connectionName' => $query->connectionName,
                'query'          => $query,
            ];

            $dumps = new LaraDumps(trace: $this->trace);

            $dumps->send(new QueriesPayload($queries));

            if ($this->label) {
                $dumps->label($this->label);
            }

            $dumps->toScreen('Queries');
        });
    }

    public function enable(string $label = null): void
    {
        $this->label = $label;

        DB::enableQueryLog();

        $this->enabled    = true;
    }

    public function disable(): void
    {
        DB::disableQueryLog();

        $this->enabled    = false;
    }

    public function setTrace(array $trace): array
    {
        return $this->trace = $trace;
    }

    public function isEnabled(): bool
    {
        $this->trace   = Trace::findSource()->toArray();

        if (!boolval(config('laradumps.send_queries'))) {
            return $this->enabled;
        }

        return boolval(config('laradumps.send_queries'));
    }
}
