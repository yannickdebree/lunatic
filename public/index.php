<?php

require "../vendor/autoload.php";

use Lunatic\Core\Executable;

$srcPath = realpath(__DIR__."/../app");
$exectuable = new Executable($srcPath);
$exectuable->run();