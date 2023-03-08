<?php
require 'config.php';

$nama1 = 'E-Book';
$nama2 = 'E-Reference';
$nama3 = 'Human Initiative Product';

$sqlebook   = mysqli_query($conn, "SELECT * FROM `book` WHERE JenisDok='$nama1'");
$sqleref    = mysqli_query($conn, "SELECT * FROM `book` WHERE JenisDok='$nama2'");
$sqlhiprod  = mysqli_query($conn, "SELECT * FROM `book` WHERE JenisDok='$nama3'");
$chart_data = "";
$ebook      = mysqli_num_rows($sqlebook);
$eref       = mysqli_num_rows($sqleref);
$hiprod     = mysqli_num_rows($sqlhiprod);
?>
<script>
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    var ctx = document.getElementById("pie1");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["E-Book", "E-Reference", "Human Initiative Product"],
            datasets: [{
                data: [<?php echo json_encode($ebook); ?>, <?php echo json_encode($eref); ?>, <?php echo json_encode($hiprod); ?>],
                backgroundColor: ['#007bff', '#dc3545', '#ffc107'],
            }],
        },
    });
</script>