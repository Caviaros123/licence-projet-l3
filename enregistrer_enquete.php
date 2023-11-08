<?php
require_once("controleur/controleur.class.php");
require_once("modele/modele.class.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire soumis
    $note = $_POST["note"];
    $commentaire = $_POST["commentaire"];

    // Créer un tableau avec les données de l'enquête
    $donneesEnquete = [
        "note" => $note,
        "commentaire" => $commentaire
    ];

    // Instancier le contrôleur
    $controleur = new Controleur();

    // Appeler la méthode pour enregistrer l'enquête
    $controleur->enregistrerEnquete($donneesEnquete);
}

// Rediriger vers une page de confirmation ou autre
header("Location: confirmation.php");
?>
