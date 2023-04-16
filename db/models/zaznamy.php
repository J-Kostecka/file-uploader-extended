<?php
require_once "abstractModel.php";

class zaznamy extends abstractModel
{

    public function getRecords() {
        return $this->db->conn->query("SELECT * FROM `zaznamy` ORDER BY `date`;")->fetchAll();
    }

    public function insertRows($data)
    {
        $escaping = array_fill(0, sizeof($data), "(?,?,?,?)");
        $sql = "INSERT INTO `zaznamy` (`id`, `jmeno`, `prijmeni`, `date`) VALUES " .  implode(',', $escaping) . " ON DUPLICATE KEY UPDATE `jmeno`=VALUES(`jmeno`), `prijmeni`=VALUES(`prijmeni`), `date`=VALUES(`date`)";
        $stmt = $this->db->conn->prepare($sql);
        $sqlData = [];
        foreach ($data as $row) {
            $sqlData[] = implode(",", $row);
        }

        $stmt->execute(explode(",", implode(",", $sqlData)));
    }
}