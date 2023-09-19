<?php

class mysql_conn {
    private $conn;

    function __construct(){
        include "db_params.php";
        $this->conn=new mysqli($db_host, $db_user, $db_pass, $db_schema);
    }
    function GetConn(){
        return $this->conn;
        }
    // Define the update method
    public function update($table, $data, $where) {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = '$value'";
        }
        $set = implode(', ', $set);

        $sql = "UPDATE $table SET $set WHERE $where";
        return $this->conn->query($sql);
    }

}