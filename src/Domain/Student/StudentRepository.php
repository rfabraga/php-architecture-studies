<?php

namespace Studies\Architecture\Domain\Student;

use Studies\Architecture\Domain\CPF;

interface StudentRepository
{
    public function add(Student $student): void;
    public function searchByCpf(CPF $cpf): Student;
    public function searchAll(): array; 
}
