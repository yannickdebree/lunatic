<?php

namespace Lunatic\Core;

class Kernel {
    private string $srcPath;
    private string $srcNamespace;
    
    function __construct(string $srcPath, string $srcNamespace){
        $this->srcPath = $srcPath;
        $this->srcNamespace = $srcNamespace;
    }

    public function getSrcPath(): string {
        return $this->srcPath;
    }

    public function getSrcNamespace(): string {
        return $this->srcNamespace;
    }
}