<?php

use Studies\Architecture\Domain\Student\PasswordCipher;

class PHPPasswordCipher implements PasswordCipher
{
    public function cipher(string $password): string
    {
        return password_hash($password, algo: PASSWORD_ARGON2ID);    
    }

    public function verify(string $text, string $password): bool
    {
        return password_verify($text, $password);
    }
}