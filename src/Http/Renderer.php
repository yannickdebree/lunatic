<?php

namespace Lunatic\Http;

class Renderer {
    function __construct(Response $response) {
        http_response_code($response->getCode());
        echo $response->getBody();
    }
}