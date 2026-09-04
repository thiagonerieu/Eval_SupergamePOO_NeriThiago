<?php

//imports
require_once 'Model.php';

// Dans le fichier ModelPlayer.php, créez la classe ModelPlayer. Elle possède des méthodes qui envoie des requêtes à la BDD au sein de Try…Catch. Dans chaque cas, le Catch attrape l’exception et affiche le message d’erreur grâce à die() :

class ModelPlayer extends Model{
    private ?int $id_player;
    private ?string $pseudo;
    private ?string $score;
    private ?int $id_team;
    
    private PDO $bdd;

    //CONSTRUCTEUR
    public function __construct(PDO $bdd){
        $this->bdd = $bdd;
    }

    //GETTER ET SETTER

    //METHODS
    // - findAll() : requête pour récupérer tous les players avec toutes leurs informations (id, pseudo, score, team). Elle retourne un tableau contenant des tableaux associatifs.
    public function findAll():?array{
        try{
            //1. Préparer une requête pour SELECT les utilisateurs
            //On utilise l'objet PDO stocké dans l'attribut bdd de notre model ($this->bdd)
            $req = $this->bdd->prepare('SELECT p.id, p.pseudo, p.score, t.team FROM player p INNER JOIN team t ON t.id = t.team_id');

            //2. Exécution de la requête
            $req->execute();

            //3. Return des données utilisateurs
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch(EXCEPTION $error){
            die($error->getMessage());
        }
    }

    // - findByPseudo() : requête pour récupérer qu’un seul player grâce à son pseudo. Elle retourne un tableau associatif.
    public function findByPseudo(string $pseudo) {
    try {
        $stmt = $this->pdo->prepare("SELECT * FROM player WHERE pseudo = :pseudo");
        $stmt->execute([
            'pseudo' => $pseudo
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Erreur findByPseudo : ' . $e->getMessage());
    }
}

    // - add() : requête pour enregistrer un player en connaissant son pseudo, son score et l’id de sa team (la clé étrangère id_team).
    public function add(string $pseudo, int $score, int $id_team) {
    try {
        $stmt = $this->pdo->prepare("INSERT INTO player (pseudo, score, id_team) VALUES (:pseudo, :score, :id_team)");
        $stmt->execute([
            'pseudo' => $pseudo,
            'score' => $score,
            'id_team' => $id_team
        ]);
    } catch (PDOException $e) {
        die('Erreur add : ' . $e->getMessage());
    }
}
    
    // - delete() : requête pour supprimer un player en connaissant son id.
    public function delete(int $id_player) {
    try {
        $stmt = $this->pdo->prepare("DELETE FROM player WHERE id_player = :id_player");
        $stmt->execute([
            'id_player' => $id_player
        ]);
    } catch (PDOException $e) {
        die('Erreur delete : ' . $e->getMessage());
    }
}

    // - update() requête pour mettre à jour les données d’un player existant grâce à son id, en connaissant son pseudo, son score et l’id de sa team (la clé étrangère id_team).
    public function update(int $id_player, string $pseudo, int $score, int $id_team) {
    try {
        $stmt = $this->pdo->prepare("UPDATE player SET pseudo = :pseudo, score = :score, id_team = :id_team WHERE id_player = :id_player");
        $stmt->execute([
            'id_player' => $id_player,
            'pseudo' => $pseudo,
            'score' => $score,
            'id_team' => $id_team
        ]);
    } catch (PDOException $e) {
        die('Erreur update : ' . $e->getMessage());
    }
}
}

?>