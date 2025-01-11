<?php

class DatabaseController {
    private $conn;

    public function __construct() {

        $servername = "localhost";
        $username = "rutas";
        $password = "rutasadmin";
        $dbname = "rutas";

        $this->conn = new mysqli($servername, $username, $password, $dbname);
          if($this->conn->connect_error) {
            die("Conexión fallida: ".$conn->connect_error);
          }
    }

    public function query($sql) {
        $result = $this->conn->query($sql);
        if($result === false) {
            return "Error: ".$this->conn->error;
        }
        return $result;
    }

    public function close() {
        $this->conn->close();
    }

}

?>