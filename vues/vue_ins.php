<?php
// Vérification si le formulaire a été soumis
if (isset($_POST['Valider'])) {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Insérer les données dans la base de données
    $unControleur->inscription(array(
        "nom" => $nom,
        "prenom" => $prenom,
        "email" => $email,
        "mdp" => $mdp,
        "dateInscription" => date("Y-m-d H:i:s") // Date actuelle
    ));
}

$lesUsers = $unControleur->getUsers();
?>

<h3> Inscription Utilisateur </h3>
<form method="post" id="inscription-form">
    Nom : <br>
    <input type="text" name="nom" id="nom" onblur="c_nom()"> <br>
    Prénom : <br>
    <input type="text" name="prenom" id="prenom"> <br>
    Email : <br>
    <input type="text" name="email" id="email"> <br>
    Mot de passe: <br>
    <input type="password" name="mdp" id="mdp" onblur="c_email()"> <br>
    <!-- Affichage du message d'erreur -->
    <div id="erreurEmail" style="color: red; display: none;"></div>

    <button name="Valider"> Valider </button>
</form>

<script type="text/javascript">
    function c_nom() {
        var nom = document.getElementById('nom').value;
        var regex = /^[a-zA-Z' ]{1,20}$/;
        if (nom.match(regex)) {
            document.getElementById('nom').style.backgroundColor = "green";
            document.getElementById('nom').value = nom.toUpperCase();
        } else {
            document.getElementById('nom').style.backgroundColor = "red";
        }
    }

    function c_email() {
    var emailField = document.getElementById('email');
    var email = emailField.value;
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (email.match(emailRegex)) {
        emailField.style.backgroundColor = "green";
        document.getElementById('erreurEmail').style.display = 'none';
    } else {
        emailField.style.backgroundColor = "red";
        // Afficher le message d'erreur
        document.getElementById('erreurEmail').innerHTML = 'Adresse e-mail invalide. Veuillez fournir une adresse e-mail valide.';
        document.getElementById('erreurEmail').style.color = 'red';
        document.getElementById('erreurEmail').style.display = 'block';
    }
}
    function vérifieleschamps() {
        // Vérifiez si tous les champs sont correctement remplis
        var nom = document.getElementById('nom').value;
        var emailField = document.getElementById('email');
        var email = emailField.value;
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    }

    // Gestionnaire d'événement pour le bouton "Valider"
    document.getElementById('valider-button').addEventListener('click', function () {
        // Récupérez les valeurs des champs et envoyez-les à la base de données
        var nom = document.getElementById('nom').value;
        var prenom = document.getElementById('prenom').value;
        var email = document.getElementById('email').value;
        var mdp = document.getElementById('mdp').value;
   
    });
</script>
