<?php 
require_once('config/config.php');

class BaseModel
{
    private $host, $user, $password, $database;
    public $conn;
    public function __construct()
    {   $this->host     = HOST;
        $this->user     = USER;
        $this->password = PASSWORD;
        $this->database = DATABASE;
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Koneksi gagal: ' . $e->getMessage();
        }
    }

    public function query($sql)
    {
        $exec = $this->conn->prepare($sql);
        $exec->execute();
        $exec->setFetchMode(PDO::FETCH_ASSOC);
        return $exec->fetchAll();
    }

    public function exec($sql)
    {
        return $this->conn->exec($sql);
    }

    public function update($sql)
    {
        $exec = $this->conn->prepare($sql);
        $exec->execute();
        return $exec->rowCount();
    }
}