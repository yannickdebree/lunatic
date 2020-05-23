<?php

namespace Lunatic\Core;

final class Kernel {
    private string $rootPath;
    private string $srcPath;
    protected static $instance;
    
    private function __construct(string $srcPath){
        $this->srcPath = $srcPath;
    }

    public static function createInstance(string $srcPath): Kernel {
        static::$instance = new Kernel($srcPath);
        return static::$instance;
    }

    public static function getInstance(): Kernel {
        if (!isset(static::$instance)) {
            // TODO : manage better exceptions.
            throw new \Exception("Kernel must be created before getting.");
        }
        
        return static::$instance;
    }

    public function getSrcPath(): string {
        return $this->srcPath;
    }
}