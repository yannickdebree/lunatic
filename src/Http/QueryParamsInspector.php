<?php

namespace Lunatic\Http;

class QueryParamsInspector {
    private string $purgedUri;
    private Array $queryParams = [];

    function __construct(string $uriToInspect) {
        preg_match('/\?.*/', $uriToInspect , $queryParamsMatches);

        if(count($queryParamsMatches) > 0){
            $queryParamsMatch = $queryParamsMatches[0];
            
            $this->purgedUri = str_replace($queryParamsMatch, '', $uriToInspect);

            preg_match_all('/[?&][a-zA-Z0-9]*=[a-zA-Z0-9]*/', $queryParamsMatch, $queryParamsTuples);

            foreach($queryParamsTuples[0] as $tuple){
                list($key, $value) = preg_split('/=/', str_replace(['?', '&'], '', $tuple));
                $this->queryParams[$key] = $value;
            }
        } else {
            $this->purgedUri = $uriToInspect;
        }
    }

    public function getPurgedUri(): string {
        return $this->purgedUri;
    }

    public function getQueryParams(): Array {
        return $this->queryParams;
    }
}