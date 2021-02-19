<?php
Class Customer
{
    private $conn;
    public function __construct($dbconn)
    {
        $this->conn = $dbconn->connect();
    }

    public function getAll(){
        $sql = "SELECT * FROM CUSTOMER;";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function check_user($username){
      $user = $this->conn->real_escape_string($username);
      $sql = sprintf("SELECT CUSTOMER_ID, CUSTOMER_USERNAME, CUSTOMER_PASSWORD FROM CUSTOMER WHERE CUSTOMER_USERNAME = '%s'", $user);
      $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
      return $query;
    }
}
?>
