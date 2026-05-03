<?php

declare(strict_types=1);

class Director
extends AbstractEmployee
implements LeadInterface
{
    protected string $character = 'kind'; // (kind) добрый или (wicked) злой
    protected string $exeption = '';

    public function setСharacter($character): void
    {
        if (!is_string($character)) {
            throw new Exception('В объявлении метода "setСharacter()" непрвильный тип данных');
        }

        $this->character = $character;
    }

    public function getСharacter(): string
    {
        if ($this->character === 'kind') {
            return ', может повысить ЗП :)';
        } else if ($this->character === 'wicked') {
            return ', может уволить в любой момент :(';
        } else {
            return '';
        }
    }


    public function getFullName(): string
    {
        return "$this->surname $this->name";
    }
    public function manage(): string
    {
        return ", может управлять или руководить";
    }
}
