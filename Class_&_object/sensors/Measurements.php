<?php

class Measurements
{
    public float $value;
    public string $date;
    
    public function __construct(float $value, string $date)
    {
       $this->value = $value;
       $this->date = $date;
    }
}