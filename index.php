<?php
declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT'] . "/db/models/Zaznamy.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/parser/ParserMaster.php";

session_start();

$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";

$zaznamy = new Zaznamy();
$parser = new ParserMaster();

session_destroy();
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Data uploader</title>

        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div id="root">
            <div class="form-wrapper">
                <?php if ($message) : ?>
                    <div id="successbox"><?= $message ?></div>
                <?php endif; ?>
                <?php if ($error) : ?>
                    <div id="errorbox"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" action="uploader/FileUpload.php">
                    <h3>Nahrát soubor</h3>
                    <label for="uploadedFile">Vybrat soubor</label>
                    <input id="uploadedFile" name="uploadedFile" type="file" accept="<?= htmlspecialchars(implode(",", $parser->supportedFormats)) ?>">
                    <br>
                    <input type="submit">
                </form>
            </div>
            <div class="data-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th><th>Jméno</th><th>Příjmení</th><th>Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $records = $zaznamy->getRecords();

                        if (empty($records)) {
                            echo "<tr><td colspan='4' style='text-align: center'>Nebyly zatím nahrány žádné záznamy.</td></tr>";
                        }
                        else {
                            foreach ($records as $record) {
                                echo "
                                <tr>
                                    <td>" . htmlspecialchars($record['id']) . "</td>
                                    <td>" . htmlspecialchars($record['jmeno']) . "</td>
                                    <td>" . htmlspecialchars($record['prijmeni']) . "</td>
                                    <td>" . htmlspecialchars($record['date']) . "</td>
                                </tr>
                                ";
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

    <script src="js/index.js"></script>
    </body>
</html>