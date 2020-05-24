<?php

namespace Lunatic\Core;

use Lunatic\Core\Kernel;
use Lunatic\Http\Request;
use Lunatic\Http\Router;

class Executable {
    private string $srcPath;
    private string $srcNamespace;

    function __construct(string $srcPath, string $srcNamespace = 'App') {
        $this->srcPath = realpath($srcPath);
        $this->srcNamespace = $srcNamespace;
    }

    public function run(): void {
        try{
            $kernel = new Kernel($this->srcPath, $this->srcNamespace);
            $request = Request::createFromGlobals();
            
            $router = new Router($kernel);
            $router->matchRequest($request);
        } catch(Exception $e){
            // TODO : customize error displaying.
            echo $e;
        }
    }
}