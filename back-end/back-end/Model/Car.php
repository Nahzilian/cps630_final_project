<?php
Class Car
{
    private $conn;
    public function __construct($dbconn)
    {   
        $this->conn = $dbconn->connect();
    }

    public function getAll(){
        $sql = "SELECT * FROM CAR;";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function getSpecificCar($id){
        $sql = "SELECT * FROM CAR WHERE CAR_ID = '$id'";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }


}
?>