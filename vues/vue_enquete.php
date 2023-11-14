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
    <!--  liste des services a enqueter -->
    <div class="list-group mt-5 mb-5 p-5 text-center">
        <a href="index.php?page=7" class="list-group-item list-group-item-action active">
            <h3 class="mb-3">Séjour</h3>
            <p class="mb-3">L'objectif de cette enquête de satisfaction est de recueillir des commentaires et des évaluations des 
                clients après leur séjour. Nous cherchons à comprendre et à mesurer leur niveau de satisfaction, ainsi 
                que leurs opinions sur différents aspects de leur expérience. Merci de prendre le temps de remplir cette 
                enquête et de partager votre avis avec nous.</p>
        </a>
        <a href="index.php?page=8" class="list-group-item list-group-item-action">
            <h3 class="mb-3">Donation</h3>
            <p class="mb-3">L'objectif de cette enquête de satisfaction est de recueillir des commentaires et des évaluations des 
                clients après leur séjour. Nous cherchons à comprendre et à mesurer leur niveau de satisfaction, ainsi 
                que leurs opinions sur différents aspects de leur expérience. Merci de prendre le temps de remplir cette 
                enquête et de partager votre avis avec nous.</p>
        </a>
        <a href="index.php?page=9" class="list-group-item list-group-item-action">
            <h3 class="mb-3">Volontariat</h3>
            <p class="mb-3">
                L'objectif de cette enquête de satisfaction est de recueillir des commentaires et des évaluations des 
                clients après leur séjour. Nous cherchons à comprendre et à mesurer leur niveau de satisfaction, ainsi 
                que leurs opinions sur différents aspects de leur expérience. Merci de prendre le temps de remplir cette 
                enquête et de partager votre avis avec nous.
            </p>
        </a>
    </div>
</div>
