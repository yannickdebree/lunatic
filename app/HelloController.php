<?php

namespace App;

use Lunatic\Http\Request;
use Lunatic\Http\Response;

/**
 * @LunaticController
 */
class HelloController {
    /**
     * @LunaticMethod({
     *  "method": "GET",
     *  "uri": "/"
     * })
     */
    public function goodMorning(): Response {
        return new Response("Good morning !");
    }

    /**
     * @LunaticMethod({
     *  "method": "GET",
     *  "uri": "/good-bye"
     * })
     */
    public function goodBye(): Response {
        return new Response("Good bye !");
    }
}