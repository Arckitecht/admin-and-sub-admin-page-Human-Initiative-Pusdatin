<?php
require 'config.php';

$nama1 = 'Free Access';
$nama2 = 'Premium Access';
$nama3 = 'Priced';

$sqlfree    = mysqli_query($conn, "SELECT * FROM `book` WHERE JenisAkses='$nama1'");
$sqlprem    = mysqli_query($conn, "SELECT * FROM `book` WHERE JenisAkses='$nama2'");
$sqlpriced  = mysqli_query($conn, "SELECT * FROM `book` WHERE JenisAkses='$nama3'");
$chart_data = "";
$free       = mysqli_num_rows($sqlfree);
$prem       = mysqli_num_rows($sqlprem);
$priced     = mysqli_num_rows($sqlpriced);
?>
<script>
    Chart.defaults.global.defaultFontFamily =
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    var ctx = document.getElementById("grafik3");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Free Access", "Premium Access", "Priced"],
            datasets: [{
                label: "Jumlah Dokumen",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [<?php echo json_encode($free); ?>, <?php echo json_encode($prem); ?>, <?php echo json_encode($priced); ?>],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 10,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
</script>