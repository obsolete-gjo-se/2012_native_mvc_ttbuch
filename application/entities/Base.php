<?php
namespace entities;

class Base {
    
    private $dbh = NULL;

    function __construct(){
        
        $connect = new \database\DbConnect();
        $this->dbh = $connect->connect;
    }
    
    public function __get($property){
        return $this->$property;
    }
    
    public function __set($property, $value){
        $this->$property = $value;
    }
}

?>