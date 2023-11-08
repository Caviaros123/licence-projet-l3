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
        $requete = "INSERT INTO Utilisateurs (Nom, Prenom, Email, Mdp_Utilisateur, Date_Inscription) VALUES (:nom, :prenom, :email, :mdp, :dateInscription)";
        $donnees = array(
            ":nom" => $tab["nom"],
            ":prenom" => $tab["prenom"],
            ":email" => $tab["email"],
            ":mdp" => $tab["mdp"],
            ":dateInscription" =>$tab["dateInscription"]
        );
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
    }

    public function connexion($email, $mdp) {
        $requete = "SELECT * FROM Utilisateurs WHERE Email = :email AND Mdp_Utilisateur = :mdp";
        $donnees = array(
            ":email" => $email,
            ":mdp" => $mdp
        );
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
        return $select->fetch();
    }

    public function getUsers() {
        $requete = "SELECT * FROM Utilisateurs";
        $select = $this->unPdo->prepare($requete);
        $select->execute();
        return $select->fetchAll();
    }

    public function execute($requete) {
        return $this->unPdo->query($requete);
    }
    
    public function getInscriptions() {
        $requete = "SELECT Date_Inscription AS date, COUNT(*) AS nombre_inscriptions 
                    FROM Utilisateurs 
                    GROUP BY date";
        
        $resultat = $this->execute($requete);
        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>