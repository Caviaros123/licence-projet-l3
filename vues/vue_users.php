<h3> Liste des utilisateurs </h3>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<?php
require_once("controleur/user.class.php");
require_once("controleur/controleur.class.php");

$unControleur = new Controleur();
$lesUsers = $unControleur->getUsers();
	if(isset($lesUsers)){
		foreach ($lesUsers as $unUserTab) {
			$unUser = new User();
			$unUser->renseigner($unUserTab);
			echo "<br> _________ USER SUIVANT ______<br>"; 
			echo $unUser->afficherHtml (); 
		}
	}
?>

<h3> Nombre d'inscriptions par date </h3>
<?php
    $lesDates = array(); // Tableau des dates
    $lesInscriptions = array(); // Tableau du nombre d'inscriptions

    // Cette partie c'est pour récupérer les données du nombre d'inscriptions au fil du temps depuis le contrôleur
    $donneesInscriptions = $unControleur->getInscription();

    if (isset($donneesInscriptions)) {
        foreach ($donneesInscriptions as $donnees) {
            $lesDates[] = $donnees['date']; // Assurez-vous que 'date' correspond au champ date dans votre base de données
            $lesInscriptions[] = $donnees['nombre_inscriptions']; // Assurez-vous que 'nombre_inscriptions' correspond au champ approprié
        }
    }
?>

<canvas id="inscription-chart" width="800" height="450"></canvas>

<script type="text/javascript">
    new Chart(document.getElementById("inscription-chart"), {
        type: 'line',
        data: {
            labels: <?= json_encode($lesDates) ?>, // Utilisez JSON pour convertir les dates en un tableau JavaScript
            datasets: [{
                data: <?= json_encode($lesInscriptions) ?>,
                label: "Inscriptions",
                borderColor: "#3e95cd",
                fill: false
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Nombre d\'inscriptions par date'
            }
        }
    });
</script>
