<?php

namespace Studies\Architecture;

class Email
{
    private string $address;

    public function __construct(string $address)
    {
        if (filter_var($address, filter: FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException(
                message: "Endereço de e-mail inválido"
            );
        }

        $this->address = $address;
    }

    public function __toString(): string
    {
        return $this->address;
    }
}