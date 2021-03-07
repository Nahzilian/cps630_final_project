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

    public function writeReview($id, $context, $score){
        $sql = "INSERT INTO DRIVER_REVIEW (R_CONTEXT, R_SCORE, CAR_ID) VALUES ('$context', $score , $id);";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }
}
?>