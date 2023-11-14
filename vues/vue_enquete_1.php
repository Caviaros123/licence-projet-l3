<?php
    require_once("controleur/controleur.class.php");
    $unControleur = new Controleur();

    $sejours = $unControleur->getSejours();

?>

<div class="container p-5">
    <p>L'objectif de cette enquête de satisfaction est de recueillir des commentaires et des évaluations des 
        clients après leur séjour. Nous cherchons à comprendre et à mesurer leur niveau de satisfaction, ainsi 
        que leurs opinions sur différents aspects de leur expérience. Merci de prendre le temps de remplir cette 
        enquête et de partager votre avis avec nous.</p>

    <h1>Enquête de Satisfaction</h1>
    <form action="enregistrer_enquete.php" method="post" class="form">
        <label for="id_sejour">Numero du Séjour :</label> <br>
        <!-- select getSejours -->
        <select name="id_sejour" id="id_sejour" class="form-input form-control pb-3" required>
            <option value="Choisir un séjour" hidden>Choisir un séjour</option>
            <?php
                foreach ($sejours as $sejour) {
                    echo "<option value='" . $sejour['id_sejour'] . "'>" . $sejour['id_sejour'] . "</option>";
                }
            ?>
        </select>
        <br>

        <label for ="note">Note (de 1 à 10) :</label> <br>
        <input class="form-input form-control pb-3" type="number" name="note" id="note" min="1" max="10" required>
        <br>

        <label for="commentaire">Commentaire :</label> <br>
        <textarea name="commentaire" id="commentaire"></textarea>
        <br>

        <input class="btn btn-primary pb-3" type="submit" name="SoumettreEnquete" value="Soumettre l'enquête">
    </form>
</div>
