<?php
    require_once("controleur/controleur.class.php");
    $unControleur = new Controleur();

    $sejours = $unControleur->getSejours();

?>

<div class="container p-5">
    <p>L'objectif principal de cette enquête est de recueillir des données significatives 
        qui nous aideront à améliorer nos programmes de volontariat, à mieux répondre aux 
        besoins des volontaires, et à renforcer l'impact positif de nos actions bénévoles 
        dans la communauté..</p>
        <p>Nous vous remercions sincèrement de votre participation. Votre voix compte, et votre engagement envers le volontariat est une source d'inspiration. Ensemble, nous travaillons à créer un impact positif et durable dans notre communauté.</p>

    <h1>Enquête de Satisfaction volontariat</h1>
    <!-- grille des differents organismes de donations: enfants, handicapé, cancer etc  -->
    <div class="grid p-3 gap-3 text-center grid-container d-flex">
        <?php
            $organismes = $unControleur->getOrganismes();

            foreach ($organismes as $i => $organisme) {
                echo "<div class='grid-item card p-3'>";
                echo "<img src='" . $organisme['image'] . "' alt='" . $organisme['nom'] . "' style='width: 100%; height: auto;'>";
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
