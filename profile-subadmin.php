<?php
require 'config.php';

session_start();

if (isset($_SESSION['username'])):
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sub-Admin Page</title>
        <link href="assets/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed" style="font-family: montserrat;" onload="zoom_auto()">
        <nav class="sb-topnav navbar navbar-expand"
            style="box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75); background-color: white;">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index-subadmin.php"
                style="display: inline-block; margin-left: 49px; color: rgb(37, 150, 190)"><b>Pusdatin</b></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" style="margin-left: -59px"
                id="sidebarToggle" href="#!"><i class="fas fa-bars" style="color: #2e2d2d"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-6 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="color: #7c7c7c"><i class="fas fa-user fa-fw"
                            style="color: #2e2d2d"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile-subadmin.php" style="color: #2e2d2d"><i
                                    class='bi bi-eye-fill'></i> Lihat
                                Profil</a></li>
                        <li><a class="dropdown-item" href="edit-subadmin/edit-profile-subadmin.php"
                                style="color: #2e2d2d"><i class='bi bi-pencil-square'></i> Edit Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php" style="color: #2e2d2d"><i
                                    class="bi bi-box-arrow-left" style="color: red"></i> Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav"
                style="height: 100%; position: fixed; z-index: 2; top: 0; left: 0; display: inline-block; box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: white;">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading" style="color: #2e2d2d">Dashboard</div>
                            <a class="nav-link" href="index-subadmin.php" style="color: #2e2d2d">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: #2e2d2d"></i>
                                </div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading" style="color: #2e2d2d">Data & User</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                                style="color: #2e2d2d">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-database" style="color: #2e2d2d"></i>
                                </div>
                                Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"
                                        style="color: #2e2d2d"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="lihat-subadmin/lihat-dok-subadmin.php"
                                        style="color: #2e2d2d"><i class="bi bi-journals"
                                            style="margin-right: 10px; font-size: 16px; color: #2e2d2d"></i>Dokumen</a>
                                    <a class="nav-link" href="lihat-subadmin/lihat-ktgr-subadmin.php"
                                        style="color: #2e2d2d"><i class="bi bi-list-check"
                                            style="margin-right: 10px; font-size: 16px; color: #2e2d2d"></i>Kategori</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                                aria-expanded="false" aria-controls="collapsePages" style="color: #2e2d2d">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user" style="color: #2e2d2d"></i></div>
                                User
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"
                                        style="color: #2e2d2d"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="lihat-subadmin/lihat-sub-subadmin.php"
                                        style="color: #2e2d2d"><i class="bi bi-person-square"
                                            style="margin-right: 10px; font-size: 17px; color: #2e2d2d"></i>
                                        Admin
                                    </a>
                                    <a class="nav-link" href="lihat-subadmin/lihat-member-subadmin.php"
                                        style="color: #2e2d2d"><i class="bi bi-people-fill"
                                            style="margin-right: 10px; font-size: 16px; color: #2e2d2d"></i>
                                        Member
                                    </a>
                                </nav>
                            </div>
                            <center style="margin-top: 9px">
                                <hr style="color: #2e2d2d; margin-left: 18px; margin-right: 18px">
                            </center>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="background-color: rgb(37, 150, 190);">
                        <div class="small" style="color: white"><b>LOGGED IN as</b> :</div>
                        <?php
                        $user_data   = $_SESSION['username'];
                        $result_user = mysqli_query($conn, "SELECT * FROM user WHERE username='$user_data'");
                        $row_user    = mysqli_fetch_array($result_user);
                        echo "<div style='font-size: 14px; color: white'>" . $_SESSION['username'] . "<br>" . $row_user['Akses'] . "</div>";
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content" style="background-color: #fafafa">
                <main>
                    <h1 class="mt-4" style="margin-left: 25px; margin-top: 16px; color: rgb(37, 150, 190)"><b>Dashboard</b>
                    </h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active" style="margin-left: 25px;">Lihat Profil</li>
                        <li class="breadcrumb-item"><a href="index-subadmin.php" style="color: #33abf6">Pusat Data</a></li>
                    </ol>
                    <center
                        style="margin-left: 25px; margin-right: 25px; margin-bottom: 2%; background-color: #5a5a5a; border-radius: 50px;">
                        <hr size="3px" color="black" style="background-color: black; border-radius: 50px;" />
                    </center>
                    <center>
                        <h1 style="color: #2e2d2d; font-size: 28px;"><b>PROFIL</b></h1>
                    </center>
                    <div class="main-banner">
                        <center>
                            <div class="card"
                                style="max-width: 56rem; margin-top: 1%; margin-bottom: 2%; border: 1px solid black; border-radius: 12%; box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.75); background-color: white">
                                <div class="card-body">
                                    <?php
                                    $usernem = $_SESSION['username'];
                                    $sql     = "SELECT * FROM user WHERE username='$usernem'";
                                    $result  = mysqli_query($conn, $sql);

                                    while ($rows = mysqli_fetch_array($result))
                                    {
                                        if (($rows['Unit1']) == NULL)
                                        {
                                            $unit_1 = "<b>--</b>";
                                        }
                                        else
                                        {
                                            $unit_1 = $rows['Unit1'];
                                        }

                                        if (($rows['Unit2']) == NULL)
                                        {
                                            $unit_2 = "<b>--</b>";
                                        }
                                        else
                                        {
                                            $unit_2 = $rows['Unit2'];
                                        }

                                        if (($rows['Unit3']) == NULL)
                                        {
                                            $unit_3 = "<b>--</b>";
                                        }
                                        else
                                        {
                                            $unit_3 = $rows['Unit3'];
                                        }

                                        if (($rows['Unit4']) == NULL)
                                        {
                                            $unit_4 = "<b>--</b>";
                                        }
                                        else
                                        {
                                            $unit_4 = $rows['Unit4'];
                                        }
                                        ?>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="card"
                                                style="border: 0px solid transparent; border-radius: 50%; width: 100%; background-color: white">
                                                <div class="card-body">
                                                    <table border="0" align="left">
                                                        <tr>
                                                            <td>
                                                                <div>
                                                                    <img src="assets/images/user8-crop.gif" alt=""
                                                                        style="border-radius: 50%; border: 1px solid black; background-color: #A0C3D2; box-shadow: 0px 0px 8px 1px rgba(0,0,0,0.75)"
                                                                        height="120px" width="120px">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                &emsp;
                                                            </td>
                                                            <td>
                                                                <div
                                                                    style="font-weight: bold; font-size: 28px; color: #33abf6;">
                                                                    <?php echo $rows['Nama'] ?>
                                                                </div>
                                                                <div
                                                                    style="text-transform: uppercase; font-weight: bold; color: #2e2d2d;">
                                                                    <?php echo $rows['Akses'] ?>
                                                                </div>
                                                                <div style="font-weight: bold; color: #33abf6;">
                                                                    <label style="font-weight: bold; color: #2e2d2d;">ID
                                                                        :&ensp;</label>
                                                                    <?php echo '' . $rows['ID'] . '' ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="card-footer" align="justify"
                                                    style="background-color: transparent; border: 0px solid transparent;">
                                                    <b style="color: #33abf6;">Tentang Saya<a type="submit"
                                                            href="edit-subadmin/edit-bio-subadmin.php" style="margin-left: 10px"><i
                                                                class='bi bi-pencil-fill'
                                                                style="color: #2e2d2d; font-size: 14px"></i></a></b>
                                                    <br>
                                                    <a style="font-size: 12px" align="justify">
                                                        <?php
                                                        $biouser = mysqli_query($conn, "SELECT Bio FROM user WHERE username='$usernem'");
                                                        $row_bio = mysqli_fetch_array($biouser);
                                                        if ($row_bio['Bio'] != NULL)
                                                        {
                                                            echo $row_bio['Bio'];
                                                        }
                                                        else
                                                        {
                                                            echo "<label style='font-weight: lighter;'><b>-</b> Kosong <b>-</b></label>";
                                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <center style="margin-bottom: 2%; background-color: #5a5a5a; border-radius: 50px;">
                                            <hr size="3px" color="black" style="background-color: black; border-radius: 50px;">
                                        </center>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card"
                                                    style="border: 0px solid transparent; background-color: white">
                                                    <div class="card-header"
                                                        style="border: 0px solid transparent; background-color: transparent"
                                                        align="left">
                                                        <b style="color: #33abf6">Data Pribadi Anda</b>
                                                        <br>
                                                        <table border="0" align="left" cellpadding="4" cellspacing="0"
                                                            style="font-size: 13px; margin-left: -3px; margin-top: 8px">
                                                            <tr>
                                                                <td style="width: 102px">
                                                                    <div align="left" style="font-weight: bold; color: #2e2d2d">
                                                                        Nama</div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;:&nbsp;
                                                                </td>
                                                                <td>
                                                                    <div align="left">
                                                                        <?php echo $rows['Nama']; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 102px">
                                                                    <div align="left" style="font-weight: bold; color: #2e2d2d">
                                                                        Username</div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;:&nbsp;
                                                                </td>
                                                                <td>
                                                                    <div align="left">
                                                                        <?php echo $rows['username']; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="left" style="font-weight: bold; color: #2e2d2d">
                                                                        Email</div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;:&nbsp;
                                                                </td>
                                                                <td>
                                                                    <div align="left">
                                                                        <?php echo $rows['email']; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="left" style="font-weight: bold; color: #2e2d2d">
                                                                        No.
                                                                        Telp</div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;:&nbsp;
                                                                </td>
                                                                <td>
                                                                    <div align="left">
                                                                        <?php echo $rows['Telp']; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="left" style="font-weight: bold; color: #2e2d2d">
                                                                        Kelahiran
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;:&nbsp;
                                                                </td>
                                                                <td>
                                                                    <div align="left">
                                                                        <?php echo $rows['TmptLahir'] . ', ' . $rows['TglLahir']; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card"
                                                    style="border: 0px solid transparent; margin-right: 20px; background-color: white">
                                                    <div class="card-header"
                                                        style="border: 0px solid transparent; border-top-right-radius: 50%; border-top-left-radius: 50%; background-color: #2e2d2d">
                                                        <b style="color: white">Unit Anda</b>
                                                    </div>
                                                    <div class="card-body"
                                                        style="border: 1px solid #2e2d2d; border-bottom-right-radius: 10%; border-bottom-left-radius: 10%; background-color: white">
                                                        <table border="0" align="left" cellpadding="4" cellspacing="0"
                                                            style="font-size: 13px">
                                                            <tr>
                                                                <td style="width: 65px">
                                                                    <div align="left" style="font-weight: bold; color: #2e2d2d">
                                                                        Unit
                                                                        1
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;:&nbsp;
                                                                </td>
                                                                <td style="width: 300px">
                                                                    <div align="left">
                                                                        <?php echo $unit_1; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="left" style="font-weight: bold; color: #2e2d2d">
                                                                        Unit
                                                                        2
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;:&nbsp;
                                                                </td>
                                                                <td>
                                                                    <div align="left">
                                                                        <?php echo $unit_2; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="left" style="font-weight: bold; color: #2e2d2d">
                                                                        Unit
                                                                        3
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;:&nbsp;
                                                                </td>
                                                                <td>
                                                                    <div align="left">
                                                                        <?php echo $unit_3; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="left" style="font-weight: bold; color: #2e2d2d">
                                                                        Unit
                                                                        4
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;:&nbsp;
                                                                </td>
                                                                <td>
                                                                    <div align="left">
                                                                        <?php echo $unit_4; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <table border="0" align="center" style="margin-top: 3%">
                                        <tr>
                                            <td>
                                                <a type="submit" class="btn btn-primary" href="edit-subadmin/edit-profile-subadmin.php"
                                                    style="box-shadow: 0px 0px 8px 1px rgba(0,0,0,0.75);"><b><i
                                                            class='bi bi-pencil-square'></i> Edit
                                                        Profil</b></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a type="submit" class="btn btn-danger" href="index-subadmin.php" style="margin-bottom: 2%"><b>←
                                    Home</b></a>
                        </center>
                    </div>
                </main>
                <footer class="py-4 mt-auto"
                    style="background-color: #33abf6; bottom: 0; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div style="color: white; font-weight: lighter">&copy; 2017 - 2020 Human Initiative. All rights
                                reserved</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script type="text/javascript">
            function zoom_auto() {
                document.body.style.zoom = "100%"
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    </body>

    </html>

<?php endif ?>