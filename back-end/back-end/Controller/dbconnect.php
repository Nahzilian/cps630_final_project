<?php
class dbconnect{
    public function connect(){
        $host = '127.0.0.1';
        $user = 'root';
        $pass = '';
        $db = 'p2s_web_app';
        $connection = mysqli_connect($host,$user,$pass,$db); 
        return $connection;
     }
}