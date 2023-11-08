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

       public function getInscription() {
            return $this->unModele->getInscriptions();
        }

        public function connexion($email, $mdp) {
            return $this->unModele->connexion($email, $mdp);
        }

        public function getUsers() {
            return $this->unModele->getUsers();
        }

        
    }
        
?>
