<?php
Class Flower
{
    private $conn;
    public function __construct($dbconn)
    {   
        $this->conn = $dbconn->connect();
    }

    public function getAll(){
        $sql = "SELECT * FROM FLOWER;";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function getSpecificFlower($id){
        $sql = "SELECT * FROM FLOWER WHERE FLOWER_ID in ($id)";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function deleteFlower($id) {
        $sql = "DELETE FROM FLOWER WHERE FLOWER_ID = '$id'";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function insertFlower($code, $price) {
        $sql = "INSERT INTO FLOWER (STORE_CODE, PRICE) values ('$code', '$price');";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }
}
?>