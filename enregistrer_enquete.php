<?php
require_once("controleur/controleur.class.php");
require_once("modele/modele.class.php");

if (isset($_POST["SoumettreEnquete"])) {
    // Récupérer les données du formulaire soumis
    $note = $_POST["note"];
    $commentaire = $_POST["commentaire"];
    $id_sejour = $_POST["id_sejour"];
    $user = json_decode($_COOKIE["user"]);


    // Créer un tableau avec les données de l'enquête
    $donneesEnquete = [
        "note" => $note,
        "commentaire" => $commentaire,
        "id_sejour" => $id_sejour,
        "user" => $user->id_utilisateur
    ];

    // Instancier le contrôleur
    $controleur = new Controleur();

    // Appeler la méthode pour enregistrer l'enquête
    $controleur->enregistrerEnquete($donneesEnquete);

    header("Location: confirmation.php");
}

// Rediriger vers une page de confirmation ou autre
//header("Location: confirmation.php");
?>
