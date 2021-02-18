<?php
class dbconnect{
    public function connect(){
        $host = '127.0.0.1';
        $user = 'root';
        $pass = '';
        $db = 'P2S_WEB_APP';
        $connection = mysqli_connect($host,$user,$pass,$db); 
        return $connection;
     }
}