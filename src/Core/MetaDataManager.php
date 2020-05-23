<?php

namespace Lunatic\Core;

class MetaDataManager {
    private Kernel $kernel;

    function __construct(Kernel $kernel){
        $this->kernel = $kernel;
    }

    public function getMetaDataForFiles(Array $filesPaths): Array {
        $metaDataList = [];

        foreach($filesPaths as $filesPath){
            $controllerName = str_replace([$this->kernel->getSrcPath().'/', '.php'], '', $filesPath);
            $reflector = new \ReflectionClass('App\\'.$controllerName);
            
            foreach ($reflector->getMethods() as $method){
                $metaData = MetaData::fromAnnotation($method->getDocComment());
                $origin = new MetaDataOrigin($reflector->getName(), $method->getName());
                
                $metaData->setOrigin($origin);
                $metaDataList[] = $metaData;
            }
        }
        
        return $metaDataList;
    }
}