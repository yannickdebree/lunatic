<?php

namespace Lunatic\Core;

class MetaDataOrigin {
    private string $classPath;
    private string $method;

    function __construct(string $classPath, string $method){
        $this->classPath = $classPath;
        $this->method = $method;
    }

    public function getClassPath(): string {
        return $this->classPath;
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function toString(): string {
        return $this->classPath.":".$this->method;
    }
}