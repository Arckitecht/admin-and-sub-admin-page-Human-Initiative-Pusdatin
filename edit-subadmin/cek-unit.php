<!-- DELETE Data Dokumen -->
<?php
require '../header-subadmin.php';
include("../template/import.php");

if (isset($_SESSION['username'])):
    $ambil_x  = $_POST['IDBook'];
    $pecah_x  = explode(",", $ambil_x);
    $bookid_x = $pecah_x[0];
    $unit1_x  = $pecah_x[1];
    $unit2_x  = $pecah_x[2];
    $unit3_x  = $pecah_x[3];
    $unit4_x  = $pecah_x[4];

    $unit_dok_x = mysqli_query($conn, "SELECT * FROM book WHERE BookID='$bookid_x'");

    $usernem_user_x = $_SESSION['username'];
    $unit_user_x    = mysqli_query($conn, "SELECT * FROM user WHERE username='$usernem_user_x'");

    $i = 1;
    while ($rowuu = mysqli_fetch_object($unit_user_x) and $rowud = mysqli_fetch_object($unit_dok_x))
    {
        $ambil_1  = $_POST['IDBook'];
        $pecah_1  = explode(",", $ambil_1);
        $bookid_1 = $pecah_1[0];
        $unit1_1  = $pecah_1[1];
        $unit2_1  = $pecah_1[2];
        $unit3_1  = $pecah_1[3];
        $unit4_1  = $pecah_1[4];

        $Unit1_dok  = $unit1_1;
        $Unit1_user = $rowuu->Unit1;

        // Row User
        if (($rowuu->Unit2) == NULL)
        {
            $Unit2_user = "asd";
        }
        else
        {
            $Unit2_user = $rowuu->Unit2;
        }

        if (($rowuu->Unit3) == NULL)
        {
            $Unit3_user = "asd";
        }
        else
        {
            $Unit3_user = $rowuu->Unit3;
        }

        if (($rowuu->Unit4) == NULL)
        {
            $Unit4_user = "asd";
        }
        else
        {
            $Unit4_user = $rowuu->Unit4;
        }

        // Row Dokumen
        if (($unit2_1) == "--")
        {
            $Unit2_dok = "ops";
        }
        else
        {
            $Unit2_dok = $unit2_1;
        }

        if (($unit3_1) == "--")
        {
            $Unit3_dok = "ops";
        }
        else
        {
            $Unit3_dok = $unit3_1;
        }

        if (($unit4_1) == "--")
        {
            $Unit4_dok = "ops";
        }
        else
        {
            $Unit4_dok = $unit4_1;
        }

        if ((($Unit1_dok) == ($Unit1_user)) or (($Unit1_dok) == ($Unit2_user)) or (($Unit1_dok) == ($Unit3_user)) or (($Unit1_dok) == ($Unit4_user)) or (($Unit2_dok) == ($Unit1_user)) or (($Unit2_dok) == ($Unit2_user)) or (($Unit2_dok) == ($Unit3_user)) or (($Unit2_dok) == ($Unit4_user)) or (($Unit3_dok) == ($Unit1_user)) or (($Unit3_dok) == ($Unit2_user)) or (($Unit3_dok) == ($Unit3_user)) or (($Unit3_dok) == ($Unit4_user)) or (($Unit4_dok) == ($Unit1_user)) or (($Unit4_dok) == ($Unit2_user)) or (($Unit4_dok) == ($Unit3_user)) or (($Unit4_dok) == ($Unit4_user)))
        {
            $_SESSION["idbuku"] = $bookid_1;
            ?>

            <body onload="zoom_auto()">
                <div id="layoutSidenav_content" style="background-color: #fafafa">
                    <main>
                        <div class="container-fluid" style="width: 70%; margin-top: 3%; margin-bottom: 3%">
                            <h3 class="my-3" style="color: #2e2d2d">Validasi Akses <b
                                    style="float: right; color: rgb(37, 150, 190)">SUB-ADMIN</b></h3>
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
                                                        <b>Anda memiliki akses untuk mengedit dokumen&nbsp;</b><b
                                                            style='color: red'>
                                                            <?php echo '<label style="color: black; font-weight: bold">(ID:</label>&nbsp;' . $bookid_1 . '<label style="color: black; font-weight: bold">)</label>'; ?>
                                                        </b><b>&nbsp;ini!</b>
                                                    </div>
                                                    <div style="display: flex; justify-content: center; align-items: center;">
                                                        <img src='../assets/images/check-removed.gif'>
                                                    </div>
                                                    <a type="submit" class="btn btn-danger"
                                                        href="../lihat-subadmin/lihat-dok-subadmin.php" style="float: left;"><b>←
                                                            Kembali</b></a>
                                                    <a type="submit" class="btn btn-primary"
                                                        href="../edit-subadmin/edit-dok-subadmin.php"
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
                    <?php require '../footer-subadmin.php'; ?>
                </div>
            </body>
            <?php
        }
        elseif ((($Unit1_dok) != ($Unit1_user)) or (($Unit1_dok) != ($Unit2_user)) or (($Unit1_dok) != ($Unit3_user)) or (($Unit1_dok) != ($Unit4_user)) or (($Unit2_dok) != ($Unit1_user)) or (($Unit2_dok) != ($Unit2_user)) or (($Unit2_dok) != ($Unit3_user)) or (($Unit2_dok) != ($Unit4_user)) or (($Unit3_dok) != ($Unit1_user)) or (($Unit3_dok) != ($Unit2_user)) or (($Unit3_dok) != ($Unit3_user)) or (($Unit3_dok) != ($Unit4_user)) or (($Unit4_dok) != ($Unit1_user)) or (($Unit4_dok) != ($Unit2_user)) or (($Unit4_dok) != ($Unit3_user)) or (($Unit4_dok) != ($Unit4_user)))
        {
            ?>

            <body onload="zoom_auto()">
                <div id="layoutSidenav_content" style="background-color: #fafafa">
                    <main>
                        <div class="container-fluid" style="width: 70%; margin-top: 3%; margin-bottom: 3%">
                            <h3 class="my-3" style="color: #2e2d2d">Validasi Akses <b
                                    style="float: right; color: rgb(37, 150, 190)">SUB-ADMIN</b></h3>
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
                                                        <b>Anda tidak memiliki akses untuk mengedit dokumen ini!</b>
                                                    </div>
                                                    <div style="display: flex; justify-content: center; align-items: center;">
                                                        <img src="../assets/images/cross2-removed.gif"
                                                            style="width: 400px; height: 300px">
                                                    </div>
                                                    <a type="submit" class="btn btn-danger"
                                                        href="../lihat-subadmin/lihat-dok-subadmin.php" style="float: left;"><b>←
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
                    <?php require '../footer-subadmin.php'; ?>
                </div>
            </body>
            <?php
        }
        $i++;
    }

endif ?>