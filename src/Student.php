<?php

namespace Studies\Architecture;

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
}