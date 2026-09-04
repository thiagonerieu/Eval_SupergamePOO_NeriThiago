<?php

//imports
require_once 'ModelPlayer.php';

// Dans le fichier Model.php, créez la classe Model. Son constructeur instancie un objet de connexion PDO.
class Model {
    protected $pdo;

    //CONSTRUCTEUR
    public function __construct() {
        $host = 'localhost';
        $dbname = 'supergame';
        $username = 'root';
        $password = 'root';
    
        try {
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $username,
                $password
            );
            // Option pour gérer les erreurs
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }
    //GETTER ET SETTER

    //METHODS

}
?>