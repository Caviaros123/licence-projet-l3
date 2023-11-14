
<?php
require_once("controleur/controleur.class.php");
require_once("modele/modele.class.php");

if (isset($_POST["SoumettreEnquete"])) {
    // Récupérer les données du formulaire soumis
    $note = $_POST["note"];
    $commentaire = $_POST["commentaire"];
    $id_sejour = $_POST["id_sejour"];

    // Vérifier si la clé 'user' existe dans le cookie
    $user = isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"]) : null;

    // Vérifier si la clé 'id_utilisateur' existe dans l'objet utilisateur
    $idUser = isset($user->id_utilisateur) ? $user->id_utilisateur : null;

    // Créer un tableau avec les données de l'enquête
    $donneesEnquete = [
        "note" => $note,
        "commentaire" => $commentaire,
        "id_sejour" => $id_sejour,
        "user" => $idUser
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
