<?php

namespace Studies\Architecture;

use Stringable;
class CPF implements Stringable
{
    private string $document;

    public function __construct(string $document)
    {
        $this->setDocument($document);        
    }
    
    private function setDocument(string $document): void
    {
        $options = [
            "options" => [
                "regexp" => "/\d{3}\.\d{3}\.\d{3}-\d{2}/"
            ]
        ];

        if (filter_var($document, filter: FILTER_VALIDATE_REGEXP, options: $options) === false) {
            throw new \InvalidArgumentException(
                message: "CPF no formato inválido"
            );
        }

        $this->document = $document;
    }

    public function __toString(): string
    {
        return $this->document;
    }
}