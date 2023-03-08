<!-- Header dan Sidebar -->
<?php
require '../header-subadmin.php';
?>

<!-- VALIDASI Penginputan Form Pengisian Data Dokumen Baru -->
<?php
include("../template/import.php");

if (isset($_SESSION['username'])):
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST["butonedit"]))
    {
        $valid = TRUE;

        $ktgr3 = test_input($_POST['inputktgr3']);

        $editktgr    = test_input($_POST['editktgr']);
        $resultambil = mysqli_query($conn, "SELECT * FROM kategori_dok WHERE KategoriDok='$ktgr3'");
        if (empty($editktgr))
        {
            $error_ktgred = "*Tidak boleh kosong!";
            $valid        = FALSE;
        }
        elseif (mysqli_num_rows($resultambil) > 0)
        {
            $error_ktgred = "*Kategori Dokumen ini sudah ada dalam database! Masukkan yang lain!<br>";
            $valid      = FALSE;
        }

        if ($valid)
        {
            $editktgrdok = 'UPDATE `kategori_dok` SET KategoriDok="' . $editktgr . '" WHERE KategoriDok="' . $ktgr3 . '" ';
            $resultedit  = $conn->query($editktgrdok);
            if (!$resultedit)
            {
                die("Tidak bisa menyelesaikan query </br>" . $conn->$error . "</br> Query:" . $query);
            }
            else
            {
                $message = "Berhasil Mengedit Data!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        else if ($valid = FALSE)
        {
            $messageNO = "Gagal Mengedit Data!";
            echo "<script type='text/javascript'>alert('$messageNO');</script>";
        }
    }

    ?>

    <!-- FORM Pengisian Data Dokumen Baru -->

    <body onload="zoom_auto()">
        <div id="layoutSidenav_content" style="background-color: #fafafa">
            <main>
                <div class="container-fluid" style="width: 70%;">
                    <h3 class="my-3" style="color: #2e2d2d">Edit Kategori Dokumen <b
                            style="float: right; color: rgb(37, 150, 190)">SUB-ADMIN</b></h3>
                    <div class="row">
                        <div class="col">
                            <div class="card mb-4">
                                <div class="card-header" style="background-color: #2e2d2d;">
                                    <i class="bi bi-list-check"
                                        style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                                    <b style="color: white;">Form Edit Kategori Dokumen</b>
                                </div>
                                <div class="card-body">
                                    <div class="container overflow-hidden">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                <label for="inputktgr3" class="col-sm-2 col-form-label"><b>Kategori
                                                        Dokumen</b><b style="color: red"> *</b></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputktgr3"
                                                        name="inputktgr3" value="<?php
                                                        $ktgrdok = $_GET['ktgrdok-sub'];
                                                        if (isset($ktgr3))
                                                        {
                                                            echo $ktgrdok;
                                                        }
                                                        elseif (!isset($ktgr3))
                                                        {
                                                            echo $ktgrdok;
                                                        }
                                                        ?>" readonly>
                                                    <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_ktgr))
                                                            echo $error_ktgr ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="editktgr" class="col-sm-2 col-form-label"><b>Kata
                                                            Pengganti</b><b style="color: red"> *</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="editktgr" name="editktgr"
                                                            value="<?php if (isset($editktgr))
                                                            echo $editktgr ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_ktgred))
                                                            echo $error_ktgred ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a style="float: left; font-size: 12px">Ket. :</a>
                                                <br>
                                                <b style="color: red">* </b><a style="font-size: 12px">= Wajib diisi!</a>
                                                <br><br>
                                                <button type="submit" name="butonedit" value="butonedit" class="btn btn-primary"
                                                    style="float: right;"><b>✓ Submit</b></button>
                                                <a type="submit" class="btn btn-danger"
                                                    href="../lihat-subadmin/lihat-ktgr-subadmin.php" style="float: left;"><b>←
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
<?php endif ?>
<!-- END of FORM -->