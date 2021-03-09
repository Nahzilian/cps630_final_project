<?php
Class CustomerOrder
{
    private $conn;
    public function __construct($dbconn)
    {   
        $this->conn = $dbconn->connect();
    }

    public function getAll() {
        $sql = "SELECT * FROM CUSTOMER_ORDER;";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function getUserOrderHistory($id){
        $sql = "SELECT * FROM CUSTOMER_ORDER WHERE CUSTOMER_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function getCustomerOrderById($id){
        $sql = "SELECT * FROM CUSTOMER_ORDER WHERE ORDER_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function addNewOrder($id, $date, $total, $payment, $trip_id, $flower_id) {
        $sql = "INSERT INTO CUSTOMER_ORDER (DATE_DONE, TOTAL_PRICE, PAYMENT_CODE, CUSTOMER_ID, TRIP_ID, FLOWER_ID) values ($date, $total, $payment, $id, $flower_id, $trip_id);";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        if ($query) echo 'You have successfully placed an order';
        else echo 'Order failed, try again!';
    }

    public function deleteCustomerOrderByTripID($id) {
        $sql = "DELETE FROM CUSTOMER_ORDER WHERE TRIP_ID = '$id'";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function deleteCustomerOrderByCustomerID($id) {
        $sql = "DELETE FROM CUSTOMER_ORDER WHERE CUSTOMER_ID = '$id'";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function deleteCustomerOrderByFlowerID($id) {
        $sql = "DELETE FROM CUSTOMER_ORDER WHERE FLOWER_ID = '$id'";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function deleteCustomerOrder($id) {
        $sql = "DELETE FROM CUSTOMER_ORDER WHERE ORDER_ID = '$id'";
        echo $id;
        echo $sql;
        mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
    }

    public function updateById($id, $date_d, $total_price, $code, $customer_id, $trip_id, $flower_id) {
        $sql = "UPDATE CUSTOMER_ORDER
        SET DATE_DONE= date('$date_d'), TOTAL_PRICE='$total_price', PAYMENT_CODE='$code', CUSTOMER_ID='$customer_id', TRIP_ID='$trip_id', FLOWER_ID='$flower_id'
        WHERE ORDER_ID = '$id';";
        echo $sql;
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }
}
?>