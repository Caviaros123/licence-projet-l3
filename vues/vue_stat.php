<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique des Enquêtes</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <h1>Graphique des Enquêtes</h1>
        <p>Cette page affiche les moyennes des notes pour différents séjours. Explorez les résultats et découvrez les évaluations des participants.</p>
    </div>
    
    <canvas id="enqueteChart"></canvas>
    
    <script>
        // Récupérer les données depuis le contrôleur (ajustez le chemin si nécessaire)
        var moyennesSejours = <?php echo json_encode($unControleur->getSejoursMoyennesNotes()); ?>;

        var ctx = document.getElementById('enqueteChart').getContext('2d');
        var enqueteChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: moyennesSejours.map(item => item.station_Sejour),
                datasets: [
                    {
                        label: 'Moyenne de Notes des Sejours',
                        data: moyennesSejours.map(item => item.MoyenneNote),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            
            options: {
                scales: {
                    x: {
                        type: 'category',
                        position: 'bottom'
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
