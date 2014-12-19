<?php
namespace entities\person;

class Person extends \entities\Base {

    const TABELLE = "person";
    private $id;
    private $id_get;
    private $vorname;
    private $nachname;
    private $gebDatum;
    private $groesse;
    private $geschlecht;
    private $gewicht;

    public function __construct(){
        
        if(isset($_POST['id']))
            $this->id = $_POST['id'];
        if(isset($_GET['id']))
            $this->id_get = $_GET['id'];
        if(isset($_POST['vorname']))
            $this->vorname = htmlspecialchars($_POST['vorname']);
        if(isset($_POST['nachname']))
            $this->nachname = htmlspecialchars($_POST['nachname']);
        if(isset($_POST['gebDatum']))
            $this->gebDatum = htmlspecialchars($_POST['gebDatum']);
        if(isset($_POST['groesse']))
            $this->groesse = htmlspecialchars($_POST['groesse']);
        if(isset($_POST['geschlecht']))
            $this->geschlecht = htmlspecialchars($_POST['geschlecht']);
        if(isset($_POST['gewicht']))
            $this->gewicht = htmlspecialchars($_POST['gewicht']);
        
        parent::__construct();
    
    }

    public function createPerson(){
        
        $sql = "INSERT INTO " . self::TABELLE . 
                    "(vorname, nachname, gebDatum, groesse, geschlecht, gewicht )
                values
                    (?, ?, ?, ?, ?, ?)";
        
        $prep_state = $this->dbh->prepare($sql);
        
        $prep_state->bindParam(1, $this->vorname);
        $prep_state->bindParam(2, $this->nachname);
        $prep_state->bindParam(3, $this->gebDatum);
        $prep_state->bindParam(4, $this->groesse);
        $prep_state->bindParam(5, $this->geschlecht);
        $prep_state->bindParam(6, $this->gewicht);
        
        $prep_state->execute();
        
        if($prep_state->errorCode() !== "00000") {
        
            echo "MySQL-Errorcode: " . $prep_state->errorCode() . "<br />";
            throw new \error\myException("", 1);
        }
        
        header('Location: person/person.php');
    
    }

    public function showAllPerson(){
        
        $sql = "SELECT * FROM " . self::TABELLE;
        
        $prep_state = $this->dbh->prepare($sql);
        
        $prep_state->execute();
        
        if($prep_state->errorCode() !== "00000") {

            echo "MySQL-Errorcode: " . $prep_state->errorCode() . "<br />";
            throw new \error\myException("", 1);
        }

        return $prep_state;
    }

    public function selectForUpdatePerson(){
        
        $sql = "SELECT * FROM " . self::TABELLE . 

        " WHERE id= ?";
        
        $prep_state = $this->dbh->prepare($sql);
        
        $prep_state->bindParam(1, $this->id_get);
        
        $prep_state->execute();
        
        if($prep_state->errorCode() !== "00000") {
        
            echo "MySQL-Errorcode: " . $prep_state->errorCode() . "<br />";
            throw new \error\myException("", 1);
        }
        
        return $prep_state;
    
    }
	
	

    public function updatePerson(){
        
        $sql = "UPDATE " . self::TABELLE . 
                    " SET
                        vorname = ?, 
                        nachname = ?, 
                        gebDatum = ?, 
                        groesse = ?, 
                        geschlecht = ?, 
                        gewicht = ? 
                    
                    WHERE id = ?";
        
        $prep_state = $this->dbh->prepare($sql);
        
        $prep_state->bindParam(1, $this->vorname);
        $prep_state->bindParam(2, $this->nachname);
        $prep_state->bindParam(3, $this->gebDatum);
        $prep_state->bindParam(4, $this->groesse);
        $prep_state->bindParam(5, $this->geschlecht);
        $prep_state->bindParam(6, $this->gewicht);
        $prep_state->bindParam(7, $this->id);
        
        $prep_state->execute();
        
        
        
        header('Location: person/person.php');
    }

    public function deletePerson(){
        
        $sql = "DELETE FROM " . self::TABELLE . 

                    " WHERE id= ?";
        
        $prep_state = $this->dbh->prepare($sql);
        
        $prep_state->bindParam(1, $this->id_get);
        
        $prep_state->execute();
        
        if($prep_state->errorCode() !== "00000") {
        
            echo "MySQL-Errorcode: " . $prep_state->errorCode() . "<br />";
            throw new \error\myException("", 1);
        }
        
        header('Location: person/person.php');
    
    }

}

?>