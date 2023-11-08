<?php
class User {
    private $iduser, $nom, $prenom, $email, $mdp, $dateInscription ;

    public function __construct() {
        $this->iduser = 0;
        $this->nom = $this->prenom =$this->email =$this->mdp="";
        $this->dateInscription = 0;
    }

    public function renseigner($tab) {
        $this->iduser = (isset($tab['iduser'])) ? $tab['iduser'] : 0;
        $this->nom = $tab['nom'];
        $this->prenom = $tab['prenom'];
        $this->email = $tab['email'];
        $this->mdp = $tab['mdp'];
        $this->salaire = $tab['dateInscription']; 
    }
    
    public function afficherHtml() {
        return "
        <br> Nom : " . $this->nom . "
        <br> Prénom : " . $this->prenom . "
        <br> Email : " . $this->email . "
        <br> Date d'inscription : " . $this->dateInscription . "
        ";
    }

    public function serialiser() {
        return array(
            "iduser" => $this->iduser,
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "email" => $this->email,
            "mdp" => $this->mdp,
            "dateInscription" => $this->dateInscription,
        );
    }

    public function toJson() {
        $tab = $this->serialiser();
        return json_encode($tab);
    }

    // Getters and setters
    public function getIdUser() {
        return $this->iduser;
    }

    public function setIdUser($iduser) {
        $this->iduser = $iduser;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    public function getDateInscription() {
        return $this->dateInscription;
    }

    public function setDateInscription($dateInscription) {
        $this->dateInscription = $dateInscription;
    }
}
?>
