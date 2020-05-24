<?php

namespace Lunatic\Http;

use Lunatic\Core\Kernel;
use Lunatic\Core\MetaDataManager;
use Lunatic\Core\MetaDataOrigin;

class Router {
    private Request $request;
    private Array $controllersMetaData;

    function __construct(Kernel $kernel) {
        // TODO : stock controllers files names in cache.
        // TODO : update line for sub-folders.
        // TODO : filter and get only classes decorated by meta-data called "LunaticController" || "LunaticMethod".
        $controllersFilesNames = glob($kernel->getSrcPath()."/*Controller.php");

        // TODO : stock controllers metadata in cache.
        $metaDataManager = new MetaDataManager($kernel);
        $this->controllersMetaData = $metaDataManager->getMetaDataForFiles($controllersFilesNames);
    }

    public function matchRequest(Request $request): Renderer {
        $this->request = $request;
        $requestMatcher = new RequestMatcher($this->controllersMetaData, $this->request);

        $activeControllerOrigin = $requestMatcher->getActiveControllerOrigin();
        $notFoundErrorControllerOrigin = $requestMatcher->getNotFoundErrorControllerOrigin();

        if($activeControllerOrigin){
            $response = $this->callControllerMethod($activeControllerOrigin);
        } else {
            if($notFoundErrorControllerOrigin){
                $response = $this->callControllerMethod($notFoundErrorControllerOrigin);
            } else {
                // TODO : implement Lunatic controllers to default views.
                $response = new Response("Not found.", 404);
            }
        }

        return new Renderer($response);
    }

    private function callControllerMethod(MetaDataOrigin $origin): Response {
        $classPath = $origin->getClassPath();
        $method = $origin->getMethod();

        $controller = new $classPath();
        return $controller->{$method}($this->request);
    }
}