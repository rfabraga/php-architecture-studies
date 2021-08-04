<?php

namespace Studies\Architecture\Application\Student;

class EnrollStudentDTO 
{
    public string $studentCPF;
    public string $studentName;
    public string $studentEmail;

    public function __construct(string $studentCPF, string $studentName, string $studentEmail)
    {
        $this->studentCPF = $studentCPF;
        $this->studentName = $studentName;
        $this->studentEmail = $studentEmail;
    }
}