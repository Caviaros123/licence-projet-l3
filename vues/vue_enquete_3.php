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

    <h1>Enquête de Satisfaction volontariat</h1>
    <!-- grille des differents organismes de donations: enfants, handicapé, cancer etc  -->
    <div class="grid p-3 gap-3 text-center grid-container d-flex">
        <?php
            $organismes = $unControleur->getOrganismes();

            foreach ($organismes as $i => $organisme) {
                echo "<div class='grid-item card p-3'>";
                echo "<img src='" . $organisme['image'] . "' alt='" . $organisme['nom'] . "'>";
                echo "<h6>" . $organisme['nom'] . "</h6>";
                echo "<br>";
                $radio_id = "note_$i";
                // radio buttons to check each organism
                echo "<input class='form-check-input' type='radio' name='organisme' id='$radio_id' value='$i'> $i";
                echo "</div>";
            }
        ?>
    </div>
    <form action="enregistrer_enquete_3.php" method="post" class="form">
        <label for ="note">Note (de 1 à 10) :</label> <br>
        <input class="form-input form-control pb-3" type="number" name="note" id="note" min="1" max="10" required>
        <br>

        <label for="commentaire">Commentaire :</label> <br>
        <textarea class="form-control" name="commentaire" id="commentaire"></textarea>
        <br>

        <input class="btn btn-primary pb-3" type="submit" name="SoumettreEnquete" value="Soumettre l'enquête">
    </form>
</div>
