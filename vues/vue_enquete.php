
<link rel="stylesheet" href="style.css">
<?php
    require_once("controleur/controleur.class.php");
    $unControleur = new Controleur();

    $sejours = $unControleur->getSejours();

?>

<div class="container p-5">
    

    <h1>Enquête de Satisfaction</h1>
    <br>

    <!--  liste des services a enqueter -->
    <p>L'objectif principal de notre enquête, c'est de tirer des infos utiles en 
        posant des questions bien ciblées à un groupe de personnes. On cherche à 
        comprendre <b>vos avis</b>, <b>vos expériences</b>, ou même à mesurer <b>vos satisfaction</b>. 
        
        Les enquêtes fournissent des données super importantes pour prendre des décisions 
        éclairées, régler des soucis, adapter nos services, ou évaluer si nos actions 
        fonctionnent bien. C'est comme une manière directe d'entendre ce que les gens 
        pensent et ce dont ils ont besoin. Ça nous donne un sacré coup de main pour avoir 
        une idée claire de ce qui se passe..</p>
        
    <div class="list-group mt-5 mb-5 p-5 text-center">
        <a href="index.php?page=7" class="list-group-item list-group-item-action active">
            <h3 class="mb-3">Séjour</h3>
            <p class="mb-3">Ici, vous avez le pouvoir de faire une différence concrète en 
                soutenant des causes qui vous tiennent à cœur. Découvrez une expérience de don 
                transparente, sécurisée et significative, où chaque contribution compte.</p>
        </a>
        <a href="index.php?page=8" class="list-group-item list-group-item-action">
            <h3 class="mb-3">Donation</h3>
            <p class="mb-3">L'enquête Donation a pour objectif de comprendre ce qui motive 
                les donateurs, d'évaluer leur satisfaction, d'améliorer les processus de 
                collecte de fonds, de recueillir des témoignages positifs, d'adresser les 
                préoccupations et de mesurer l'impact des campagnes. Elle permet aux 
                organisations de mieux répondre aux besoins des donateurs et d'optimiser 
                leurs efforts de collecte de fonds.</p>
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
