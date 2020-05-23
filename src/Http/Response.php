<?php

namespace Lunatic\Http;

class Response {
    private string $body;
    private int $code;
    
    function __construct(string $body, int $code = 200){
        $this->body = $body;
        $this->code = $code;
    }

    public function getBody(): string {
        return $this->body;
    }

    public function getCode(): int {
        return $this->code;
    }
}