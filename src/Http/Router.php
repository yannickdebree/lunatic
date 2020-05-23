<?php

namespace Lunatic\Http;

use Lunatic\Core\Kernel;
use Lunatic\Core\MetaDataManager;
use Lunatic\Core\MetaDataOrigin;

class Router {
    private Request $request;
    private Array $metaData;

    function __construct(Kernel $kernel) {
        // TODO : stock controllers files names in cache.
        // TODO : update line for sub-folders.
        // TODO : filter and get only classes decorated by meta-data called "LunaticController".
        $controllersFilesNames = glob($kernel->getSrcPath()."/*Controller.php");

        // TODO : stock controllers metadata in cache.
        $metaDataManager = new MetaDataManager($kernel);
        $this->metaData = $metaDataManager->getMetaDataForFiles($controllersFilesNames);
    }

    public function matchRequest(Request $request): void {
        $this->request = $request;
        $requestMatcher = new RequestMatcher($this->metaData, $this->request);

        $activeControllerOrigin = $requestMatcher->getActiveControllerOrigin();
        $notFoundErrorControllerOrigin = $requestMatcher->getNotFoundErrorControllerOrigin();

        $renderer = new Renderer();

        if($activeControllerOrigin){
            $renderer->setResponse($this->callControllerMethod($activeControllerOrigin));
        } else {
            if($notFoundErrorControllerOrigin){
                $renderer->setResponse($this->callControllerMethod($notFoundErrorControllerOrigin));
            } else {
                // TODO : implement Lunatic controllers to default views.
                $response = new Response("Not found.", 404);
                $renderer->setResponse($response);
            }
        }
        $renderer->render();
    }

    private function callControllerMethod(MetaDataOrigin $origin): Response {
        $classPath = $origin->getClassPath();
        $method = $origin->getMethod();

        $controller = new $classPath();
        return $controller->{$method}($this->request);
    }
}