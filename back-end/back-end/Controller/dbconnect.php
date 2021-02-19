<?php
class dbconnect{
    public function connect(){
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'P2S_WEB_APP';
        $connection = mysqli_connect($host,$user,$pass,$db);
        return $connection;
     }
}
