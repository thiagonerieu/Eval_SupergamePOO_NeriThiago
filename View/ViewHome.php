<?php

// Dans le fichier ViewHome.php : créez la classe ViewHome.

// - méthode displayMain() : effectue un echo de la partie HTML correspondant au <main>. Son but est d’avoir un formulaire d’ajout de joueur (pseudo, score, et un menu déroulant pour les teams Chaque Option de ce Select associe un nom d’équipe de la base de données à la valeur de son id. Pour les besoins de l’exercice, faite cela en dur dans le HTML, sans utiliser de requête à la BDD :

// + value : 1, affiche Aucune
// + value : 2, affiche TeamRocket
// + value : 3, affiche DreamTeam

// Il y aura aussi un message de confirmation ou d’erreur pour ce formulaire. De plus, ce <main> affiche aussi la liste de tous les joueurs (pseudo, score, team) 

// - méthode displayAll() : effectue le lancement de chaque display dans le bon ordre :
// displayHeader(), displayMain(), displayFooter()

class ViewHome extends View {

    public function displayMain($confirmationMessage = '', $players = []): ViewHome {
        echo '<main>
    <h2>Ajouter un joueur</h2>
    <form method="post" action="">
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>
        <br>
        <label for="score">Score :</label>
        <input type="number" id="score" name="score" required>
        <br>
        <label for="team">Équipe :</label>
        <select id="team" name="team">
            <option value="1">Aucune</option>
            <option value="2">TeamRocket</option>
            <option value="3">DreamTeam</option>
        </select>
        <br>
        <button type="submit">Ajouter</button>
    </form>';

        if (!empty($confirmationMessage)) {
            echo '<p>' . htmlspecialchars($confirmationMessage) . '</p>';
        }

        echo '<h2>Liste des joueurs</h2>';
        if (!empty($players)) {
            echo '<ul>';
            foreach ($players as $player) {
                echo '<li>Pseudo : ' . htmlspecialchars($player['pseudo']) . 
                     ', Score : ' . intval($player['score']) . 
                     ', Équipe : ' . htmlspecialchars($player['team']) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Aucun joueur enregistré.</p>';
        }

        echo '</main>';
    }

    public function displayAll($confirmationMessage = '', $players = []) : void {
        $this->displayHeader();
        $this->displayMain($confirmationMessage, $players);
        $this->displayFooter();
    }
}

?>