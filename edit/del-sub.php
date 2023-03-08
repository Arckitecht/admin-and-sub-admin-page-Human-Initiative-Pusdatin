<!-- DELETE Data User -->
<?php
require '../header.php';
include("../template/import.php");

if (isset($_SESSION['username'])):
    $ambil      = $_POST['ID'];
    $pecah      = explode(",", $ambil);
    $adminid    = $pecah[0];
    $adminakses = $pecah[1];
    $adminnama  = $pecah[2];

    if ($adminakses == 'Sub-Admin')
    {
        $querys = "DELETE FROM `user` WHERE ID='$adminid'";

        $result = $conn->query($querys);
        ?>

        <body onload="zoom_auto()">
            <div id="layoutSidenav_content" style="background-color: #fafafa">
                <main>
                    <div class="container-fluid" style="width: 70%; margin-top: 3%; margin-bottom: 3%">
                        <h3 class="my-3" style="color: #2e2d2d">Hapus User <b
                                style="float: right; color: rgb(37, 150, 190)">ADMIN</b></h3>
                        <div class="row">
                            <div class="col">
                                <div class="card mb-4">
                                    <div class="card-header" style="background-color: #2e2d2d;">
                                        <i class="bi bi-person-square"
                                            style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                                        <b style="color: white;">Hapus User</b>
                                    </div>
                                    <div class="card-body">
                                        <div class="container overflow-hidden">
                                            <form method="POST" enctype="multipart/form-data">
                                                <br>
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <b>Data user&nbsp;</b><b style='color: red'>
                                                        <?php echo $adminnama . '&nbsp;<label style="color: black; font-weight: bold">(ID:</label>&nbsp;' . $adminid . '<label style="color: black; font-weight: bold">)</label>'; ?>
                                                    </b><b>&nbsp;berhasil dihapus!</b>
                                                </div>
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <img src='../assets/images/check-removed.gif'>
                                                </div>
                                                <a type="submit" class="btn btn-primary" href="../lihat/lihat-sub.php"
                                                    style="float: left;"><b>OK</b></a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        function zoom_auto() {
                            document.body.style.zoom = "100%"
                        }
                    </script>
                </main>
                <?php require '../footer.php'; ?>
            </div>
        </body>
        <?php
    }
    elseif ($adminakses != 'Sub-Admin')
    {
        ?>

        <body onload="zoom_auto()">
            <div id="layoutSidenav_content" style="background-color: #fafafa">
                <main>
                    <div class="container-fluid" style="width: 70%; margin-top: 3%; margin-bottom: 3%">
                        <h3 class="my-3" style="color: #2e2d2d">Hapus User <b
                                style="float: right; color: rgb(37, 150, 190)">ADMIN</b></h3>
                        <div class="row">
                            <div class="col">
                                <div class="card mb-4">
                                    <div class="card-header" style="background-color: #2e2d2d;">
                                        <i class="bi bi-person-square"
                                            style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                                        <b style="color: white;">Hapus User</b>
                                    </div>
                                    <div class="card-body">
                                        <div class="container overflow-hidden">
                                            <form method="POST" enctype="multipart/form-data">
                                                <br>
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <b>Anda tidak bisa menghapus sesama user Admin!</b>
                                                </div>
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <img src="../assets/images/cross2-removed.gif"
                                                        style="width: 400px; height: 300px">
                                                </div>
                                                <a type="submit" class="btn btn-primary" href="../lihat/lihat-sub.php"
                                                    style="float: left;"><b>OK</b></a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        function zoom_auto() {
                            document.body.style.zoom = "100%"
                        }
                    </script>
                </main>
                <?php require '../footer.php'; ?>
            </div>
        </body>
        <?php
    }

endif ?>