<?php
Class DriverReview
{
    private $conn;
    public function __construct($dbconn)
    {   
        $this->conn = $dbconn->connect();
    }

    public function getAll(){
        $sql = "SELECT * FROM DRIVER_REVIEW;";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function getReviewOn($id){
        $sql = "SELECT * FROM DRIVER_REVIEW WHERE CAR_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function getReviewById($id){
        $sql = "SELECT * FROM DRIVER_REVIEW WHERE REVIEW_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function writeReview($id, $context, $score){
        $sql = "INSERT INTO DRIVER_REVIEW (R_CONTEXT, R_SCORE, CAR_ID) VALUES ('$context', $score , $id);";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function deleteDReviewByCarID($id) {
        $sql = "DELETE FROM DRIVER_REVIEW WHERE CAR_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function updateById($id, $context, $total_price, $car_id) {
        $sql = "UPDATE DRIVER_REVIEW
        SET R_CONTEXT='$context', R_SCORE='$total_price', CAR_ID='$car_id'
        WHERE REVIEW_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }
}
?>