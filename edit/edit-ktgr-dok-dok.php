<!-- Header dan Sidebar -->
<?php
require '../header.php';
?>

<!-- VALIDASI Penginputan Form Edit Data Dokumen -->
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

    if (isset($_POST["submit"]))
    {
        $valid = TRUE;

        $ktgr3 = $_POST['inputktgr3'];
        $kt3   = "";
        foreach ($ktgr3 as $kategori3)
        {
            $kt3 .= nl2br("- " . $kategori3 . "\r\n");
        }

        $iddok    = test_input($_POST["inputiddok"]);
        $resulto1 = mysqli_query($conn, "SELECT * FROM book WHERE BookID='$iddok'");
        if (empty($iddok))
        {
            $error_iddok = "*ID Dokumen tidak boleh kosong!<br>";
            $valid       = FALSE;
        }
        elseif (strpos($iddok, 'B') != 0)
        {
            $error_iddok = "*Huruf B (kapital) harus berada pada bagian awal!<br>";
            $valid       = FALSE;
        }
        elseif (strpos($iddok, '-') != 1)
        {
            $error_iddok = "*ID Dokumen harus dipisahkan dengan strip (-) antara huruf B (kapital) dan angka!<br>";
            $valid       = FALSE;
        }
        elseif (substr_count($iddok, 'B') > 1)
        {
            $error_iddok = "*Hanya terdapat 1 huruf B dalam ID Dokumen!<br>";
            $valid       = FALSE;
        }
        elseif (substr_count($iddok, '-') > 1)
        {
            $error_iddok = "*Hanya terdapat 1 strip (-) dalam ID Dokumen!<br>";
            $valid       = FALSE;
        }
        elseif (!preg_match("/^[0-9B-]*$/", $iddok))
        {
            $error_iddok = "*ID Dokumen hanya bisa menggunakan huruf B (kapital), strip (-), dan angka!";
            $valid       = FALSE;
        }
        elseif (mysqli_num_rows($resulto1) <= 0)
        {
            $error_iddok = "*ID Dokumen tidak ada dalam database! Masukkan ID yang tepat!<br>";
            $valid       = FALSE;
        }

        if ($valid)
        {
            $queryedit =
            "UPDATE `book`
            SET Tgledit=NOW()
            , KategoriDok='$kt3'
            WHERE BookID='$iddok'";
            $result    = $conn->query($queryedit);

            if (!$result)
            {
                die("Tidak bisa menyelesaikan query </br>" . $conn->$error . "</br> Query:" . $query);
            }
            else
            {
                $message = "Berhasil Mengedit Data!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        elseif ($valid = FALSE)
        {
            $messageNO = "Gagal Mengedit Data!";
            echo "<script type='text/javascript'>alert('$messageNO');</script>";
        }
    }
    ?>

    <!-- FORM Edit Data Dokumen -->

    <body onload="zoom_auto()">
        <div id="layoutSidenav_content" style="background-color: #fafafa">
            <main>
                <div class="container-fluid" style="width: 70%;">
                    <h3 class="my-3" style="color: #2e2d2d">Edit Data Dokumen <b
                            style="float: right; color: rgb(37, 150, 190)">ADMIN</b></h3>
                    <div class="row">
                        <div class="col">
                            <div class="card mb-4">
                                <div class="card-header" style="background-color: #2e2d2d;">
                                    <i class="bi bi-journals"
                                        style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                                    <b style="color: white;">Form Edit Data Dokumen (Kategori Dokumen)</b>
                                </div>
                                <div class="card-body">
                                    <div class="container overflow-hidden">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                <label for="inputiddok" class="col-sm-2 col-form-label"><b>ID
                                                        Dokumen</b><b style="color: red"> *</b></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputiddok"
                                                        name="inputiddok" value="<?php
                                                        $bookid = $_GET['IDBook'];
                                                        if (isset($iddok))
                                                            echo $bookid;
                                                        if (!isset($iddok))
                                                            echo $bookid ?>" readonly>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_iddok))
                                                            echo $error_iddok ?>
                                                        </div>
                                                        <a style="font-size: 12px;">*Katalog Dokumen : </a><a
                                                            href='../lihat/lihat-dok.php' style="font-size: 15px;">Klik</a>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputktgr3" class="col-sm-2 col-form-label"><b>Kategori
                                                            Dokumen</b><b style="color: red"> *</b></label>
                                                    <div class="col-sm-10">
                                                        <center>
                                                            <table border="0">
                                                                <tr>
                                                                    <?php
                                                        $resultt3 = $conn->query('SELECT KategoriDok FROM kategori_dok');

                                                        $i   = 1;
                                                        $num = 0;
                                                        while ($dataa3 = mysqli_fetch_object($resultt3))
                                                        {
                                                            if (($num++ % 6 == 0) and $num > 1)
                                                                echo '</tr><tr>';
                                                            echo
                                                                '<td>
                                                                <input type="checkbox" name="inputktgr3[]" value="' . $dataa3->KategoriDok . '">' . $dataa3->KategoriDok . '&emsp;
                                                            </td>';
                                                            $i++;
                                                        }
                                                        ?>
                                                            </tr>
                                                        </table>
                                                    </center>
                                                </div>
                                            </div>
                                            <a style="float: left; font-size: 12px">Ket. :</a>
                                            <br>
                                            <b style="color: red">* </b><a style="font-size: 12px">= Wajib diisi!</a>
                                            <br><br>
                                            <a type="submit" class="btn btn-danger" href="../lihat/lihat-dok.php"><b>???
                                                    Kembali</b></a>
                                            <button type="submit" name="submit" value="submit" class="btn btn-primary"
                                                style="float: right;" id="checkBtn"><b>??? Submit</b></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#checkBtn').click(function () {
                            checked = $("input[type=checkbox]:checked").length;

                            if (!checked) {
                                alert("Anda Harus Mencentang Setidaknya 1 Kategori Dokumen");
                                return false;
                            }

                        });
                    });
                </script>
                <script type="text/javascript">
                    function zoom_auto() {
                        document.body.style.zoom = "100%"
                    }
                </script>
            </main>
            <?php require '../footer.php'; ?>
        </div>
    </body>
<?php endif ?>
<!-- END of FORM -->