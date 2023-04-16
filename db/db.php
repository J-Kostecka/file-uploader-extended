<?php

class db
{

    private $_username = "root";
    private $_password = "123";

    public $conn = null;

    public function __construct()
    {
        $conn = new PDO("mysql:host=localhost;dbname=test", $this->_username, $this->_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->conn = $conn;
    }
}