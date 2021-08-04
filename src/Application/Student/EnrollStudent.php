<?php

namespace Studies\Architecture\Application\Student;

use Studies\Architecture\Domain\Student\StudentRepository;
use Studies\Architecture\Domain\Student\Student;

class EnrollStudent
{
    private StudentRepository $studentRepo;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepo = $studentRepo;
    }

    public function execute(EnrollStudentDTO $studentData): void
    {
        $student = Student::withCpfNameAndEmail(
            $studentData->studentCPF,
            $studentData->studentName,
            $studentData->studentEmail
        );

        $this->studentRepo->add($student);
    }
}