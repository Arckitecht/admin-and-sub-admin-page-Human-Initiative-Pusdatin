<!-- DELETE Data Dokumen -->
<?php
require '../header.php';
include("../template/import.php");

if (isset($_SESSION['username'])):
    $ambil_x      = $_POST['ID-user'];
    $pecah_x      = explode(",", $ambil_x);
    $adminid_x    = $pecah_x[0];
    $adminakses_x = $pecah_x[1];
    $adminnama_x  = $pecah_x[2];

    if ($adminakses_x == 'Sub-Admin')
    {
        $_SESSION["idadmin"] = $adminid_x;
        ?>

        <body onload="zoom_auto()">
            <div id="layoutSidenav_content" style="background-color: #fafafa">
                <main>
                    <div class="container-fluid" style="width: 70%; margin-top: 3%; margin-bottom: 3%">
                        <h3 class="my-3" style="color: #2e2d2d">Validasi Akses <b
                                style="float: right; color: rgb(37, 150, 190)">ADMIN</b></h3>
                        <div class="row">
                            <div class="col">
                                <div class="card mb-4">
                                    <div class="card-header" style="background-color: #2e2d2d;">
                                        <i class="bi bi-journals"
                                            style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                                        <b style="color: white;">Validasi Akses</b>
                                    </div>
                                    <div class="card-body">
                                        <div class="container overflow-hidden">
                                            <form method="POST" enctype="multipart/form-data">
                                                <br>
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <b>Anda memiliki akses untuk mengedit data user&nbsp;</b><b
                                                        style='color: red'>
                                                        <?php echo $adminnama_x . '&nbsp;<label style="color: black; font-weight: bold">(ID:</label>&nbsp;' . $adminid_x . '<label style="color: black; font-weight: bold">)</label>'; ?>
                                                    </b><b>!</b>
                                                </div>
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <img src='../assets/images/check-removed.gif'>
                                                </div>
                                                <a type="submit" class="btn btn-danger" href="../lihat/lihat-sub.php"
                                                    style="float: left;"><b>←
                                                        Kembali</b></a>
                                                <a type="submit" class="btn btn-primary" href="../edit/edit-sub.php"
                                                    style="float: right;"><b>Lanjutkan →</b></a>
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
    else
    {
        ?>

        <body onload="zoom_auto()">
            <div id="layoutSidenav_content" style="background-color: #fafafa">
                <main>
                    <div class="container-fluid" style="width: 70%; margin-top: 3%; margin-bottom: 3%">
                        <h3 class="my-3" style="color: #2e2d2d">Validasi Akses <b
                                style="float: right; color: rgb(37, 150, 190)">ADMIN</b></h3>
                        <div class="row">
                            <div class="col">
                                <div class="card mb-4">
                                    <div class="card-header" style="background-color: #2e2d2d;">
                                        <i class="bi bi-journals"
                                            style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                                        <b style="color: white;">Validasi Akses</b>
                                    </div>
                                    <div class="card-body">
                                        <div class="container overflow-hidden">
                                            <form method="POST" enctype="multipart/form-data">
                                                <br>
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <b>Anda tidak bisa mengedit data user sesama Admin!</b>
                                                </div>
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <img src="../assets/images/cross2-removed.gif"
                                                        style="width: 400px; height: 300px">
                                                </div>
                                                <a type="submit" class="btn btn-danger" href="../lihat/lihat-sub.php"
                                                    style="float: left;"><b>←
                                                        Kembali</b></a>
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