<?php
require 'config.php';

session_start();
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["regist"]))
{
    $valid      = TRUE;
    $NamaMember = test_input($_POST["inputNamaMember"]);
    if (empty($NamaMember))
    {
        $error_NamaMember = "*Nama harus diisi!<br>";
        $valid            = FALSE;
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/", $NamaMember))
    {
        $error_NamaMember = "*Nama hanya dapat berupa alphabet dan spasi!<br>";
        $valid            = FALSE;
    }
    elseif (strlen($NamaMember) > 50)
    {
        $error_NamaMember = "*Maksimal 50 karakter!<br>";
        $valid            = FALSE;
    }

    $Username       = test_input($_POST["inputUsername"]);
    $query_user     = mysqli_query($conn, "SELECT username FROM user WHERE username='$Username'");
    $query_member11 = mysqli_query($conn, "SELECT Username FROM member WHERE Username='$Username'");
    if (empty($Username))
    {
        $error_Username = "*Username harus diisi!<br>";
        $valid          = FALSE;
    }
    elseif (mysqli_num_rows($query_user) != 0 or mysqli_num_rows($query_member11) != 0)
    {
        $error_Username = "*Username ini sudah digunakan!";
        $valid          = FALSE;
    }

    $EmailMember = test_input($_POST["inputEmailMember"]);
    $emailadmin  = mysqli_query($conn, "SELECT email FROM user WHERE email='$EmailMember'");
    $emailmember = mysqli_query($conn, "SELECT EmailMember FROM member WHERE EmailMember='$EmailMember'");
    if ($EmailMember == "")
    {
        $error_EmailMember = "*E-mail harus diisi!<br>";
        $valid             = FALSE;
    }
    elseif (!filter_var($EmailMember, FILTER_VALIDATE_EMAIL))
    {
        $error_EmailMember = "*Format Email Salah!<br>";
        $valid             = FALSE;
    }
    elseif (mysqli_num_rows($emailadmin) != 0 or mysqli_num_rows($emailmember) != 0)
    {
        $error_EmailMember = "*Email ini sudah digunakan!";
        $valid             = FALSE;
    }

    $Telp       = test_input($_POST["inputNoTelp"]);
    $telpadmin  = mysqli_query($conn, "SELECT Telp FROM user WHERE Telp='$Telp'");
    $telpmember = mysqli_query($conn, "SELECT Telp FROM member WHERE Telp='$Telp'");
    if (empty($Telp))
    {
        $error_Telp = "*No Telepon harus diisi!<br>";
        $valid      = FALSE;
    }
    elseif (!preg_match("/^[0-9]*$/", $Telp))
    {
        $error_Telp = "*No Telepon hanya dapat berupa angka!<br>";
        $valid      = FALSE;
    }
    elseif (strlen($Telp) > 13 or strlen($Telp) < 10)
    {
        $error_Telp = "*No Telepon maksimal 13 digit dan minimal 10 digit!<br>";
        $valid      = FALSE;
    }
    elseif (mysqli_num_rows($telpadmin) != 0 or mysqli_num_rows($telpmember) != 0)
    {
        $error_Telp = "*No Telepon ini sudah digunakan!";
        $valid      = FALSE;
    }

    $Password = test_input($_POST["inputPassword"]);
    if ($Password == "")
    {
        $error_Password = "*Password harus diisi!<br>";
        $valid          = FALSE;
    }
    elseif (strlen($Password) < 8)
    {
        $error_Password = "*Panjang password harus lebih dari atau sama dengan 8 karakter!<br>";
        $valid          = FALSE;
    }
    elseif (str_contains($Password, ' ') == TRUE)
    {
        $error_Password = "*Password tidak boleh mengandung spasi!<br>";
        $valid          = FALSE;
    }

    if ($valid)
    {
        $queryakun = "INSERT INTO member (NamaMember, EmailMember, Telp, Username, PasswordMember) VALUES('$NamaMember','$EmailMember','$Telp', '$Username','$Password')";
        $result    = $conn->query($queryakun);

        if (!$result)
        {
            die("Tidak bisa menyelesaikan query </br>" . $conn->$error . "</br> Query:" . $query);
        }
        else
        {
            $message = "Berhasil Mendaftar!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body onload="zoom_auto()" class="sb-nav-fixed">
    <div style="background-image: url('assets/images/hilogin_1.png'); width: 100%; height: 100%; position: fixed">
        <main>
            <div class="container-fluid" style="width: 35%;">
                <div class="card border-0 rounded-lg"
                    style='margin-top: 11%; margin-bottom: 11%; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);'>
                    <div class="card-header" style='background-color: rgb(37, 150, 190);'>
                        <h3 class="text-center my-4" style='color: white'><b>Buat Akun</b></h3>
                    </div>
                    <div class="card-body">
                        <center>
                            <img src='assets/images/Human_1.png'>
                        </center>
                        <br>
                        <form method="POST" enctype="multipart/form-data">
                            <div class='row'>
                                <div class='col-lg-6'>
                                    <a for="inputNamaMember" style='font-weight: lighter'>Nama<a
                                            style="color: red; font-weight: lighter">*</a></a>
                                    <input type="text" class="form-control" id="inputNamaMember" name="inputNamaMember"
                                        value="<?php if (isset($NamaMember))
                                            echo $NamaMember ?>" style='font-weight: lighter'>
                                        <div class="error" style="color:red; font-size: 12px;">
                                        <?php if (isset($error_NamaMember))
                                            echo $error_NamaMember; ?>
                                    </div>
                                </div>
                                <div class='col-lg-6'>
                                    <a for="username" style='font-weight: lighter'>Username<a
                                            style="color: red; font-weight: lighter">*</a></a>
                                    <input type="text" class="form-control" id="inputUsername" name="inputUsername"
                                        value="<?php if (isset($Username))
                                            echo $Username ?>" style='font-weight: lighter'>
                                        <div class="error" style="color:red; font-size: 12px;">
                                        <?php if (isset($error_Username))
                                            echo $error_Username; ?>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-6'>
                                    <a for="inputEmailMember" style='font-weight: lighter'>Email<a
                                            style="color: red; font-weight: lighter">*</a></a>
                                    <input type="email" class="form-control" id="inputEmailMember"
                                        name="inputEmailMember" value="<?php if (isset($EmailMember))
                                            echo $EmailMember ?>" style='font-weight: lighter'>
                                        <div class="error" style="color:red; font-size: 12px;">
                                        <?php if (isset($error_EmailMember))
                                            echo $error_EmailMember ?>
                                        </div>
                                    </div>
                                    <div class='col-lg-6'>
                                        <a for="inputNoTelp" style='font-weight: lighter'>No Telepon<a
                                            style="color: red; font-weight: lighter">*</a><a style='font-weight: lighter'> (Whatsapp)</a></a>
                                        <input type="tel" minlength="10" maxlength="13" class="form-control"
                                            id="inputNoTelp" name="inputNoTelp" value="<?php if (isset($Telp))
                                            echo $Telp ?>" placeholder="Contoh : 081234567891"
                                            style='font-weight: lighter'>
                                        <div class="error" style="color:red; font-size: 12px;">
                                        <?php if (isset($error_Telp))
                                            echo $error_Telp ?>
                                        </div>
                                    </div>
                                </div>
                                <a for="inputPassword" style='font-weight: lighter'>Password<a
                                            style="color: red; font-weight: lighter">*</a></a>
                                <input type="password" class="form-control" id="inputPassword" name="inputPassword" value="<?php if (isset($Password))
                                            echo $Password ?>" style='font-weight: lighter'>
                                <div class="error" style="color:red; font-size: 12px;">
                                <?php if (isset($error_Password))
                                            echo $error_Password ?>
                                </div>
                                <input style="color: black; font-size: 12px;" type="checkbox" onclick="myFunctionreg()"><a
                                    style="color: black; font-size: 12px;">
                                    Lihat
                                    Password</a>
                                <br>
                                <center>
                                    <div class="mt-2 mb-0">
                                        <button type="submit" name="regist" value="regist"
                                            class="btn btn-primary"><b>Daftar</b></button>
                                    </div>
                                </center>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3" style='background-color: rgb(37, 150, 190);'>
                            <div class="small"><a style='color: white'>Sudah Punya Akun? <a href="login.php"
                                        style='font-weight: bold; color: white'>Login</a></a></div>
                            <div class="small"><a href="index.php" style='color: white'>Kembali ke Halaman
                                    Utama</a></div>
                            <div class="small">
                                <i class="bi bi-telephone-outbound-fill" style='color: palegreen'></i>
                                <a href="https://api.whatsapp.com/send/?phone=6281280804561&text&type=phone_number&app_absent=0"
                                    style='color: white' target='blank_'> Butuh Bantuan?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script>
            function myFunctionreg() {
                var x = document.getElementById("inputPassword");
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>

    </html>