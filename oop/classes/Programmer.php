<?php

declare(strict_types=1);

class Programmer
extends AbstractEmployee
implements ApplicationCreatorInterface
{
    public function getFullName(): string
    {
        return "$this->surname $this->name";
    }

    public function codeCreator(): string
    {
        return ", может заниматься разработкой приложения";
    }
}
