<?php
class User {
    private $iduser, $nom, $prenom, $age, $email, $telephone, $mdp, $dateInscription;

    public function __construct() {
        $this->iduser = 0;
        $this->nom = $this->prenom = $this->age = $this->email = $this->telephone = $this->mdp="";
        $this->dateInscription = 0;
    }

    public function renseigner($tab) {
        var_dump($tab);
        $this->iduser = (isset($tab['iduser'])) ? $tab['iduser'] : 0;
        $this->nom = $tab['nom'];
        $this->prenom = $tab['prenom'];
        $this->age = $tab['age'];
        $this->email = $tab['email'];
        $this->telephone = $tab['telephone'];
        $this->mdp = $tab['mdp'];
        $this->dateInscription = (isset($tab['dateInscription'])) ? $tab['dateInscription'] : 0;
    }
    
    public function afficherHtml() {
        return "
        <br> nom : " . $this->nom . "
        <br> prenom : " . $this->prenom . "
        <br> age : " . $this->age . "
        <br> email : " . $this->email . "
        <br> telephone : " . $this->telephone . "
        <br> Date d'inscription : " . $this->dateInscription . "
        ";
    }

    public function serialiser() {
        return array(
            "iduser" => $this->iduser,
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "age" => $this->age,
            "email" => $this->email,
            "telephone" => $this->telephone,
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

    public function getAge() {
        return $this->age;
    }
    
    public function setAge($age) {
        $this->age = $age;
    }
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function gettelephone() {
        return $this->telephone;
    }
    
    public function settelephone($telephone) {
        $this->telephone = $telephone;
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
