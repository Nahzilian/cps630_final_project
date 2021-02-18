<?php
Class ProductReview
{
    private $conn;
    public function __construct($dbconn)
    {   
        $this->conn = $dbconn->connect();
    }

    public function getReviewOn($id){
        $sql = "SELECT * FROM PRODUCT_REVIEW WHERE FLOWER_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }
}
?>