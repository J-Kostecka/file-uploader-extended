<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/db/db.php";

abstract class abstractModel
{

    protected $db = null;

    public function __construct()
    {
        $this->db = new db();
    }

    abstract function getRecords();

    abstract function insertRows($data);

}