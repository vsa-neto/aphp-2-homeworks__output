<?php

declare(strict_types=1);

class Manager
extends AbstractEmployee
implements LeadInterface, WebinarSpeakerInterface
{
    protected $webinar = null;

    public function getFullName(): string
    {
        return "$this->surname $this->name";
    }

    public function manage(): string
    {
        return ", может управлять или руководить";
    }

    public function setWebinar(string $webinarTheme): void
    {
        $this->webinar = $webinarTheme;
    }

    public function getWebinar(): string
    {
        if ($this->webinar === NULL) {
            return "";
        } else {
            return ", может проводить вебинары по теме: $this->webinar";
        }
    }
}
