<?php

namespace Studies\Architecture\Domain\Student;

use Studies\Architecture\Domain\CPF;

class StudentNotFoundException extends \DomainException
{
    public function __construct(CPF $cpf)
    {
        parent::__construct("Student with {$cpf} not found.");
    }
}