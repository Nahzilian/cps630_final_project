<?php
class dbconnect{
    public function connect(){
        $host = 'localhost';
        $user = 'suren';
        $pass = 'root';
        $db = 'P2S_WEB_APP';
        $connection = mysqli_connect($host,$user,$pass,$db);
        return $connection;
     }
}
