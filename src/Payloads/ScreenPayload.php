<?php

namespace LaraDumps\LaraDumps\Payloads;

class ScreenPayload extends Payload
{
    public function __construct(
        public string $screenName,
        public bool $classAttr = false,
        public int $raiseIn = 0,
    ) {
    }

    public function type(): string
    {
        return 'screen';
    }

    /** @return array<string|mixed> */
    public function content(): array
    {
        $configFile = include __DIR__ . '/../../config/laradumps.php';

        /** @var array $config */
        $config    = $configFile['screen_btn_colors_map'];
        $classAttr = ($this->classAttr) ? $config[$this->screenName] : $config['default'];

        return [
            'screenName' => $this->screenName,
            'classAttr'  => $classAttr,
            'raiseIn'    => $this->raiseIn,
        ];
    }
}
