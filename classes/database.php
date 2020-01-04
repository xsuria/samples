<?php


class Database extends Variable{

    var $host   = "localhost"; //database server
    var $user     = "root"; //database login name
    var $pass     = "xavisegur"; //database login password
    var $database = "laboratory"; //database name

    public $connection;

    public function connect(){
            $this->connection = new mysqli($this->host,$this->user,$this->pass,$this->database);
            if (mysqli_connect_error())	{
                echo mysqli_connect_error();
                exit();
            }else{
                echo "conectat<BR>";
                return $this->connection;
            }
    }

    public function close_connection(){
        mysqli_close($this->connection);
    }
}
?>