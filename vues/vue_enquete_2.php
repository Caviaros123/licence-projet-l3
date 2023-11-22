<?php
    require_once("controleur/controleur.class.php");
    $unControleur = new Controleur();

    $sejours = $unControleur->getSejours();

?>

<div class="container p-5">
    <p>L'objectif principal de cette enquête est de recueillir vos commentaires et 
        évaluations après avoir effectué un don sur WeMakeDonation. Nous croyons en la 
        transparence, l'efficacité et l'amélioration continue, et votre contribution à 
        cette enquête est essentielle pour nous aider à atteindre ces objectifs..</p>

    <h1>Enquête de Satisfaction Donnation</h1>
    <!-- grille des differents organismes de donations: enfants, handicapé, cancer etc  -->
    <div class="grid mt-5 mb-5 p-5 text-center grid-container d-flex gap-5">
        <div class="grid-item">
            <img src="public/images/enfant.jpg" alt="children" style="width:100px;">
            <h3>Enfants</h3>
        </div>
        <div class="grid-item">
            <img src="public/images/hadicap.jpg" alt="handicap" style="width:100px;">
            <h3>Handicap</h3>
        </div>
        <div class="grid-item">
            <img src="public/images/cancer.jpg" alt="cancer" style="width:100px;">
            <h3>Cancer</h3>
        </div>
        <div class="grid-item">
            <img src="public/images/education.jpg" alt="education" style="width:100px;">
            <h3>Education</h3>
        </div>
        <div class="grid-item">
            <img src="public/images/animals.jpg" alt="animals" style="width:100px;">
            <h3>Animaux</h3>
        </div>
        <div class="grid-item">
            <img src="public/images/agees.jpg" alt="elderly" style="width:100px;">
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
