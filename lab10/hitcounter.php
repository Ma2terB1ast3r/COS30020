<?php
include('config.php');
class HitCounter {
    private $conn;
    private $tableName;

    public function __construct($host, $username, $userpassword, $dbname, $tablename) {
        $this->tableName = $tablename;
        $this->conn = new mysqli($host, $username, $userpassword, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getHits() {
        $sql = "SELECT hits FROM $this->tableName";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['hits'];
        } else {
            return 0;
        }
    }

    public function setHits() {
        $currentHits = $this->getHits();
        $newHits = $currentHits + 1;
        $sql = "UPDATE $this->tableName SET hits=$newHits";

        if ($this->conn->query($sql) === TRUE) {
            return $newHits;
        } else {
            return "Error updating record: " . $this->conn->error;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }

    public function startOver() {
        $sql = "UPDATE $this->tableName SET hits=0";

        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return "Error updating record: " . $this->conn->error;
        }
    }
}
?>