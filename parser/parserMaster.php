<?php
declare(strict_types=1);
require_once "Json.php";

class ParserMaster
{
    public $supportedFormats = [
        "json" => "application/json"
    ];

    private $parsers = [];

    public function __construct() {
        $this->parsers = [
            "json" => new Json()
        ];
    }

    public function parseByFormat(string $file, string $fileFormat): array {
        foreach ($this->supportedFormats as $formatName => $format) {
            if ($fileFormat === $format) {
                return $this->parsers[$formatName]->parse($file);
            }
        }

        throw new Exception("Nepodporovaný formát! Podporované formáty: " . implode(", ", array_keys($this->supportedFormats)));
    }
}