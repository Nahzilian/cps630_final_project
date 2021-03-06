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

    public function getUser($user){
      $sql = "SELECT * FROM CUSTOMER WHERE CUSTOMER_USERNAME='$user';";
      $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
      return $query;
    }

    public function check_user($username){
      $user = $this->conn->real_escape_string($username);
      $sql = sprintf("SELECT CUSTOMER_ID, CUSTOMER_USERNAME, CUSTOMER_PASSWORD FROM CUSTOMER WHERE CUSTOMER_USERNAME = '%s'", $user);
      $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
      return $query;
    }

    public function insert($fields){
      list($username, $password, $fname, $lname, $address, $city, $phone, $email, $confirm_password) = $fields['form_content'];
      list($user_err, $pass_err, $confirm_err) = $fields['form_err_main'];
      list($fname_err, $lname_err, $address_err, $city_err, $phone_err, $email_err) = $fields['form_err_secondary'];
      $name = $fname." ".$lname;
      $password = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO CUSTOMER (CUSTOMER_NAME, CUSTOMER_TEL, CUSTOMER_EMAIL, CUSTOMER_ADDRESS,CUSTOMER_CITY_CODE,CUSTOMER_USERNAME,CUSTOMER_PASSWORD, CUSTOMER_BALANCE, CUSTOMER_ADMIN) VALUES ('$name', '$phone' , '$email', '$address', '$city', '$username', '$password', 0, false);";
      // echo $sql;
      $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
      return $query;
    }

    public function deleteCustomer ($id) {
      $sql = "DELETE FROM CUSTOMER WHERE CUSTOMER_ID = '$id'";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function updateById($id, $username, $fname, $address, $city, $phone, $email, $balance, $admin) {
      $sql = "UPDATE CUSTOMER
      SET CUSTOMER_NAME='$fname', CUSTOMER_TEL='$phone', CUSTOMER_EMAIL='$email', CUSTOMER_ADDRESS='$address', CUSTOMER_CITY_CODE='$city', CUSTOMER_USERNAME='$username', CUSTOMER_BALANCE='$balance', CUSTOMER_ADMIN=$admin
      WHERE CUSTOMER_ID = '$id';";
      echo $sql;
      $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
      return $query;
    }

    public function getSpecificCustomer ($id){
      $sql = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID='$id';";
      $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
      return $query;
    }
}
?>
