<?php

namespace App;

use Lunatic\Http\Response;

/**
 * @LunaticController
 */
class CongratulationsController {
    /**
     * @LunaticMethod({
     *  "method": "GET",
     *  "uri": "/congratulations"
     * })
     */
    public function congratulations(): Response {
        return new Response("Congratulations !");
    }
}