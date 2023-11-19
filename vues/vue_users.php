<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique Enquête</title>
    <!-- Inclure Bootstrap depuis un CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Inclure Chart.js depuis un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container p-5">
        <div class="card mb-5">
            <div class="card-body">
                <h2 class="card-title">Bienvenue sur la page des enquêtes</h2>
                <p class="card-text">Cette page affiche les moyennes des notes pour différents séjours. Explorez les résultats et découvrez les évaluations des participants.</p>
            </div>
        </div>

        <canvas id="enqueteChart"></canvas>

        <script>
            // Récupérer les données depuis le contrôleur (ajustez le chemin si nécessaire)
            var moyennesSejours = <?php echo json_encode($unControleur->getMoyennesSejours()); ?>;

            var ctx = document.getElementById('enqueteChart').getContext('2d');
            var enqueteChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: moyennesSejours.map(item => item.station_Sejour),
                    datasets: [
                        {
                            label: 'Moyenne de Notes',
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

            // Ajouter une animation après la création du graphique
            enqueteChart.options.animation = {
                duration: 1000, // durée de l'animation en millisecondes
                easing: 'easeOutQuart' // type d'animation (facultatif)
            };

            // Ajuster manuellement l'échelle Y après la création du graphique
            var minY = Math.min(...moyennesSejours.map(item => item.MoyenneNote));
            var maxY = Math.max(...moyennesSejours.map(item => item.MoyenneNote));

            // Ajouter une marge pour une meilleure apparence
            minY -= 1;
            maxY += 1;

            enqueteChart.options.scales.y.min = minY;
            enqueteChart.options.scales.y.max = maxY;

            // Mettre à jour le graphique pour appliquer les modifications
            enqueteChart.update();
        </script>
    </div>
</body>
</html>
