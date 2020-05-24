<?php

namespace Lunatic\Http;

class Request {
    private string $method;
    private string $uri;
    private Array $queryParams;

    function __construct(string $method, string $uri, Array $queryParams = []) {
        $this->method = $method;
        $this->uri = $uri;
        $this->queryParams = $queryParams;
    }

    static public function createFromGlobals(): Request {
        $method = $_SERVER['REQUEST_METHOD'];

        $queryParamsInspector = new QueryParamsInspector($_SERVER['REQUEST_URI']);
        $uri = $queryParamsInspector->getPurgedUri();
        $queryParams = $queryParamsInspector->getQueryParams();

        return new Request($method, $uri, $queryParams);
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function getUri(): string {
        return $this->uri;
    }

    public function getQueryParams(): Array {
        return $this->queryParams;
    }
}