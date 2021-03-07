<?php
  class Order{
    private $conn;
    public function __construct($dbconn)
    {
        $this->conn = $dbconn->connect();
    }


    public function getAll(){
        $sql = "SELECT * FROM CUSTOMER_ORDER;";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function search($search, $id){
      $sql = "SELECT * FROM CUSTOMER_ORDER INNER JOIN FLOWER on CUSTOMER_ORDER.FLOWER_ID = FLOWER.FLOWER_ID WHERE CUSTOMER_ID=$id AND FLOWER.STORE_CODE LIKE '$search%';";
      $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
      return $query;
    }

  }
?>
