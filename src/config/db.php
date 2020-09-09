<?php

class DataBase{
    private $dbHost = '';
    private $dbUser = '';
    private $dbPassword = '';
    private $dbName = '';

    //Connection
    public function DBconnection(){
        $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbName";
        $dbConnecion = new PDO($mysqlConnect, $this->dbUser, $this->dbPassword);
        $dbConnecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnecion;
    }
}