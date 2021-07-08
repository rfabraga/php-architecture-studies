<?php

namespace Studies\Architecture\Domain\Student;

use Studies\Architecture\Domain\CPF;
use Studies\Architecture\Domain\Email;

class Student
{
    private CPF $cpf;
    private string $name;
    private Email $email;
    private array $phones;

    public static function withCpfNameAndEmail(string $cpf, string $name, string $email)
    {
        return new Student(new CPF($cpf), $name, new Email($email));
    }
    
    public function addPhone(string $ddd, string $number): self
    {
        $this->phones[] = new Phone($ddd, $number);
        return $this;
    }

    public function cpf(): string
    {
        return $this->cpf;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phones(): array
    {
        return $this->phones;
    }
}