<?php
class Modele {
    private $unPdo;

    public function __construct() {
        try {
            $url = "mysql:host=localhost;dbname=wmd_23";
            $user = "root";
            $mdp = "root";
            $this->unPdo = new PDO($url, $user, $mdp);
        } catch (PDOException $exp) {
            echo "<br> Erreur de connexion à la BDD : " . $exp->getMessage();
        }
    }

    public function inscription($tab) {
        $dateInscription = date("Y-m-d H:i:s"); // Obtient la date actuelle au format "Y-m-d H:i:s"
        var_dump($dateInscription);
        var_dump("USER DATA ====>> ".json_encode($tab));
        $requete = "INSERT INTO Utilisateurs (nom, prenom, age, email, telephone, mdp_utilisateur, date_inscription) VALUES (:nom, :prenom, :age, :email, :telephone, :mdp, :dateInscription)";
        
        $donnees = array(
            ":nom" => $tab["nom"],
            ":prenom" => $tab["prenom"],
            ":age" => $tab["age"],
            ":email" => $tab["email"],
            ":telephone" => $tab["telephone"],
            ":mdp" => password_hash($tab["mdp"], PASSWORD_DEFAULT),
            ":dateInscription" => $dateInscription // Utilise la date actuelle
        );
    
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
    }


    public function connexion($email, $mdp) {
        $requete = "SELECT * FROM Utilisateurs WHERE email = :email";
        $select = $this->unPdo->prepare($requete);
        $select->execute([":email" => $email]);
        $utilisateur = $select->fetch();

        if ($utilisateur && password_verify($mdp, $utilisateur['mdp_utilisateur'])) {
            // Connexion réussie
            unset($utilisateur['mdp_utilisateur']);
            return $utilisateur;
        } else {
            // Identifiants incorrects
            return null;
        }
    }

    // get sejours
    public function getSejours() {
        $requete = "SELECT * FROM sejours";
        $select = $this->unPdo->prepare($requete);
        $select->execute();
        return $select->fetchAll();
    }

    public function getUsers() {
        $requete = "SELECT * FROM Utilisateurs";
        $select = $this->unPdo->prepare($requete);
        $select->execute();
        return $select->fetchAll();
    }

    public function getInscriptions() {
        $requete = "SELECT age, date_inscription FROM Utilisateurs";
        $select = $this->unPdo->prepare($requete);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function execute($requete) {
        return $this->unPdo->query($requete);
    }
    
    public function enregistrerEnquete($tab) {
        // Utilisation de la fonction MySQL NOW() pour la date actuelle
        $requete = "INSERT INTO Evaluations (id_sejour, note, commentaire, date_evaluation, id_utilisateur) VALUES (:id_sejour, :note, :commentaire, NOW(), :id_utilisateur)";

        $donnees = array(
            ":id_sejour" => $tab["id_sejour"],
            ":note" => $tab["note"],
            ":commentaire" => $tab["commentaire"],
            ":id_utilisateur" => $tab["user"]
        );

        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
    }

    public function SejoursMoyennesNotes() {
        $requete = "SELECT Sejours.id_sejour, station_Sejour, AVG(Evaluations.Note) AS MoyenneNote
                    FROM Sejours
                    LEFT JOIN Evaluations ON Sejours.id_sejour = Evaluations.id_sejour
                    GROUP BY Sejours.id_sejour, Station_Sejour";

        $select = $this->unPdo->prepare($requete);
        $select->execute();

        return $select->fetchAll(PDO::FETCH_ASSOC);
    }

    public function enregistrerEnqueteBase() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Capturez les données soumises
            $id_sejour = $_POST['id_sejour'];
            $note = $_POST['note'];
            $commentaire = $_POST['commentaire'];

            // Validez les données si nécessaire
            if (empty($id_sejour) || empty($note)) {

            } else {
                // Les données sont valides, utilisez le modèle pour enregistrer les données
                $tab = [
                    'id_sejour' => $id_sejour,
                    'note' => $note,
                    'commentaire' => $commentaire,
                ];

                header('Location: confirmation.php');
            }
        }

        // Affichez le formulaire si ce n'est pas encore soumis ou en cas d'erreur
        include 'vues/vue_enquete_1.php';
    }

    /*
    public function setCookie($name, $value, $days) {
        setcookie($name, $value, time() + (86400 * $days), "/");
    }

    public function getCookie($name) {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
        return "";
    }

    public function stockerEnqueteDansCookies($nom, $prenom, $satisfaction) {
        // Utilisation de la méthode setCookie pour stocker les données dans des cookies
        $this->setCookie("enquete_nom", $nom, 30); // Stocke le nom dans un cookie pendant 30 jours
        $this->setCookie("enquete_prenom", $prenom, 30); // Stocke le prénom dans un cookie pendant 30 jours
        $this->setCookie("enquete_satisfaction", $satisfaction, 30); // Stocke la satisfaction dans un cookie pendant 30 jours
    }
    
    public function recupererEnqueteCookies() {
        // Utilisation de la méthode getCookie pour récupérer la note et le commentaire depuis les cookies
        $note = $this->getCookie("enquete_note");
        $commentaire = $this->getCookie("enquete_commentaire");
        return ['note' => $note, 'commentaire' => $commentaire];
    }

    public function recupererEnqueteDepuisCookies() {
        // Utilisation de la méthode getCookie pour récupérer la note et le commentaire depuis les cookies
        $nom = $this->getCookie("enquete_nom");
        $prenom = $this->getCookie("enquete_prenom");
        $satisfaction = $this->getCookie("enquete_satisfaction");
        return ['nom' => $nom, 'prenom' => $prenom, 'satisfaction' => $satisfaction];
    }

    public function supprimerEnqueteCookies() {
        // Utilisation de la méthode setCookie pour supprimer les cookies
        $this->setCookie("enquete_nom", "", -1); // Supprime le cookie enquete_nom
        $this->setCookie("enquete_prenom", "", -1); // Supprime le cookie enquete_prenom
        $this->setCookie("enquete_satisfaction", "", -1); // Supprime le cookie enquete_satisfaction
    }

    public function supprimerEnqueteDepuisCookies() {
        // Utilisation de la méthode setCookie pour supprimer les cookies
        $this->setCookie("enquete_nom", "", -1); // Supprime le cookie enquete_nom
        $this->setCookie("enquete_prenom", "", -1); // Supprime le cookie enquete_prenom
        $this->setCookie("enquete_satisfaction", "", -1); // Supprime le cookie enquete_satisfaction
    }


    public function getEnquete() {
        $requete = "SELECT * FROM Evaluations";
        $select = $this->unPdo->prepare($requete);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    

}

?>