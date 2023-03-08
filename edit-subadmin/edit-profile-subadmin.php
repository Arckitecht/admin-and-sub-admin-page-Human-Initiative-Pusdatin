<!-- Header dan Sidebar -->
<?php
require '../header-subadmin.php';
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
    if (isset($_POST["submit"]))
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
        $idadmin  = test_input($_POST["inputidadmin"]);
        $idtest   = 'SELECT ID FROM `user` WHERE ID="' . $idadmin . '"';
        $result   = mysqli_query($conn, $idtest);
        $num_rows = mysqli_num_rows($result);
        if (empty($idadmin))
        {
            $error_idadmin = "*ID User tidak boleh kosong!<br>";
            $valid         = FALSE;
        }
        elseif ($num_rows <= 0)
        {
            $error_idadmin = "*ID User tidak ada dalam database! Masukkan ID yang tepat!<br>";
            $valid         = FALSE;
        }
        $username_user1 = $_SESSION['username'];
        $iduseer        = mysqli_query($conn, "SELECT * FROM user WHERE username='$username_user1'");
        $rows_user      = mysqli_fetch_object($iduseer);
        if ($idadmin != $rows_user->ID)
        {
            $error_idadmin = "*Masukkan ID Anda!<br>";
            $valid         = FALSE;
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
            elseif (strlen($notelp) > 13 or strlen($notelp) < 10)
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

        // Username
        $usernamee       = test_input($_POST["inputusername"]);
        $query_user      = mysqli_query($conn, "SELECT username FROM user WHERE username='$usernamee'");
        $query_member11  = mysqli_query($conn, "SELECT Username FROM member WHERE Username='$usernamee'");
        $query_user11    = mysqli_query($conn, "SELECT username FROM user WHERE username='$username_user11'");
        $query_rows_user = mysqli_fetch_object($query_user11);
        if (!empty($usernamee))
        {
            if ((mysqli_num_rows($query_user) != 0 or mysqli_num_rows($query_member11) != 0) and $usernamee != $query_rows_user->username)
            {
                $error_username = "*Username ini sudah digunakan!";
                $valid          = FALSE;
            }
        }

        $lahir     = test_input($_POST["inputlahir"]);
        $TmptLahir = test_input($_POST["inputTempatLahir"]);

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
            if ($nama == '' and $notelp == '' and $email == '' and $passwordreg == '' and $usernamee == '' and $TmptLahir == '' and $lahir == '')
            {
                $messageNO = "Anda belum mengisi apapun!";
                echo "<script type='text/javascript'>alert('$messageNO');</script>";
            }
            else
            {
                $queryakun =
                "UPDATE `user`
                SET Nama= CASE WHEN '$nama'!='' THEN '$nama' ELSE Nama END
                , Telp= CASE WHEN '$notelp'!='' THEN '$notelp' ELSE Telp END
                , TmptLahir= CASE WHEN '$TmptLahir'!='' THEN '$TmptLahir' ELSE TmptLahir END
                , TglLahir= CASE WHEN '$lahir'!='' THEN '$lahir' ELSE TglLahir END
                , username= CASE WHEN '$usernamee'!='' THEN '$usernamee' ELSE username END
                , email= CASE WHEN '$email'!='' THEN '$email' ELSE email END
                , passwordu= CASE WHEN '$passwordreg'!='' THEN '$passwordreg' ELSE passwordu END
                WHERE ID='$idadmin'";
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
        else if ($valid = FALSE)
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
                    <h3 class="my-3" style="color: #2e2d2d">Edit Profil <b
                            style="float: right; color: rgb(37, 150, 190)">SUB-ADMIN</b></h3>
                    <div class="row">
                        <div class="col">
                            <div class="card mb-4">
                                <div class="card-header" style="background-color: #2e2d2d;">
                                    <i class="bi bi-person-fill"
                                        style="margin-right: 2px; font-size: 16px; color: white"></i>
                                    <b style="color: white;">Form Edit Profil</b>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $username_user = $_SESSION['username'];
                                    $user_data     = mysqli_query($conn, "SELECT * FROM user WHERE username='$username_user'");
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
                                                            name="inputidadmin" value="<?php if (isset($idadmin))
                                                                echo $idadmin;
                                                            if (!isset($idadmin))
                                                                echo $rows['ID'] ?>" readonly>
                                                            <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_idadmin))
                                                                echo $error_idadmin ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                        <label for="inputnama" class="col-sm-2 col-form-label"><b>Nama</b></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="inputnama" name="inputnama"
                                                                value="<?php if (isset($nama))
                                                                echo $nama;
                                                            if (!isset($nama))
                                                                echo $rows['Nama'] ?>">
                                                            <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_nama))
                                                                echo $error_nama ?>
                                                            </div>
                                                            <a style="color: black; font-size: 12px;">*Maksimal 50
                                                                karakter!<br>*Nama
                                                                hanya boleh mengandung
                                                                alfabet, titik, dan spasi!<br>*Nama harus nama lengkap!</a>
                                                        </div>
                                                    </div>
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
                                                                echo $error_TmptLahir ?>
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
                                                                echo $error_lahir ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="align-items: center; justify-content: center;">
                                                        <label for="inputnotelp" class="col-sm-2 col-form-label"><b>No.
                                                                Telp</b></label>
                                                        <div class="col-sm-10">
                                                            <input type="tel" minlength="10" maxlength="13" class="form-control" id="inputnotelp"
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
                                                        <label for="inputusername"
                                                            class="col-sm-2 col-form-label"><b>Username</b></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="inputusername"
                                                                name="inputusername" value="<?php if (isset($usernamee))
                                                                echo $usernamee;
                                                            if (!isset($usernamee))
                                                                echo $rows['username'] ?>">
                                                            <div class="error" style="color:red; font-size: 12px;">
                                                            <?php if (isset($error_username))
                                                                echo $error_username ?>
                                                            </div>
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
                                                    <a type="submit" class="btn btn-danger" href="../profile-subadmin.php"
                                                        style="float: left;"><b>← Lihat Profil</b></a>
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
            <?php require '../footer-subadmin.php'; ?>
        </div>
    </body>
<?php endif ?>
<!-- END of Form -->