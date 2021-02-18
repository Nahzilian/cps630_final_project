<?php
Class DriverReview
{
    private $conn;
    public function __construct($dbconn)
    {   
        $this->conn = $dbconn->connect();
    }

    public function getReviewOn($id){
        $sql = "SELECT * FROM DRIVER_REVIEW WHERE CAR_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }
}
?>