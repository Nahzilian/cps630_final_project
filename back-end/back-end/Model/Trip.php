<?php
Class Trip
{
    private $conn;
    public function __construct($dbconn)
    {   
        $this->conn = $dbconn->connect();
    }

    public function getAll(){
        $sql = "SELECT * FROM TRIP;";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function getTripByCarID($id){
        $sql = "SELECT * FROM TRIP WHERE CAR_ID='$id';";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function getTripByID($id){
        $sql = "SELECT * FROM TRIP WHERE TRIP_ID='$id';";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function deleteTrip($id) {
        $sql = "DELETE FROM TRIP WHERE TRIP_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function deleteTripWithCarID($id) {
        $sql = "DELETE FROM TRIP WHERE CAR_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function insertTrip($destin, $source, $distamce, $car_id,$price) {
        $sql = "INSERT INTO TRIP (DESTINATION_CODE, SOURCE_CODE, DISTANCE, CAR_ID, PRICE) values ('$destin', '$source', '$distamce', '$car_id','$price');";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function updateById($id, $destin, $source, $price, $car_id, $distance) {
        $sql = "UPDATE TRIP
        SET DESTINATION_CODE='$destin', SOURCE_CODE='$source', DISTANCE='$distance', CAR_ID='$car_id', PRICE='$price'
        WHERE TRIP_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

}
?>