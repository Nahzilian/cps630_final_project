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
}
?>