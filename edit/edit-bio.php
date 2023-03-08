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

        $username_user = $_SESSION['username'];

        $editbio = test_input($_POST['editbio']);
        if (strlen($editbio) > 200)
        {
            $error_bioed = "*Maksimal 200 karakter!";
            $valid       = FALSE;
        }

        if ($valid)
        {
            $editbiouser = 'UPDATE `user` SET Bio="' . $editbio . '" WHERE username="' . $username_user . '" ';
            $resultedit  = $conn->query($editbiouser);
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
                <div class="container-fluid" style="width: 70%; margin-top: 12%; margin-bottom: 12%">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="background-color: #2e2d2d;">
                                    <i class="bi bi-book"
                                        style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                                    <b style="color: white;">Tentang Saya</b>
                                </div>
                                <div class="card-body">
                                    <div class="container overflow-hidden">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                <label for="editbio" class="col-sm-2 col-form-label"><b>Tentang Saya</b></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="editbio" name="editbio"
                                                        value="<?php if (isset($editbio))
                                                            echo $editbio ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_bioed))
                                                            echo $error_bioed ?>
                                                        </div>
                                                        <a style="color: black; font-size: 12px;">*Maksimal 200 karakter!</a>
                                                    </div>
                                                </div>
                                                <button type="submit" name="butonedit" value="butonedit" class="btn btn-primary"
                                                    style="float: right;"><b>✓ Submit</b></button>
                                                <a type="submit" class="btn btn-danger" href="../profile.php"
                                                    style="float: left;"><b>←
                                                        Lihat Profil</b></a>
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
    </body>
<?php endif ?>
<!-- END of FORM -->