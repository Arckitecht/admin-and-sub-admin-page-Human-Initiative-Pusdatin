<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body onload="zoom_auto()" class="sb-nav-fixed">
    <div style="background-image: url('assets/images/hilogin_1.png'); width: 100%; height: 100%; position: fixed">
        <main>
            <div class="container-fluid" style="width: 35%;">
                <div class="card mb-4 border-0 rounded-lg"
                    style='margin-top: 22%; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);'>
                    <div class="card-header" style='background-color: rgb(37, 150, 190);'>
                        <h3 class="text-center my-4" style='color: white'><b>Pusat Data dan
                                Informasi</b></h3>
                    </div>
                    <div class="card-body">
                        <center>
                            <img src='assets/images/Human_1.png'>
                        </center>
                        <form action="login-check.php" method="POST" class="login-email">
                            <a for="username" style='font-weight: lighter'>Username</a>
                            <input class="form-control" type="text" name="username" id="username" style='font-weight: lighter'>
                            <div class='error' style='color:red; font-size: 12px;'>
                                <?php if (isset($_GET["msg"]) && $_GET["msg"] == 'failed')
                                    echo '*Email / Password anda salah!'; ?>
                            </div>
                            <a for="password" style='font-weight: lighter'>Password</a>
                            <input class="form-control" type="password" name="password" id="password" style='font-weight: lighter'>
                            <div class='error' style='color:red; font-size: 12px;'>
                                <?php if (isset($_GET["msg"]) && $_GET["msg"] == 'failed')
                                    echo '*Email / Password anda salah!'; ?>
                            </div>
                            <input style="color: black; font-size: 12px;" type="checkbox" onclick="myFunctionreg()"><a
                                style="color: black; font-size: 12px;">
                                Lihat
                                Password</a>
                            <br>
                            <center>
                                <div class="mt-2 mb-0">
                                    <button name="login" type="submit" value="Log in" class="btn btn-primary login"
                                        style='box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);'><b>Login</b></button>
                                </div>
                            </center>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3" style='background-color: rgb(37, 150, 190);'>
                        <div class="small"><a style='color: white'>Belum Punya Akun?
                                <a href="register.php" style='font-weight: bold; color: white'>Daftar
                                    Sekarang</a></a></div>
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
            var x = document.getElementById("password");
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