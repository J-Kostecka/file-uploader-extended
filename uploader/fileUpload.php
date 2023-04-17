<?php
declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT'] . "/db/Db.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/db/models/Zaznamy.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/parser/ParserMaster.php";

session_start();

new FileUpload();

class FileUpload
{
    private $_db = null;

    public function __construct() {
        $this->_db = new Db();

        $this->uploadData();
    }

    public function uploadData(): void {
        $message = "";
        $error = "";
        try {
            if (isset($_FILES['uploadedFile'])) {
                if (!$_FILES['uploadedFile']['name']) {
                    throw new Exception("Nebyl nahrán žádný soubor!");
                }

                $parserMaster = new ParserMaster();
                $parsedFile = $parserMaster->parseByFormat(file_get_contents($_FILES['uploadedFile']['tmp_name']), $_FILES['uploadedFile']['type']);

                $model = new Zaznamy();
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

