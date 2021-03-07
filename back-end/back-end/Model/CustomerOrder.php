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

    public function addNewOrder($id, $date, $total, $payment, $trip_id, $flower_id) {
        $sql = "INSERT INTO CUSTOMER_ORDER (DATE_DONE, TOTAL_PRICE, PAYMENT_CODE, CUSTOMER_ID, TRIP_ID, FLOWER_ID) values ($date, $total, $payment, $id, $flower_id, $trip_id);";
        $query = $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        if ($query) echo 'You have successfully placed an order';
        else echo 'Order failed, try again!';
    }

    public function deleteTripWithTripID($id) {
        $sql = "DELETE FROM TRIP WHERE CAR_ID = $id;";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function deleteCustomerOrder($id) {
        $sql = "DELETE FROM TRIP WHERE ORDER_ID = $id;";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }
}
?>