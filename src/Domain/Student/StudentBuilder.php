<?php

namespace Studies\Architecture\Domain\Student;

use Studies\Architecture\CPF;
use Studies\Architecture\Email;

class StudentBuilder
{
    private Student $student;
    
    public function withCpfEmailAndName(string $cpf, string $email, string $name)
    {
        $this->student = new Student(new CPF($cpf), $name, new Email($email));
        return $this;
    }

    public function sddPhone(string $ddd, string $number)
    {
        $this->student->addPhone($ddd, $number);
        return $this;
    }

    public function student(): Student
    {
        return $this->student;
    }
}