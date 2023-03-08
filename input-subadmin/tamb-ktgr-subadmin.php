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

    if (isset($_POST["tambah"]))
    {
        $valid = TRUE;

        $ktgr3 = test_input($_POST['inputktgr3']);
        $resultambil = mysqli_query($conn, "SELECT * FROM kategori_dok WHERE KategoriDok='$ktgr3'");
        if (empty($_POST['inputktgr3']))
        {
            $error_ktgr3 = "*Kategori Dokumen tidak boleh kosong!<br>";
            $valid       = FALSE;
        }
        elseif (mysqli_num_rows($resultambil) > 0)
        {
            $error_ktgr3 = "*Kategori Dokumen ini sudah ada dalam database! Masukkan yang baru!<br>";
            $valid       = FALSE;
        }

        if ($valid)
        {
            $result = mysqli_query($conn, "INSERT INTO kategori_dok (KategoriDok) VALUES('$ktgr3')");

            if (!$result)
            {
                die("Tidak bisa menyelesaikan query </br>" . $conn->$error . "</br> Query:" . $query);
            }
            else
            {
                $message = "Berhasil Menginput Data!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        else
        {
            $messageNO = "Gagal Menginput Data!";
            echo "<script type='text/javascript'>alert('$messageNO');</script>";
        }
    }

    ?>

    <!-- FORM Pengisian Data Dokumen Baru -->
    <div id="layoutSidenav_content" style="background-color: #fafafa">
        <main>
            <div class="container-fluid" style="width: 70%;">
                <h3 class="my-3" style="color: #2e2d2d">Tambah Kategori Dokumen <b
                        style="float: right; color: rgb(37, 150, 190)">SUB-ADMIN</b></h3>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header" style="background-color: #2e2d2d;">
                                <i class="bi bi-list-check"
                                    style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                                <b style="color: white;">Form Pengisian Kategori Dokumen</b>
                            </div>
                            <div class="card-body">
                                <div class="container overflow-hidden">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="row mb-3" style="align-items: center; justify-content: center;">
                                            <label for="inputktgr3" class="col-sm-2 col-form-label"><b>Kategori
                                                    Dokumen</b><b style="color: red"> *</b></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputktgr3" name="inputktgr3"
                                                    value="<?php if (isset($ktgr3))
                                                        echo $ktgr3 ?>">
                                                    <div class="error" style="color:red; font-size: 12px;">
                                                    <?php if (isset($error_ktgr3))
                                                        echo $error_ktgr3 ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <a style="float: left; font-size: 12px">Ket. :</a>
                                            <br>
                                            <b style="color: red">* </b><a style="font-size: 12px">= Wajib diisi!</a>
                                            <br><br>
                                            <a type="submit" class="btn btn-danger"
                                                href="../lihat-subadmin/lihat-ktgr-subadmin.php" style="float: left;"><b>←
                                                    Kembali</b></a>
                                            <button type="submit" name="tambah" value="tambah" class="btn btn-primary"
                                                style="float: right;"><b>+ Tambah</b></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script type="text/javascript">
                function zoom_auto() {
                    document.body.style.zoom = "100%"
                }
            </script>
        <?php require '../footer-subadmin.php'; ?>
    </div>
<?php endif ?>
<!-- END of FORM -->