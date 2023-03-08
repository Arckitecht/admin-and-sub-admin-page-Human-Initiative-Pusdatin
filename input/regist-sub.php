<!-- Header dan Sidebar -->
<?php
require '../header.php';
?>

<!-- VALIDASI Penginputan Form Registrasi User -->
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

    if (isset($_POST["regist"]))
    {
        $valid = TRUE;


        $nama = test_input($_POST["inputnama"]);
        if (empty($nama))
        {
            $error_nama = "*Nama tidak boleh kosong!<br>";
            $valid      = FALSE;
        }
        elseif (!preg_match("/^[a-zA-Z. ]*$/", $nama))
        {
            $error_nama = "*Nama hanya dapat berupa alphabet, titik, dan spasi!<br>";
            $valid      = FALSE;
        }
        elseif (strlen($nama) > 50)
        {
            $error_nama = "*Maksimal 50 karakter!<br>";
            $valid      = FALSE;
        }

        $notelp     = test_input($_POST["inputnotelp"]);
        $telpadmin  = mysqli_query($conn, "SELECT Telp FROM user WHERE Telp='$notelp'");
        $telpmember = mysqli_query($conn, "SELECT Telp FROM member WHERE Telp='$notelp'");
        if (empty($notelp))
        {
            $error_notelp = "*No Telepon tidak boleh kosong!";
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
        elseif (mysqli_num_rows($telpadmin) != 0 or mysqli_num_rows($telpmember) != 0)
        {
            $error_notelp = "*No Telepon ini sudah digunakan!";
            $valid        = FALSE;
        }

        // Unit (Squad / Divisi / Cabang)
        $unit1  = $_POST['inputunit1'];
        $unit_1 = $_POST['inputunit1'];
        if ($unit1 == "-- Pilih Unit 1 --")
        {
            $error_unt1 = "*Unit 1 (Utama) wajib diisi!<br>";
            $valid      = FALSE;
        }

        $unit2  = $_POST['inputunit2'];
        $unit_2 = $_POST['inputunit2'];
        if ($_POST['inputunit2'] == "-- Pilih Unit 2 --")
        {
            $unit2  = NULL;
            $unit_2 = "ads";
        }

        $unit3  = $_POST['inputunit3'];
        $unit_3 = $_POST['inputunit3'];
        if ($_POST['inputunit3'] == "-- Pilih Unit 3 --")
        {
            $unit3  = NULL;
            $unit_3 = "uds";
        }

        $unit4  = $_POST['inputunit4'];
        $unit_4 = $_POST['inputunit4'];
        if ($_POST['inputunit4'] == "-- Pilih Unit 4 --")
        {
            $unit4  = NULL;
            $unit_4 = "ods";
        }

        if ($unit_1 == $unit_2 or $unit_1 == $unit_3 or $unit_1 == $unit_4 or $unit_2 == $unit_3 or $unit_2 == $unit_4 or $unit_3 == $unit_4)
        {
            $error_unt1 = "*Pengisian Unit tidak boleh ada yang sama antara yang satu dengan yang lainnya!<br>";
            $error_unt2 = "*Pengisian Unit tidak boleh ada yang sama antara yang satu dengan yang lainnya!<br>";
            $error_unt3 = "*Pengisian Unit tidak boleh ada yang sama antara yang satu dengan yang lainnya!<br>";
            $error_unt4 = "*Pengisian Unit tidak boleh ada yang sama antara yang satu dengan yang lainnya!<br>";
            $valid      = FALSE;
        }

        $usernamee      = test_input($_POST["inputusername"]);
        $query_user     = mysqli_query($conn, "SELECT username FROM user WHERE username='$usernamee'");
        $query_member11 = mysqli_query($conn, "SELECT Username FROM member WHERE Username='$usernamee'");
        if (empty($usernamee))
        {
            $error_username = "*Username tidak boleh kosong!<br>";
            $valid          = FALSE;
        }
        elseif (mysqli_num_rows($query_user) != 0 or mysqli_num_rows($query_member11) != 0)
        {
            $error_username = "*Username ini sudah digunakan!";
            $valid          = FALSE;
        }

        $lahir = test_input($_POST["inputlahir"]);
        if (empty($lahir))
        {
            $error_lahir = "*Tempat, Tanggal Lahir tidak boleh kosong!<br>";
            $valid       = FALSE;
        }

        $TmptLahir = test_input($_POST["inputTempatLahir"]);
        if (empty($TmptLahir))
        {
            $error_TmptLahir = "*Tempat Lahir harus diisi!<br>";
            $valid           = FALSE;
        }

        $email       = test_input($_POST["inputemail"]);
        $emailadmin  = mysqli_query($conn, "SELECT email FROM user WHERE email='$email'");
        $emailmember = mysqli_query($conn, "SELECT EmailMember FROM member WHERE EmailMember='$email'");
        if ($email == "")
        {
            $error_email = "*E-mail harus diisi!<br>";
            $valid       = FALSE;
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error_email = "*Format Email Salah!<br>";
            $valid       = FALSE;
        }
        elseif (mysqli_num_rows($emailadmin) != 0 or mysqli_num_rows($emailmember) != 0)
        {
            $error_email = "*Email ini sudah digunakan!";
            $valid       = FALSE;
        }

        $passwordreg = test_input($_POST["inputpasswordreg"]);
        if ($passwordreg == "")
        {
            $error_passwordreg = "*Password harus diisi!<br>";
            $valid             = FALSE;
        }
        elseif (strlen($passwordreg) < 8)
        {
            $error_passwordreg = "*Panjang password harus lebih dari atau sama dengan 8 karakter!<br>";
            $valid             = FALSE;
        }
        elseif (str_contains($passwordreg, ' ') == TRUE)
        {
            $error_passwordreg = "*Password tidak boleh mengandung spasi!<br>";
            $valid             = FALSE;
        }

        if ($valid)
        {
            $queryakun = "INSERT INTO `user` (Nama, Akses, Unit1, Unit2, Unit3, Unit4, Telp, TmptLahir, TglLahir username, email, passwordu) VALUES('$nama','Sub-Admin','$unit1','$unit2','$unit3','$unit4','$notelp','$TmptLahir','$lahir','$usernamee','$email','$passwordreg')";
            $result    = $conn->query($queryakun);

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

    <!-- FORM Registrasi Data User Baru -->

    <body onload="zoom_auto()">
        <div id="layoutSidenav_content" style="background-color: #fafafa">
            <main>
                <div class="container-fluid" style="width: 70%;">
                    <h3 class="my-3" style="color: #2e2d2d">Registrasi Sub-Admin Baru <b
                            style="float: right; color: rgb(37, 150, 190)">ADMIN</b></h3>
                    <div class="row">
                        <div class="col">
                            <div class="card mb-4">
                                <div class="card-header" style="background-color: #2e2d2d;">
                                    <i class="bi bi-person-square"
                                        style="margin-right: 2px; font-size: 16px; color: white"></i>
                                    <b style="color: white;">Form Registrasi Sub-Admin Baru</b>
                                </div>
                                <div class="card-body">
                                    <div class="container overflow-hidden">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                <label for="inputnama" class="col-sm-2 col-form-label"><b>Nama</b><b
                                                        style="color: red"> *</b></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputnama" name="inputnama"
                                                        value="<?php if (isset($nama))
                                                            echo $nama ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_nama))
                                                            echo $error_nama ?>
                                                        </div>
                                                        <a style="color: black; font-size: 12px;">*Maksimal 50
                                                            karakter!<br>*Nama
                                                            hanya boleh mengandung
                                                            alfabet, titik, dan spasi!<br>*Nama harus nama lengkap!</a><br>
                                                        <a style="font-size: 12px;">*Tabel Data User : </a><a
                                                            href='../lihat/lihat-sub.php' style="font-size: 15px;">Klik</a>
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
                                                    <label for="inputunit1" class="col-sm-2 col-form-label"><b>Unit 1</b><b
                                                            style="color: red"> *</b></label>
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
                                                            echo $error_unt1 ?>
                                                        </div>
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
                                                            echo $error_unt2 ?>
                                                        </div>
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
                                                        $result_unit3 = $conn->query("SELECT * FROM `unit`");

                                                        while ($data_unit3 = $result_unit3->fetch_object())
                                                        {
                                                            echo '<option value="' . $data_unit3->Unit . '">' . $data_unit3->Unit . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_unt3))
                                                            echo $error_unt3 ?>
                                                        </div>
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
                                                            echo $error_unt4 ?>
                                                        </div>
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
                                                                Lahir</b><b style="color: red"> *</b></label>
                                                        <input type="text" class="form-control" id="inputTempatLahir"
                                                            name="inputTempatLahir" value="<?php if (isset($TmptLahir))
                                                            echo $TmptLahir ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_TmptLahir))
                                                            echo $error_TmptLahir ?>
                                                        </div>
                                                    </div>
                                                    <div class='col-lg-6'>
                                                        <label for="inputlahir"><b>Tanggal
                                                                Lahir</b><b style="color: red"> *</b></label>
                                                        <input type="date" class="form-control" id="inputlahir"
                                                            name="inputlahir" value="<?php if (isset($lahir))
                                                            echo $lahir ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_lahir))
                                                            echo $error_lahir ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputnotelp" class="col-sm-2 col-form-label"><b>No. Telp</b><b
                                                            style="color: red"> *</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputnotelp"
                                                            name="inputnotelp" value="<?php if (isset($notelp))
                                                            echo $notelp ?>">
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
                                                    <label for="inputusername" class="col-sm-2 col-form-label"><b>Username</b><b
                                                            style="color: red"> *</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputusername"
                                                            name="inputusername" value="<?php if (isset($usernamee))
                                                            echo $usernamee ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_username))
                                                            echo $error_username ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputemail" class="col-sm-2 col-form-label"><b>E-mail</b><b
                                                            style="color: red"> *</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="inputemail"
                                                            name="inputemail" value="<?php if (isset($email))
                                                            echo $email ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_email))
                                                            echo $error_email ?>
                                                        </div>
                                                        <a style="color: black; font-size: 12px;">*Email yang digunakan harus
                                                            email
                                                            pribadi dan dengan format yang benar.</a>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                    <label for="inputpasswordreg"
                                                        class="col-sm-2 col-form-label"><b>Password</b><b style="color: red">
                                                            *</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="inputpasswordreg"
                                                            name="inputpasswordreg" value="<?php if (isset($passwordreg))
                                                            echo $passwordreg ?>">
                                                        <div class="error" style="color:red; font-size: 12px;">
                                                        <?php if (isset($error_passwordreg))
                                                            echo $error_passwordreg ?>
                                                        </div>
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
                                                <button type="submit" name="regist" value="regist" class="btn btn-primary"
                                                    style="float: right;"><b>+ Registrasi</b></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Javascript untuk fitur 'Lihat Password' -->
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