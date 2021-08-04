<?php

namespace Studies\Architecture\Domain\Student;

interface PasswordCipher
{
    public function cipher(string  $password): string;
    public function verify(string $text, string $password): bool;
}