<?php

namespace Lunatic\Http;

use Lunatic\Core\MetaDataOrigin;

class RequestMatcher {
    private ?MetaDataOrigin $activeControllerOrigin = null;
    private ?MetaDataOrigin $notFoundErrorControllerOrigin = null;

    function __construct(Array $controllersMetadata, Request $request) {
        foreach($controllersMetadata as $metaData){
            $data = $metaData->getData();
            if(
                $data['method'] === $request->getMethod() &&
                $data['uri'] === $request->getUri()
            ){
                $this->activeControllerOrigin = $metaData->getOrigin();
            } else if($data['code'] === 404) {
                $this->notFoundErrorControllerOrigin = $metaData->getOrigin();
            }
        }
    }

    public function getActiveControllerOrigin(): ?MetaDataOrigin {
        return $this->activeControllerOrigin;
    }

    public function getNotFoundErrorControllerOrigin(): ?MetaDataOrigin {
        return $this->notFoundErrorControllerOrigin;
    }
}