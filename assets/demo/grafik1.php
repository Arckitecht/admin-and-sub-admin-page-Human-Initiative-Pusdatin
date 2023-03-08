<?php
require 'config.php';

$sqladmin    = mysqli_query($conn, "SELECT * FROM `user` WHERE Akses='Admin'");
$sqlsubadmin = mysqli_query($conn, "SELECT * FROM `user` WHERE Akses='Sub-Admin'");
$chart_data  = "";
$jmladmin    = mysqli_num_rows($sqladmin);
$jmlsubadmin = mysqli_num_rows($sqlsubadmin);
?>
<script>
    Chart.defaults.global.defaultFontFamily =
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    var ctx = document.getElementById("grafik1");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Admin", "Sub-Admin"],
            datasets: [{
                label: "Jumlah User",
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
                data: [<?php echo json_encode($jmladmin); ?>, <?php echo json_encode($jmlsubadmin); ?>],
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