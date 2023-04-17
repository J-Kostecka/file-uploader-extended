<?php
declare(strict_types=1);
require_once "ParserInterface.php";

class Json implements ParserInterface
{
    public function parse(string $file): array {
        return json_decode($file, true);
    }
}