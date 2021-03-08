<?php
Class Car
{
    private $conn;
    public function __construct($dbconn)
    {   
        $this->conn = $dbconn->connect();
    }

    public function getAll(){
        $sql = "SELECT * FROM CAR;";
        $query = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $query;
    }

    public function getSpecificCar($id){
        $sql = "SELECT * FROM CAR WHERE CAR_ID in ($id)";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function getAvailableCar() {
        $sql = "SELECT * FROM CAR WHERE AVAILABILITY_CODE = 'true'";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function deleteCar($id) {
        $sql = "DELETE FROM CAR WHERE CAR_ID = $id;";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function insertCar($model, $code) {
        $sql = "INSERT INTO CAR (CAR_MODEL, CAR_CODE, AVAILABILITY_CODE) values ('$model', '$code', 'true');";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }

    public function updateById($id, $model, $code, $avail) {
        $sql = "UPDATE CAR
        SET CAR_MODEL = '$model', CAR_CODE= '$code', AVAILABILITY_CODE='$avail'
        WHERE CAR_ID = '$id';";
        $query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
        return $query;
    }
}
?>