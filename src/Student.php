<?php

namespace Studies\Architecture;

class Student
{
    private CPF $cpf;
    private string $name;
    private Email $email;
    private array $phones;
    
    public function addPhone(string $ddd, string $number): void
    {
        $this->phones[] = new Phone($ddd, $number);
    }
}