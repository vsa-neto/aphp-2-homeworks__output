<?php

declare(strict_types=1);

interface WebinarSpeakerInterface
{
    public function getWebinar(): string;
    public function setWebinar(string $webinarTheme): void;
}
