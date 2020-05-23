<?php

namespace Lunatic\Core;

class MetaData {
    private string $name;
    private Array $data = [];
    private MetaDataOrigin $origin;

    function __construct(string $name, Array $data){
        $this->name = $name;
        $this->data = $data;
    }

    static public function fromAnnotation(string $annotation): MetaData {
        $trimedAnnotation = str_replace(['/**', '*', '*/'], '', $annotation);
        // TODO : optimize regex matching function.
        preg_match('/@[a-zA-Z]*/', $trimedAnnotation, $nameMatches);

        // TODO : implement match error exception.
        $name = str_replace('@', '', $nameMatches[0]);
        $dataMatch = str_replace([$nameMatches[0], '(', ')', ' /'], '', $trimedAnnotation);

        // TODO : implement match and parsing error exception.
        $data = json_decode($dataMatch, true);
        return new MetaData($name, $data);
    }

    public function getName(): string {
        return $this->name;
    }

    public function getData(): Array {
        return $this->data;
    }

    public function getOrigin(): MetaDataOrigin {
        return $this->origin;
    }

    public function setOrigin(MetaDataOrigin $origin): void {
        $this->origin = $origin;
    }
}