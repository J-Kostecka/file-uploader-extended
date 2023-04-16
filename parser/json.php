<?php
require_once "parserInterface.php";

class json implements parserInterface
{

    public function parse($file) {
        return json_decode($file, true);
    }
}