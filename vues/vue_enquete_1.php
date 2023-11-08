<!DOCTYPE html>
<html>
<head>
    <title>Notez votre Séjour!</title>
</head>
<body>
    <p>L'objectif de cette enquête de satisfaction est de recueillir des commentaires et des évaluations des 
        clients après leur séjour. Nous cherchons à comprendre et à mesurer leur niveau de satisfaction, ainsi 
        que leurs opinions sur différents aspects de leur expérience. Merci de prendre le temps de remplir cette 
        enquête et de partager votre avis avec nous.</p>


    <h1>Enquête de Satisfaction</h1>
    <form action="enregistrer_enquete.php" method="post">
        <label for="id_sejour">Numero du Séjour :</label> <br>
        <input type="number" name="id_sejour" id="id_sejour" required>
        <br>

        <label for ="note">Note (de 1 à 10) :</label> <br>
        <input type="number" name="note" id="note" min="1" max="10" required>
        <br>

        <label for="commentaire">Commentaire :</label> <br>
        <textarea name="commentaire" id="commentaire"></textarea>
        <br>

        <input type="submit" value="Soumettre l'enquête">
    </form>

    

 
</body>
</html>
