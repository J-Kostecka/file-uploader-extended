<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/db/db.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/db/models/zaznamy.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/parser/parserMaster.php";

session_start();

new fileUpload();

class fileUpload
{

    private $_db = null;

    public function __construct() {
        $this->_db = new db();

        $this->uploadData();
    }

    public function uploadData() {
        $message = "";
        $error = "";
        try {
            if (isset($_FILES['uploadedFile'])) {
                if (!$_FILES['uploadedFile']['name']) {
                    throw new Exception("Nebyl nahrán žádný soubor!");
                }

                $parserMaster = new parserMaster();
                $parsedFile = $parserMaster->analyzeAndParse(file_get_contents($_FILES['uploadedFile']['tmp_name']), $_FILES['uploadedFile']['type']);

                $model = new zaznamy();
                $model->insertRows($parsedFile);

                $message = "Bylo nahráno všech " . sizeof($parsedFile) . " záznamů";
            }
        }
        catch (Exception $exception) {
            $error = "Vyskytla se chyba: " . $exception->getMessage();
        }


        $_SESSION['message'] = $message;
        $_SESSION['error'] = $error;
        header('Location: ../index.php');
    }
}

