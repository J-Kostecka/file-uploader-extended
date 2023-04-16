<?php
require_once "json.php";

class parserMaster
{

    public $supportedFormats = [
        "json" => "application/json"
    ];

    private $parsers = [];

    public function __construct()
    {
        $this->parsers = [
            "json" => new json()
        ];
    }

    public function analyzeAndParse($file, string $fileFormat): array {
        foreach ($this->supportedFormats as $formatName => $format) {
            if ($fileFormat === $format) {
                return $this->parsers[$formatName]->parse($file);
            }
        }

        throw new Exception("Nepodporovaný formát! Podporované formáty: " . implode(", ", array_keys($this->supportedFormats)));
    }
}