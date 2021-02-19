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

    public function writeReview($id, $context, $score){
        $sql = "INSERT INTO PRODUCT_REVIEW (R_CONTEXT, R_SCORE, FLOWER_ID) VALUES ('$context', " . intval($score) ." , $id);";
        echo $sql;
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

}
?>