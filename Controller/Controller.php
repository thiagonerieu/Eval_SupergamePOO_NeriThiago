<?php

//imports
require 'Model.php';
require 'ModelPlayer.php';
require 'View.php';
require 'ViewHome.php';

// Dans le fichier Controller.php, créez la class Controller. Son constructeur prend en paramètre un objet Model pour l’attribuer à sa propriété model, ainsi qu’un objet View pour l’attribuer à sa propriété view. De plus, elle possède une méthode :
class Controller {
    protected Model $model;
    protected View $view;

    public function __construct(Model $model, View $view) {
        $this->model = $model;
        $this->view = $view;
    }

    // - render() : appelle la view et lui demande de lancer sa méthode displayAll().
    public function render() {
        $this->view->displayAll();
    }
}

?>