<?php
class Database
{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "zoo";

    function connect()
    {
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        return $connection;
    }
    function read($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);
        if ($result) {
            $data = false;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else return false;
    }
    function save($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);
        return $result;
    }
}

