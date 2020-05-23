<?php

require "../vendor/autoload.php";

use Lunatic\Core\Kernel;
use Lunatic\Http\Request;
use Lunatic\Http\Router;

try{
    // TODO : find a way to remove this ugly configuration
    $srcPath = realpath(__DIR__."/../app");
    $kernel = Kernel::createInstance($srcPath);
    $request = Request::createFromGlobals();
    
    $router = new Router($kernel);
    $router->matchRequest($request);
} catch(Exception $e){
    echo $e;
}
