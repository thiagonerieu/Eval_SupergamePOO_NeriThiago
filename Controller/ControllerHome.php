<?php

//imports
require_once 'Model.php';
require_once 'ModelPlayer.php';
require_once 'View.php';
require_once 'ViewHome.php';
    

// Dans le fichier ControllerHome.php, créez la class ControllerHome. Elle possède 2 méthodes :

class ControllerHome {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    // - displayPlayers() : Elle demande au model de récupérer la totalité des players, avant de fournir ces données à la view.
    public function displayPlayers() {
        // 1. Demande au model de récupérer tous les joueurs
        $players = $this->model->findAll();
        
        // 2. Fournit ces données à la view pour les afficher
        $this->view->displayPlayers($players);
    }

    // - registerPlayer() fait plusieurs choses :
    public function registerPlayer() {
        $message = "";

        // Vérifier que l'on reçoit bien le formulaire d'ajout (méthode POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pseudo'])) {
            
            // Mettre en place les sécurités d'usage (nettoyage des données)
            $pseudo = trim(strip_tags($_POST['pseudo']));
            $score = filter_var($_POST['score'], FILTER_VALIDATE_INT);
            $id_team = filter_var($_POST['id_team'], FILTER_VALIDATE_INT);

            // Faire les vérifications pour savoir si l'enregistrement a le droit de s'effectuer
            if (!empty($pseudo) && $score !== false && $id_team !== false) {
                
                // Vérification optionnelle se basant sur le modèle existant (ex: vérifier si le pseudo existe déjà)
                $existingPlayer = $this->model->findByPseudo($pseudo);

                if (!$existingPlayer) {
                    // + Effectuer l'enregistrement
                    // + Quelque soit l’issu (succès ou erreur), fournir un message approprié à la vie
                    try {
                        $this->model->add($pseudo, $score, $id_team);
                        // Message de succès
                        $message = "Succès : Le joueur $pseudo a bien été enregistré !";
                    } catch (Exception $e) {
                        // Message d'erreur technique
                        $message = "Erreur lors de l'enregistrement en bdd.";
                    }
                } else {
                    $message = "Erreur : Ce pseudo est déjà utilisé.";
                }
            } else {
                $message = "Erreur : Données du formulaire invalides ou champs vides.";
            }
        }

        // Transmettre le message (succès ou erreur) à la view
        if (method_exists($this->view, 'displayMessage')) {
            $this->view->displayMessage($message);
        }
    }
}
?>