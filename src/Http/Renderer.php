<?php

namespace Lunatic\Http;

class Renderer {
    private Response $response;
    
    function __construct(Response $response = null) {
        if(isset($response)){
            $this->setResponse($response);
        }
    }

    public function setResponse(Response $response): void {
        $this->response = $response;
    }

    public function render(): void {
        http_response_code($this->response->getCode());
        echo $this->response->getBody();
    }
}