<?php
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();
$sejours = $unControleur->getSejours();
?>

<div class="container p-5">
    <p>L'objectif de cette enquête de satisfaction est de recueillir des commentaires et des évaluations des
        clients après leur séjour. Nous cherchons à comprendre et à mesurer leur niveau de satisfaction, ainsi
        que leurs opinions sur différents aspects de leur expérience. Merci de prendre le temps de remplir cette
        enquête et de partager votre avis avec nous.
    </p>
    <div class="card">
        <div class="card-body">
            <h1>Enquête de Satisfaction des séjours</h1>
            <form action="enregistrer_enquete.php" method="post" class="form" id="formEnquete">

                <label for="station_sejour">Nom du Séjour :</label> <br>
                <select name="station_sejour" id="station_sejour" class="form-input form-control pb-3" required>
                    <option value="Choisir un séjour" hidden>Choisir un séjour</option>
                    <?php
                    foreach ($sejours as $sejour) {
                        echo "<option value='" . $sejour['station_sejour'] . "'>" . $sejour['station_sejour'] . "</option>";
                    }
                    ?>
                </select>
                <br>

                <label for="note">Note (de 1 à 10) :</label> <br>
                <input class="form-input form-control pb-3" type="number" name="note" id="note" onblur="c_note()" min="1"
                    max="10" required>
                <br>
                <p id="messageNote" style="color: red;"></p>

                <label for="commentaire">Commentaire :</label> <br>
                <textarea class="form-control" name="commentaire" id="commentaire" required></textarea>
                <br>

                <input class="btn btn-primary pb-3" type="submit" name="SoumettreEnquete" value="Soumettre l'enquête"
                    onclick="verifierChamps()">
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function c_note() {
        var note = document.getElementById('note').value;
        var messageNote = document.getElementById('messageNote');

        if (note >= 1 && note <= 10) {
            messageNote.textContent = ""; // Efface le message d'erreur
            document.getElementById('note').style.backgroundColor = "green";
        } else {
            messageNote.textContent = "Votre note doit être comprise entre 1 et 10";
            document.getElementById('note').style.backgroundColor = "red";
        }
    }

    function verifierChamps() {
        // Récupérer les valeurs des champs
        var station_sejour = document.getElementById('station_sejour').value;
        var note = document.getElementById('note').value;
        var commentaire = document.getElementById('commentaire').value;

        // Vérifier si tous les champs sont remplis
        if (station_sejour !== "Choisir un séjour" && note >= 1 && note <= 10 && commentaire.trim() !== "") {
            // Envoyer le formulaire si tout est rempli
            document.getElementById('formEnquete').submit();
        } else {
            // Afficher un message d'erreur
            alert("Veuillez remplir tous les champs obligatoires.");
        }
    }
</script>
