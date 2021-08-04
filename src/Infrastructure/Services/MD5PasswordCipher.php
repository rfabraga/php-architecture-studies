<?php

use Studies\Architecture\Domain\Student\PasswordCipher;

class MD5PasswordCipher implements PasswordCipher
{
    public function cipher(string $password): string
    {
        return md5($password);
    }

    public function verify(string $text, string $password): bool
    {
        return md5($text) === $password;
    }
}