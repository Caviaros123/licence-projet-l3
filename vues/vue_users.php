<h3> Âges des clients avec la date d'inscription </h3>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<?php
    $ageAndInscriptionData = $unControleur->getInscriptions();

    $lesAges = [];
    $lesDates = [];

    if (isset($ageAndInscriptionData)) {
        foreach ($ageAndInscriptionData as $data) {
            $lesAges[] = $data['Age'];
            $lesDates[] = $data['Date_Inscription'];
        }
    }

    $chaineAges = '[' . implode(',', $lesAges) . ']';
    $chaineDates = '["' . implode('","', $lesDates) . '"]';
?>

<canvas id="line-chart" width="800" height="450"></canvas>
<script type="text/javascript">
    new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: <?= $chaineDates ?>,
            datasets: [
                {
                    data: <?= $chaineAges ?>,
                    label: " Âge ",
                    borderColor: "#3e95cd",
                    fill: false,
                },
            ],
        },
        options: {
            title: {
                display: true,
                text: 'Âges des utilisateurs en fonction de la date d\'inscription',
            },
        },
    });
</script>
