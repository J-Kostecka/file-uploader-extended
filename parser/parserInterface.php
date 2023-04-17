<?php
declare(strict_types=1);

interface ParserInterface
{
    public function parse(string $file): array;
}