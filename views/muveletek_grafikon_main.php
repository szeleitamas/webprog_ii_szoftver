<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
</head>
<body>

<?php
try {

    $dbh = new PDO('mysql:host=localhost;dbname=szoftver', 'root', '',
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
    $sql = "SELECT nev as n, mennyiseg as m FROM raktar";
    $sth = $dbh->query($sql);

}
catch (PDOException $e) {
    echo "Hiba: ".$e->getMessage();
}


foreach($sth as $data)
{
    $Termék[] = $data['n'];
    $Mennyiség[] = $data['m'];
}

?>

<div style="width: 500px;">
    <canvas id="myChart"></canvas>
</div>

<script>
    const labels = <?php echo json_encode($Termék) ?>;
    const data = {
        labels: labels,
        datasets: [{
            label: 'Raktár adatok',
            data: <?php echo json_encode($Mennyiség) ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
</body>
</html>
