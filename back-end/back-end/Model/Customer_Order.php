<?php
Class CustomerOrder
{
    public $string;
    private $conn;
    public function __construct($dbconn)
    {   
        $this->conn = $dbconn->connect();
    }

    public function getUserOrderHistory($id){
        $sql = "SELECT * FROM CUSTOMER_ORDER WHERE CUSTOMER_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }
}
?>