<?php
include '../Controller/dbconnect.php';
Class Customer
{
    public $string;
    private $conn;
    public function __construct()
    {   
        $dbcon = new dbconnect();
        $this->conn = $dbcon->connect();
    }

    public function getAll(){
        $sql = "SELECT * FROM CUSTOMER;";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }
}
?>