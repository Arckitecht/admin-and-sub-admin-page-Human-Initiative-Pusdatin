<!-- Header dan Sidebar -->
<?php
require '../header.php';
?>

<!-- VALIDASI Penginputan Form Edit Data User -->
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

    // VALIDATION PROCESS
    if (isset($_POST["ngedit"]))
    {
        $valid = TRUE;

        $username_user11 = $_SESSION['username'];

        // Nama
        $nama = test_input($_POST["inputnama"]);
        if (!preg_match("/^[a-zA-Z. ]*$/", $nama))
        {
            $error_nama = "*Nama hanya dapat berupa alphabet, titik, dan spasi!<br>";
            $valid      = FALSE;
        }
        elseif (strlen($nama) > 50)
        {
            $error_nama = "*Maksimal 50 karakter!<br>";
            $valid      = FALSE;
        }

        // ID User
        $idadmin_x     = test_input($_POST["inputidadmin"]);
        $idtest        = 'SELECT ID FROM `user` WHERE ID="' . $idadmin_x . '"';
        $result        = mysqli_query($conn, $idtest);
        $num_rows      = mysqli_num_rows($result);
        $usernamee_idu = $_SESSION['username'];
        $query_idu     = mysqli_query($conn, "SELECT * FROM user WHERE username='$usernamee_idu'");
        $query_row_idu = mysqli_fetch_object($query_idu);
        if (empty($idadmin_x))
        {
            $error_idadmin = "*ID User tidak boleh kosong!<br>";
            $valid         = FALSE;
        }
        elseif ($num_rows <= 0)
        {
            $error_idadmin = "*ID User tidak ada dalam database! Masukkan ID yang tepat!<br>";
            $valid         = FALSE;
        }
        elseif ($query_row_idu->ID == $idadmin_x)
        {
            $error_idadmin = "*Anda Tidak Bisa Mengedit Akun Pribadi Anda Di Sini!<br>";
            $valid         = FALSE;
        }

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

        // Nomor Handphone (Wajib Whatsapp)
        $notelp      = test_input($_POST["inputnotelp"]);
        $telpadmin   = mysqli_query($conn, "SELECT Telp FROM user WHERE Telp='$notelp'");
        $telpmember  = mysqli_query($conn, "SELECT Telp FROM member WHERE Telp='$notelp'");
        $telppribadi = mysqli_query($conn, "SELECT Telp FROM user WHERE username='$username_user11'");
        $rowtelp     = mysqli_fetch_object($telppribadi);
        if (!empty($notelp))
        {
            if (!preg_match("/^[0-9]*$/", $notelp))
            {
                $error_notelp = "*No Telepon hanya dapat berupa angka!";
                $valid        = FALSE;
            }
            elseif (!preg_match("/^[0-9]*$/", $notelp))
            {
                $error_notelp = "*No Telepon hanya dapat berupa angka!<br>";
                $valid        = FALSE;
            }
            elseif (strlen($notelp) >= 13 or strlen($notelp) <= 10)
            {
                $error_notelp = "*No Telepon maksimal 13 digit dan minimal 10 digit!<br>";
                $valid        = FALSE;
            }
            elseif ((mysqli_num_rows($telpadmin) != 0 or mysqli_num_rows($telpmember) != 0) and $notelp != $rowtelp->Telp)
            {
                $error_notelp = "*No Telepon ini sudah digunakan!";
                $valid        = FALSE;
            }
        }

        $lahir     = test_input($_POST["inputlahir"]);
        $TmptLahir = test_input($_POST["inputTempatLahir"]);

        $lahir = test_input($_POST["inputlahir"]);

        // E-Mail
        $email        = test_input($_POST["inputemail"]);
        $emailadmin   = mysqli_query($conn, "SELECT email FROM user WHERE email='$email'");
        $emailmember  = mysqli_query($conn, "SELECT EmailMember FROM member WHERE EmailMember='$email'");
        $emailpribadi = mysqli_query($conn, "SELECT email FROM user WHERE username='$username_user11'");
        $rowpribadi   = mysqli_fetch_object($emailpribadi);
        if (!empty($email))
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $error_email = "*Format Email Salah!<br>";
                $valid       = FALSE;
            }
            elseif ((mysqli_num_rows($emailadmin) != 0 or mysqli_num_rows($emailmember) != 0) and $email != $rowpribadi->email)
            {
                $error_email = "*Email ini sudah digunakan!";
                $valid       = FALSE;
            }
        }

        // Password
        $passwordreg = test_input($_POST["inputpasswordreg"]);
        if (!empty($passwordreg))
        {
            if (strlen($passwordreg) < 8)
            {
                $error_passwordreg = "*Panjang password harus lebih dari atau sama dengan 8 karakter!<br>";
                $valid             = FALSE;
            }
            elseif (str_contains($passwordreg, ' ') == TRUE)
            {
                $error_passwordreg = "*Password tidak boleh mengandung spasi!<br>";
                $valid             = FALSE;
            }
        }

        // Insert the input to 'pusdatin' database if all the inputs are $valid = TRUE which means all the inputs are valid
        if ($valid)
        {
            if ($nama == '' and $notelp == '' and $email == '' and $unit1 == '-- Pilih Unit 1 --' and $unit2 == '-- Pilih Unit 2 --' and $unit3 == '-- Pilih Unit 3 --' and $unit4 == '-- Pilih Unit 4 --' and $lahir == '' and $TmptLahir == '')
            {
                $messageNO = "Anda belum mengisi apapun!";
                echo "<script type='text/javascript'>alert('$messageNO');</script>";
            }
            else
            {
                $queryakun =
                "UPDATE `user`
                SET Nama= CASE WHEN '$nama'!='' THEN '$nama' ELSE Nama END
                , Unit1= CASE WHEN '$unit1'!='-- Pilih Unit 1 --' THEN '$unit1' ELSE Unit1 END
                , Unit2= CASE WHEN '$unit2'!='-- Pilih Unit 2 --' THEN '$unit2' ELSE Unit2 END
                , Unit3= CASE WHEN '$unit3'!='-- Pilih Unit 3 --' THEN '$unit3' ELSE Unit3 END
                , Unit4= CASE WHEN '$unit4'!='-- Pilih Unit 4 --' THEN '$unit4' ELSE Unit4 END
                , Telp= CASE WHEN '$notelp'!='' THEN '$notelp' ELSE Telp END
                , TmptLahir= CASE WHEN '$TmptLahir'!='' THEN '$TmptLahir' ELSE TmptLahir END
                , TglLahir= CASE WHEN '$lahir'!='' THEN '$lahir' ELSE TglLahir END
                , email= CASE WHEN '$email'!='' THEN '$email' ELSE email END
                , passwordu= CASE WHEN '$passwordreg'!='' THEN '$passwordreg' ELSE passwordu END
                WHERE ID='$idadmin_x'";
                $result    = $conn->query($queryakun);

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
        }
        elseif ($valid = FALSE)
        {
            $messageNO = "Gagal Mengedit Data!";
            echo "<script type='text/javascript'>alert('$messageNO');</script>";
        }
    }
    ?>

    <!-- FORM Edit Data User -->

    <body onload="zoom_auto()">
        <div id="layoutSidenav_content" style="background-color: #fafafa">
            <main>
                <div class="container-fluid" style="width: 70%;">
                    <h3 class="my-3" style="color: #2e2d2d">Edit Data Sub-Admin <b
                            style="float: right; color: rgb(37, 150, 190)">ADMIN</b></h3>
                    <div class="row">
                        <div class="col">
                            <div class="card mb-4">
                                <div class="card-header" style="background-color: #2e2d2d;">
                                    <i class="bi bi-person-square"
                                        style="margin-right: 2px; font-size: 16px; color: white"></i>
                                    <b style="color: white;">Form Edit Data Sub-Admin</b>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $idadmin_x = $_SESSION["idadmin"];
                                    $user_data = mysqli_query($conn, "SELECT * FROM user WHERE ID='$idadmin_x'");
                                    while ($rows = mysqli_fetch_array($user_data))
                                    {
                                        ?>
                                        <div class="container overflow-hidden">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputidadmin" class="col-sm-2 col-form-label"><b>ID
                                                            User</b><b style="color: red"> *</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputidadmin"
                                                            name="inputidadmin" value="<?php
                                                            if (!isset($idadmin))
                                                            {
                                                                echo $idadmin_x;
                                                            }
                                                            elseif (isset($idadmin))
                                                            {
                                                                echo $idadmin_x;
                                                            }
                                                            ?>" readonly>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_idadmin))
                                                                echo $error_idadmin ?>
                                                            </div>
                                                            <a style="font-size: 12px;">*Tabel Data User : </a><a
                                                                href='../lihat/lihat-sub.php' style="font-size: 15px;">Klik</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                        <label for="inputnama" class="col-sm-2 col-form-label"><b>Nama</b></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="inputnama" name="inputnama"
                                                                value="<?php if (isset($nama))
                                                                echo $nama;
                                                            if (!isset($nama))
                                                                echo $rows['Nama']; ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_nama))
                                                                echo $error_nama; ?>
                                                        </div>
                                                        <a style="color: black; font-size: 12px;">*Maksimal 50
                                                            karakter!<br>*Nama
                                                            hanya boleh mengandung
                                                            alfabet, titik, dan spasi!<br>*Nama harus nama lengkap!</a>
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
                                                            $result_unit = $conn->query('SELECT * FROM `unit`');

                                                            while ($data_unit = $result_unit->fetch_object())
                                                            {
                                                                echo
                                                                    '<option value="' . $data_unit->Unit . '">' . $data_unit->Unit . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_unt1))
                                                                echo $error_unt1 ?>
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
                                                            $result_unit2 = $conn->query('SELECT * FROM `unit`');

                                                            while ($data_unit2 = $result_unit2->fetch_object())
                                                            {
                                                                echo
                                                                    '<option value="' . $data_unit2->Unit . '">' . $data_unit2->Unit . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_unt2))
                                                                echo $error_unt2 ?>
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
                                                            <?php
                                                            $result_unit3 = $conn->query('SELECT * FROM `unit`');

                                                            while ($data_unit3 = $result_unit3->fetch_object())
                                                            {
                                                                echo
                                                                    '<option value="' . $data_unit3->Unit . '">' . $data_unit3->Unit . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_unt3))
                                                                echo $error_unt3 ?>
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
                                                            $result_unit4 = $conn->query('SELECT * FROM `unit`');

                                                            while ($data_unit4 = $result_unit4->fetch_object())
                                                            {
                                                                echo
                                                                    '<option value="' . $data_unit4->Unit . '">' . $data_unit4->Unit . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_unt4))
                                                                echo $error_unt4 ?>
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
                                                    <div class='col-lg-6'>
                                                        <label for="inputTempatlahir"><b>Tempat
                                                                Lahir</b></label>
                                                        <input type="text" class="form-control" id="inputTempatLahir"
                                                            name="inputTempatLahir" value="<?php if (isset($TmptLahir))
                                                                echo $TmptLahir;
                                                            if (!isset($TmptLahir))
                                                                echo $rows['TmptLahir']; ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_TmptLahir))
                                                                echo $error_TmptLahir; ?>
                                                        </div>
                                                    </div>
                                                    <div class='col-lg-6'>
                                                        <label for="inputlahir"><b>Tanggal
                                                                Lahir</b></label>
                                                        <input type="date" class="form-control" id="inputlahir"
                                                            name="inputlahir" value="<?php if (isset($lahir))
                                                                echo $lahir;
                                                            if (!isset($lahir))
                                                                echo $rows['TglLahir']; ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_lahir))
                                                                echo $error_lahir; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputnotelp" class="col-sm-2 col-form-label"><b>No.
                                                            Telp</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputnotelp"
                                                            name="inputnotelp" value="<?php if (isset($notelp))
                                                                echo $notelp;
                                                            if (!isset($notelp))
                                                                echo $rows['Telp'] ?>">
                                                            <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_notelp))
                                                                echo $error_notelp ?>
                                                            </div>
                                                            <a style="color: black; font-size: 12px;">*No. Handphone maksimal 13
                                                                digit dan minimal 10 digit!<br>*Gunakan angka seluruhnya! (Contoh:
                                                                08782******68, dst.)<br>*No. Handphone yang digunakan adalah yang
                                                                sudah
                                                                terhubung dengan Whatsapp!</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                        <label for="inputemail"
                                                            class="col-sm-2 col-form-label"><b>E-mail</b></label>
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" id="inputemail"
                                                                name="inputemail" value="<?php if (isset($email))
                                                                echo $email;
                                                            if (!isset($email))
                                                                echo $rows['email'] ?>">
                                                            <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_email))
                                                                echo $error_email ?>
                                                            </div>
                                                            <a style="color: black; font-size: 12px;">*Email yang digunakan harus
                                                                email
                                                                pribadi
                                                                dan dengan format yang benar.</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                        <label for="inputpasswordreg"
                                                            class="col-sm-2 col-form-label"><b>Password</b></label>
                                                        <div class="col-sm-10">
                                                            <input type="password" class="form-control" id="inputpasswordreg"
                                                                name="inputpasswordreg" value="<?php if (isset($passwordreg))
                                                                echo $passwordreg;
                                                            if (!isset($passwordreg))
                                                                echo $rows['passwordu'] ?>">
                                                            <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_passwordreg))
                                                                echo $error_passwordreg ?>
                                                            </div>
                                                            <a style="color: black; font-size: 12px;">*Password dapat diubah.</a>
                                                            <br>
                                                            <input style="color: black; font-size: 12px;" type="checkbox"
                                                                onclick="myFunction()"><a style="color: black; font-size: 12px;">
                                                                Lihat
                                                                Password</a>
                                                        </div>
                                                    </div>
                                                    <a style="float: left; font-size: 12px">Ket. :</a>
                                                    <br>
                                                    <b style="color: red">* </b><a style="font-size: 12px">= Wajib diisi!</a>
                                                    <br><br>
                                                    <a type="submit" class="btn btn-danger" href="../lihat/lihat-sub.php"
                                                        style="float: left;"><b>← Kembali</b></a>
                                                    <button type="submit" name="ngedit" value="ngedit" class="btn btn-primary"
                                                        style="float: right;"><b>✓ Submit</b></button>
                                                </form>
                                            </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- JS for 'Lihat Password' -->
                <script>
                    function myFunction() {
                        var x = document.getElementById("inputpasswordreg");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
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
<!-- END of Form -->