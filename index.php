<?php 

//  Le fichier index.php sert de point d’entrée. Il va donc exécuter le code comme suit :
// - Créer un objet controllerHome en lui fournissant un ModelPlayer et un ViewHome
// - Lancer registerPlayer()
// - Lancer displayPlayers()
// - Lancer render()

require_once '/Model/ModelPlayer.php';
require_once '/View/ViewHome.php';
require_once '/Controller/ControllerHome.php';

// Initialisation de la connexion PDO (ajustez selon votre configuration de base de données)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=supergame;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// Instanciation du Model et de la View nécessaires
$model = new ModelPlayer($pdo); // ou instancié sans paramètre si le pdo est géré en interne
$view = new ViewHome();

// 1. Créer un objet ControllerHome en lui fournissant un ModelPlayer et un ViewHome
$controllerHome = new ControllerHome($model, $view);

// 2. Lancer registerPlayer()
$controllerHome->registerPlayer();

// 3. Lancer displayPlayers()
$controllerHome->displayPlayers();

// 4. Lancer render() (assurez-vous que ControllerHome hérite de Controller pour disposer de cette méthode)
$controllerHome->render();
?>