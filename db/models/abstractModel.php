<?php
declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT'] . "/db/Db.php";

abstract class AbstractModel
{
    protected $db = null;

    public function __construct() {
        $this->db = new Db();
    }

    abstract public function getRecords(): array;

    abstract public function insertRows(array $data): void;

}