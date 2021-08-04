<?php

use Studies\Architecture\Domain\Student\Student;

interface SendReccomendationEmail
{
    public function sendTo(Student $recommendedStudent): void;
}