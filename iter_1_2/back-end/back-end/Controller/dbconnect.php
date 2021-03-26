<?php
class dbconnect{
    public function connect(){
        $host = '127.0.0.1';
        $user = 'root';
        $pass = 'root';
        $db = 'P2S_WEB_APP';
        $connection = mysqli_connect($host,$user,$pass,$db);

        if ($connection === false) {
          die("ERROR: Could not connect." . mysqli_connect_error());
        }
        return $connection;
     }
}
