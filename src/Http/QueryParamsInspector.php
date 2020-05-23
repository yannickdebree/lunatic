<?php

namespace Lunatic\Http;

class QueryParamsInspector {
    private string $uri;
    private Array $queryParams = [];

    function __construct(string $uriToInspect) {
        preg_match('/\?.*/', $uriToInspect , $queryParamsMatches);

        if(count($queryParamsMatches) > 0){
            $queryParamsMatch = $queryParamsMatches[0];
            
            $this->uri = str_replace($queryParamsMatch, '', $_SERVER['REQUEST_URI']);

            preg_match_all('/[?&][a-zA-Z0-9]*=[a-zA-Z0-9]*/', $queryParamsMatch, $queryParamsTuples);

            foreach($queryParamsTuples[0] as $tuple){
                list($key, $value) = preg_split('/=/', str_replace(['?', '&'], '', $tuple));
                $queryParams[$key] = $value;
            }
        } else {
            $this->uri = $uriToInspect;
        }
    }

    public function getUri(): string {
        return $this->uri;
    }

    public function getQueryParams(): Array {
        return $this->queryParams;
    }
}