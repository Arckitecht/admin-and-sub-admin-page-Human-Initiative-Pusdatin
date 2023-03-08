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

        $ktgr1 = $_POST['inputktgr1'];

        $ktgr2 = $_POST['inputktgr2'];

        // Unit (Squad / Divisi / Cabang)
        $unit1  = $_POST['inputunit1'];
        $unit_1 = $_POST['inputunit1'];

        $unit2  = $_POST['inputunit2'];
        $unit_2 = $_POST['inputunit2'];

        $unit3  = $_POST['inputunit3'];
        $unit_3 = $_POST['inputunit3'];

        $unit4  = $_POST['inputunit4'];
        $unit_4 = $_POST['inputunit4'];

        if ($unit_1 == $unit_2 or $unit_1 == $unit_3 or $unit_1 == $unit_4 or $unit_2 == $unit_3 or $unit_2 == $unit_4 or $unit_3 == $unit_4)
        {
            $error_unt1 = "*Pengisian Unit tidak boleh ada yang sama antara yang satu dengan yang lainnya!<br>";
            $error_unt2 = "*Pengisian Unit tidak boleh ada yang sama antara yang satu dengan yang lainnya!<br>";
            $error_unt3 = "*Pengisian Unit tidak boleh ada yang sama antara yang satu dengan yang lainnya!<br>";
            $error_unt4 = "*Pengisian Unit tidak boleh ada yang sama antara yang satu dengan yang lainnya!<br>";
            $valid      = FALSE;
        }

        $judul = test_input($_POST["inputjudul"]);

        $pengarang = test_input($_POST["inputpengarang"]);

        $penerbit = test_input($_POST["inputpenerbit"]);

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

        $filename = $_FILES["inputfoto"]["name"];
        $tempname = $_FILES["inputfoto"]["tmp_name"];
        $folder   = "../assets/imageinput/" . $filename;
        if (!empty($_FILES["inputfoto"]["name"]))
        {
            $allowed       = array('jpeg', 'png', 'jpg');
            $imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
            $fileinfo      = @getimagesize($_FILES["inputfoto"]["tmp_name"]);
            $width         = $fileinfo[0];
            $height        = $fileinfo[1];
            if (!in_array($imageFileType, $allowed))
            {
                $error_foto = "*Format Gambar Salah! (Hanya .jpg, .jpeg, atau .png)";
                $valid      = FALSE;
            }
            elseif ($width != 380 or $height != 500)
            {
                $error_foto = "*Ukuran gambar harus 380x500 pixel (px)!";
                $valid      = FALSE;
            }
        }

        $pdfname     = $_FILES["inputpdf"]["name"];
        $temppdfname = $_FILES["inputpdf"]["tmp_name"];
        $folderpdf   = "../assets/pdf/" . $pdfname;
        if (!empty($_FILES["inputpdf"]["name"]))
        {
            $allowedpdf       = array('pdf');
            $imageFileTypepdf = pathinfo($pdfname, PATHINFO_EXTENSION);
            $maxsize          = 30000000;
            if (!in_array($imageFileTypepdf, $allowedpdf))
            {
                $error_pdf = "*Format File Salah! (Hanya .pdf)";
                $valid     = FALSE;
            }
            elseif ($_FILES['inputpdf']['size'] > $maxsize)
            {
                $error_pdf = "*Ukuran file maksimal 30 Mb!";
                $valid     = FALSE;
            }
        }

        $thn = test_input($_POST["inputthn"]);
        if (!empty($thn))
        {
            if (strlen((string)$thn) <= 3 or strlen((string)$thn) >= 5)
            {
                $error_thn = "*Tahun Terbit hanya terdiri dari 4 karakter!<br>";
                $valid     = FALSE;
            }
        }

        if ($valid)
        {
            if ($filename == '' and $pdfname == '' and $ktgr1 == '-- Pilih Jenis Dokumen --' and $ktgr2 == '-- Pilih Jenis Akses --' and $unit1 == '-- Pilih Unit 1 --' and $unit2 == '-- Pilih Unit 2 --' and $unit3 == '-- Pilih Unit 3 --' and $unit4 == '-- Pilih Unit 4 --' and $judul == '' and $pengarang == '' and $penerbit == '')
            {
                $messageNO = "Anda belum mengisi apapun!";
                echo "<script type='text/javascript'>alert('$messageNO');</script>";
            }
            else
            {
                $queryedit =
                "UPDATE `book`
                SET Tgledit=NOW()
                , Gambar=CASE WHEN '$filename'!='' THEN '$filename' ELSE Gambar END
                , PDF= CASE WHEN '$pdfname'!='' THEN '$pdfname' ELSE PDF END
                , JenisDok= CASE WHEN '$ktgr1'!='-- Pilih Jenis Dokumen --' THEN '$ktgr1' ELSE JenisDok END
                , JenisAkses= CASE WHEN '$ktgr2'!='-- Pilih Jenis Akses --' THEN '$ktgr2' ELSE JenisAkses END
                , Unit1= CASE WHEN '$unit1'!='-- Pilih Unit 1 --' THEN '$unit1' ELSE Unit1 END
                , Unit2= CASE WHEN '$unit2'!='-- Pilih Unit 2 --' THEN '$unit2' ELSE Unit2 END
                , Unit3= CASE WHEN '$unit3'!='-- Pilih Unit 3 --' THEN '$unit3' ELSE Unit3 END
                , Unit4= CASE WHEN '$unit4'!='-- Pilih Unit 4 --' THEN '$unit4' ELSE Unit4 END
                , Judul= CASE WHEN '$judul'!='' THEN '$judul' ELSE Judul END
                , TahunTerbit= CASE WHEN '$thn'!='' THEN '$thn' ELSE TahunTerbit END
                , Pengarang= CASE WHEN '$pengarang'!='' THEN '$pengarang' ELSE Pengarang END
                , Penerbit= CASE WHEN '$penerbit'!='' THEN '$penerbit' ELSE Penerbit END
                WHERE BookID='$iddok'";
                $result    = $conn->query($queryedit);
                if (!$result)
                {
                    die("Tidak bisa menyelesaikan query </br>" . $conn->$error . "</br> Query:" . $query);
                }
                else
                {
                    if (move_uploaded_file($tempname, $folder) or move_uploaded_file($temppdfname, $folderpdf))
                    {
                        $message = "Berhasil Mengedit Data!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else
                    {
                        $message = "Berhasil Mengedit Data!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                }
            }
        }
        else if ($valid = FALSE)
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
                                    <b style="color: white;">Form Edit Data Dokumen</b>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $bookid    = $_GET['IDBook'];
                                    $book_data = mysqli_query($conn, "SELECT * FROM book WHERE BookID='$bookid'");
                                    while ($rows = mysqli_fetch_array($book_data))
                                    {
                                        ?>
                                        <div class="container overflow-hidden">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputiddok" class="col-sm-2 col-form-label"><b>ID
                                                            Dokumen</b><b style="color: red"> *</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputiddok"
                                                            name="inputiddok" value="<?php if (isset($iddok))
                                                                echo $bookid;
                                                            if (!isset($iddok))
                                                                echo $bookid; ?>" readonly>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_iddok))
                                                                echo $error_iddok ?>
                                                            </div>
                                                            <a style="font-size: 12px;">*Katalog Dokumen : </a><a
                                                                href='../lihat/lihat-dok.php' style="font-size: 15px;">Klik</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                        <label for="inputfoto" class="col-sm-2 col-form-label"><b>Upload
                                                                Gambar</b></label>
                                                        <div class="col-sm-10">
                                                            <input id="inputfoto" name="inputfoto" type="file" class="form-control"
                                                                accept="image/png, image/jpg, image/jpeg">
                                                            <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_foto))
                                                                echo $error_foto
                                                                ?>
                                                            </div>
                                                            <a style="color: black; font-size: 12px;">*Format gambar harus .jpg,
                                                                .jpeg, atau .png!<br>*Pastikan ukuran gambar <label
                                                                    style="color: red">380x500 pixel</label> (px)!<br>*Belum
                                                                mengubah ukuran gambar? </a><a href="https://imageresizer.com/"
                                                                target="_blank" style="font-size: 15px;">Klik</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                        <label for="inputpdf" class="col-sm-2 col-form-label"><b>Upload
                                                                PDF</b></label>
                                                        <div class="col-sm-10">
                                                            <input id="inputpdf" name="inputpdf" type="file" class="form-control"
                                                                accept="application/pdf">
                                                            <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_pdf))
                                                                echo $error_pdf
                                                                ?>
                                                            </div>
                                                            <a style="color: black; font-size: 12px;">*Format file harus
                                                                .pdf!<br>*Ukuran file maksimal <label style="color: red">30
                                                                    Mb</label>!<br>*Ingin kompres ukuran file? </a><a
                                                                href="https://smallpdf.com/compress-pdf" target="_blank"
                                                                style="font-size: 15px;">Klik</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                        <label for="inputktgr1" class="col-sm-2 col-form-label"><b>Jenis
                                                                Dokumen</b></label>
                                                        <div class="col-sm-10">
                                                            <select type="select" class="form-control" id="inputktgr1"
                                                                name="inputktgr1">
                                                                <?php
                                                            if (isset($ktgr1) and $ktgr1 != '-- Pilih Jenis Dokumen --')
                                                            {
                                                                ?>
                                                                <option value="<?php if (isset($ktgr1))
                                                                    echo $ktgr1 ?>"><?php echo $ktgr1 ?></option>
                                                                <option value="-- Pilih Jenis Dokumen --">-- Pilih Jenis Dokumen --
                                                                </option>
                                                                <?php
                                                            }
                                                            elseif (isset($ktgr1) or $ktgr1 == '-- Pilih Jenis Dokumen --')
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Jenis Dokumen --">-- Pilih Jenis Dokumen --
                                                                </option>
                                                                <?php
                                                            }
                                                            elseif (!isset($ktgr1))
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Jenis Dokumen --">-- Pilih Jenis Dokumen --
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            $resultt1 = $conn->query('SELECT JenisDok FROM jenis_dok');

                                                            while ($dataa1 = $resultt1->fetch_object())
                                                            {
                                                                echo
                                                                    '<option value="' . $dataa1->JenisDok . '">' . $dataa1->JenisDok . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <b style='font-size: 12px;'>Jenis Dokumen Saat Ini : </b><b
                                                            style='color: red; font-size: 12px;'>
                                                            <?php echo $rows['JenisDok']; ?>
                                                        </b>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputktgr2" class="col-sm-2 col-form-label"><b>Jenis
                                                            Akses</b></label>
                                                    <div class="col-sm-10">
                                                        <select type="select" class="form-control" id="inputktgr2"
                                                            name="inputktgr2">
                                                            <?php
                                                            if (isset($ktgr2) and $ktgr2 != '-- Pilih Jenis Akses --')
                                                            {
                                                                ?>
                                                                <option value="<?php if (isset($ktgr2))
                                                                    echo $ktgr2 ?>"><?php echo $ktgr2 ?></option>
                                                                <option value="-- Pilih Jenis Akses --">-- Pilih Jenis Akses --
                                                                </option>
                                                                <?php
                                                            }
                                                            elseif (isset($ktgr2) or $ktgr2 == '-- Pilih Jenis Akses --')
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Jenis Akses --">-- Pilih Jenis Akses --
                                                                </option>
                                                                <?php
                                                            }
                                                            elseif (!isset($ktgr2))
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Jenis Akses --">-- Pilih Jenis Akses --
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            $resultt2 = $conn->query('SELECT JenisAkses FROM jenis_akses');

                                                            while ($dataa2 = $resultt2->fetch_object())
                                                            {
                                                                echo
                                                                    '<option value="' . $dataa2->JenisAkses . '">' . $dataa2->JenisAkses . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <b style='font-size: 12px;'>Jenis Akses Saat Ini : </b><b
                                                            style='color: red; font-size: 12px;'>
                                                            <?php echo $rows['JenisAkses']; ?>
                                                        </b>
                                                    </div>
                                                </div>
                                                <center style="margin-top: 3%; background-color: #5a5a5a; border-radius: 50px;">
                                                    <hr size="4px" color="black"
                                                        style="background-color: black; border-radius: 50px;" />
                                                </center>
                                                <center>
                                                    <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                        <label class="col-sm-3 col-form-label"><b>Pilih Unit</b></label>
                                                    </div>
                                                </center>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputunit1" class="col-sm-2 col-form-label"><b>Unit
                                                            1</b></label>
                                                    <div class="col-sm-10">
                                                        <select type="select" class="form-control" id="inputunit1"
                                                            name="inputunit1">
                                                            <?php
                                                            if (isset($unit1) and $unit1 != '-- Pilih Unit 1 --')
                                                            {
                                                                ?>
                                                                <option value="<?php if (isset($unit1))
                                                                    echo $unit1 ?>"><?php echo $unit1 ?></option>
                                                                <option value="-- Pilih Unit 1 --">-- Pilih Unit 1 --</option>
                                                                <?php
                                                            }
                                                            elseif (isset($unit1) or $unit1 == '-- Pilih Unit 1 --')
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Unit 1 --">-- Pilih Unit 1 --</option>
                                                                <?php
                                                            }
                                                            elseif (!isset($unit1))
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Unit 1 --">-- Pilih Unit 1 --</option>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            $result_unit = $conn->query("SELECT * FROM `unit`");

                                                            while ($data_unit = $result_unit->fetch_object())
                                                            {
                                                                echo
                                                                    '<option value="' . $data_unit->Unit . '">' . $data_unit->Unit . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_unt1))
                                                                echo $error_unt1; ?>
                                                        </div>
                                                        <b style='font-size: 12px;'>Unit 1 Saat Ini : </b><b
                                                            style='color: red; font-size: 12px;'>
                                                            <?php echo $rows['Unit1']; ?>
                                                        </b>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputunit2" class="col-sm-2 col-form-label"><b>Unit
                                                            2</b></label>
                                                    <div class="col-sm-10">
                                                        <select type="select" class="form-control" id="inputunit2"
                                                            name="inputunit2">
                                                            <?php
                                                            if (isset($unit2) and $unit2 != '-- Pilih Unit 2 --')
                                                            {
                                                                ?>
                                                                <option value="<?php if (isset($unit2))
                                                                    echo $unit2 ?>"><?php echo $unit2 ?></option>
                                                                <option value="-- Pilih Unit 2 --">-- Pilih Unit 2 --</option>
                                                                <?php
                                                            }
                                                            elseif (isset($unit2) or $unit2 == '-- Pilih Unit 2 --')
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Unit 2 --">-- Pilih Unit 2 --</option>
                                                                <?php
                                                            }
                                                            elseif (!isset($unit2))
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Unit 2 --">-- Pilih Unit 2 --</option>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            $result_unit2 = $conn->query("SELECT * FROM `unit`");

                                                            while ($data_unit2 = $result_unit2->fetch_object())
                                                            {
                                                                echo
                                                                    '<option value="' . $data_unit2->Unit . '">' . $data_unit2->Unit . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_unt2))
                                                                echo $error_unt2; ?>
                                                        </div>
                                                        <?php if ($rows['Unit2'] != NULL): ?>
                                                            <b style='font-size: 12px;'>Unit 2 Saat Ini : </b><b
                                                                style='color: red; font-size: 12px;'>
                                                                <?php echo $rows['Unit2']; ?>
                                                            </b>
                                                        <?php endif ?>
                                                        <?php if ($rows['Unit2'] == NULL): ?>
                                                            <b style='font-size: 12px;'>Unit 2 Saat Ini : </b><b
                                                                style='color: red; font-size: 12px;'>
                                                                --
                                                            </b>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputunit3" class="col-sm-2 col-form-label"><b>Unit
                                                            3</b></label>
                                                    <div class="col-sm-10">
                                                        <select type="select" class="form-control" id="inputunit3"
                                                            name="inputunit3">
                                                            <?php
                                                            if (isset($unit3) and $unit3 != '-- Pilih Unit 3 --')
                                                            {
                                                                ?>
                                                                <option value="<?php if (isset($unit3))
                                                                    echo $unit3 ?>"><?php echo $unit3 ?></option>
                                                                <option value="-- Pilih Unit 3 --">-- Pilih Unit 3 --</option>
                                                                <?php
                                                            }
                                                            elseif (isset($unit3) or $unit3 == '-- Pilih Unit 3 --')
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Unit 3 --">-- Pilih Unit 3 --</option>
                                                                <?php
                                                            }
                                                            elseif (!isset($unit3))
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Unit 3 --">-- Pilih Unit 3 --</option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_unt3))
                                                                echo $error_unt3; ?>
                                                        </div>
                                                        <?php if ($rows['Unit3'] != NULL): ?>
                                                            <b style='font-size: 12px;'>Unit 3 Saat Ini : </b><b
                                                                style='color: red; font-size: 12px;'>
                                                                <?php echo $rows['Unit3']; ?>
                                                            </b>
                                                        <?php endif ?>
                                                        <?php if ($rows['Unit3'] == NULL): ?>
                                                            <b style='font-size: 12px;'>Unit 3 Saat Ini : </b><b
                                                                style='color: red; font-size: 12px;'>
                                                                --
                                                            </b>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputunit4" class="col-sm-2 col-form-label"><b>Unit
                                                            4</b></label>
                                                    <div class="col-sm-10">
                                                        <select type="select" class="form-control" id="inputunit4"
                                                            name="inputunit4">
                                                            <?php
                                                            if (isset($unit4) and $unit4 != '-- Pilih Unit 4 --')
                                                            {
                                                                ?>
                                                                <option value="<?php if (isset($unit4))
                                                                    echo $unit4 ?>"><?php echo $unit4 ?></option>
                                                                <option value="-- Pilih Unit 4 --">-- Pilih Unit 4 --</option>
                                                                <?php
                                                            }
                                                            elseif (isset($unit4) or $unit4 == '-- Pilih Unit 4 --')
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Unit 4 --">-- Pilih Unit 4 --</option>
                                                                <?php
                                                            }
                                                            elseif (!isset($unit4))
                                                            {
                                                                ?>
                                                                <option value="-- Pilih Unit 4 --">-- Pilih Unit 4 --</option>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            $result_unit4 = $conn->query("SELECT * FROM `unit`");

                                                            while ($data_unit4 = $result_unit4->fetch_object())
                                                            {
                                                                echo '<option value="' . $data_unit4->Unit . '">' . $data_unit4->Unit . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_unt4))
                                                                echo $error_unt4; ?>
                                                        </div>
                                                        <?php if ($rows['Unit4'] != NULL): ?>
                                                            <b style='font-size: 12px;'>Unit 4 Saat Ini : </b><b
                                                                style='color: red; font-size: 12px;'>
                                                                <?php echo $rows['Unit4']; ?>
                                                            </b>
                                                        <?php endif ?>
                                                        <?php if ($rows['Unit4'] == NULL): ?>
                                                            <b style='font-size: 12px;'>Unit 4 Saat Ini : </b><b
                                                                style='color: red; font-size: 12px;'>
                                                                --
                                                            </b>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <center
                                                    style="margin-top: 3%; margin-bottom: 3%; background-color: #5a5a5a; border-radius: 50px;">
                                                    <hr size="4px" color="black"
                                                        style="background-color: black; border-radius: 50px;" />
                                                </center>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputjudul" class="col-sm-2 col-form-label"><b>Judul</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputjudul"
                                                            name="inputjudul" value="<?php if (isset($judul))
                                                                echo $judul;
                                                            if (!isset($judul))
                                                                echo $rows['Judul']; ?>">
                                                        <a style="color: black; font-size: 12px;">*Judul harus judul lengkap dan
                                                            tidak harus dikapitalkan semuanya!</a>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputthn" class="col-sm-2 col-form-label"><b>Tahun
                                                            Terbit</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" id="inputthn" name="inputthn"
                                                            value="<?php if (isset($thn))
                                                                echo $thn;
                                                            if (!isset($thn))
                                                                echo $rows['TahunTerbit']; ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_thn))
                                                                echo $error_thn; ?>
                                                        </div>
                                                        <a style="color: black; font-size: 12px;">*Tahun terbit dalam format
                                                            angka!
                                                            (Contoh: 2023, 2022, dst.)</a>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputpengarang"
                                                        class="col-sm-2 col-form-label"><b>Penulis</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputpengarang"
                                                            name="inputpengarang" value="<?php if (isset($pengarang))
                                                                echo $pengarang;
                                                            if (!isset($pengarang))
                                                                echo $rows['Pengarang']; ?>">
                                                        <a style="color: black; font-size: 12px;">*Nama penulis harus nama
                                                            lengkap!</a>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputpenerbit"
                                                        class="col-sm-2 col-form-label"><b>Penerbit</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputpenerbit"
                                                            name="inputpenerbit" value="<?php if (isset($penerbit))
                                                                echo $penerbit;
                                                            if (!isset($penerbit))
                                                                echo $rows['Penerbit']; ?>">
                                                    </div>
                                                </div>
                                                <a style="float: left; font-size: 12px">Ket. :</a>
                                                <br>
                                                <b style="color: red">* </b><a style="font-size: 12px">= Wajib diisi!</a>
                                                <br><br>
                                                <a type="submit" class="btn btn-danger" href="../lihat/lihat-dok.php"><b>←
                                                        Kembali</b></a>
                                                <button type="submit" name="submit" value="submit" class="btn btn-primary"
                                                    style="float: right;"><b>✓ Submit</b></button>
                                            </form>
                                        </div>
                                    <?php } ?>
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
            <?php require '../footer.php'; ?>
        </div>
    </body>
<?php endif ?>
<!-- END of FORM -->