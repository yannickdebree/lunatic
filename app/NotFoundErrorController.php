<?php

namespace App;

use Lunatic\Http\Response;

/**
 * @LunaticController
 */
class NotFoundErrorController {
    /**
     * @LunaticMethod({
     *  "code": 404,
     *  "documentation": false
     * })
     */
    public function notFound(): Response {
        return new Response("Customized 404 page error.", 404);
    }
}