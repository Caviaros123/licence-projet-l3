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

    <h1>Enquête de Satisfaction Donnation</h1>
    <!-- grille des differents organismes de donations: enfants, handicapé, cancer etc  -->
    <div class="grid mt-5 mb-5 p-5 text-center grid-container d-flex gap-5">
        <div class="grid-item">
            <img src="public/images/children.png" alt="children">
            <h3>Enfants</h3>
        </div>
        <div class="grid-item">
            <img src="public/images/handicap.png" alt="handicap">
            <h3>Handicap</h3>
        </div>
        <div class="grid-item">
            <img src="public/images/cancer.png" alt="cancer">
            <h3>Cancer</h3>
        </div>
        <div class="grid-item">
            <img src="public/images/education.png" alt="education">
            <h3>Education</h3>
        </div>
        <div class="grid-item">
            <img src="public/images/animals.png" alt="animals">
            <h3>Animaux</h3>
        </div>
        <div class="grid-item">
            <img src="public/images/elderly.png" alt="elderly">
            <h3>Personnes agées</h3>
        </div>
    </div>
    <form action="enregistrer_enquete.php" method="post" class="form">
       
        <label for ="note">Note (de 1 à 10) :</label> <br>
        <!-- checkboxs de 1 a dix -->
        <div class="form-check form-check-inline pb-3 gap-5 d-flex justify-content-center">
            <?php
            for ($i = 1; $i <= 10; $i++) {
                $radio_id = "note_$i"; // Utilisation d'un ID unique pour chaque bouton radio
                echo "<input class='form-check-input' type='radio' name='note' id='$radio_id' value='$i'> $i";
            }
            ?>
        </div>
        

        <input class="btn btn-primary pb-3" type="submit" name="SoumettreEnquete" value="Soumettre l'enquête">
    </form>
</div>
