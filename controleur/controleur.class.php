<?php
require_once("modele/modele.class.php");

class Controleur {
    private $unModele;

    public function __construct() {
        $this->unModele = new Modele();
    }

    public function inscription($tab) {
        $this->unModele->inscription($tab);
    }

    public function getInscriptions() {
        return $this->unModele->getInscriptions();
    }

    public function connexion($email, $mdp) {
        return $this->unModele->connexion($email, $mdp);
    }

    public function getUsers() {
        return $this->unModele->getUsers();
    }

    public function enregistrerEnquete($tab) {
        // Capturez les données soumises
        $nom = $tab["nom"];
        $prenom = $tab["prenom"];
        $satisfaction = $tab["satisfaction"];
    
        // Stockez les données dans des cookies
        $this->unModele->stockerEnqueteDansCookies($note, $commentaire);
    
        // Redirigez vers une page de confirmation
        header('Location: confirmation_cookie.php');
    }

    public function getEnquete() {
        return $this->unModele->getEnquete();
    }

    public function SejoursMoyennesNotes() {
        $tab = $this->unModele->SejoursMoyennesNotes(); // Récupérez les données du modèle

        include 'vues/vue_enquete_1.php'; 
    }
    
    public function getSejoursMoyennesNotes() {
        return $this->unModele->SejoursMoyennesNotes();
    }
    
    public function afficherFormulaire() {
        // Récupérez les données du formulaire d'enquête depuis les cookies
        $enqueteData = $this->unModele->recupererEnqueteDepuisCookies();
        $note = $enqueteData['note'];
        $commentaire = $enqueteData['commentaire'];
    
        // Affichez le formulaire avec les données récupérées
        include 'vues/vue_enquete_2.php';
    }
}

