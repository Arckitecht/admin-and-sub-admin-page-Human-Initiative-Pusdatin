<?php
require '../config.php';

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
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed" style="font-family: montserrat;">
        <nav class="sb-topnav navbar navbar-expand"
            style="box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75); background-color: white;">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="../index-subadmin.php"
                style="display: inline-block; margin-left: 49px; color: rgb(37, 150, 190)"><b>Pusdatin</b></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" style="margin-left: -43px"
                id="sidebarToggle" href="#!"><i class="fas fa-bars" style="color: #2e2d2d"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-6 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="color: #7c7c7c"><i class="fas fa-user fa-fw"
                            style="color: #2e2d2d"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../profile-subadmin.php" style="color: #2e2d2d"><i
                                    class='bi bi-eye-fill'></i> Lihat
                                Profil</a></li>
                        <li><a class="dropdown-item" href="../edit-subadmin/edit-profile-subadmin.php"
                                style="color: #2e2d2d"><i class='bi bi-pencil-square'></i> Edit Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../logout.php" style="color: #2e2d2d"><i
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
                            <a class="nav-link" href="../index-subadmin.php" style="color: #2e2d2d">
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
                                    <a class="nav-link" href="../lihat-subadmin/lihat-dok-subadmin.php"
                                        style="color: #2e2d2d"><i class="bi bi-journals"
                                            style="margin-right: 10px; font-size: 16px; color: #2e2d2d"></i>Dokumen</a>
                                    <a class="nav-link" href="../lihat-subadmin/lihat-ktgr-subadmin.php"
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
                                    <a class="nav-link" href="../lihat-subadmin/lihat-sub-subadmin.php"
                                        style="color: #2e2d2d"><i class="bi bi-person-square"
                                            style="margin-right: 10px; font-size: 17px; color: #2e2d2d"></i>
                                        Admin
                                    </a>
                                    <a class="nav-link" href="../lihat-subadmin/lihat-member-subadmin.php"
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
                    <div class="sb-sidenav-footer" style="background-color: rgb(37, 150, 190)">
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

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                crossorigin="anonymous"></script>
            <script src="../assets/js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
                crossorigin="anonymous"></script>
        <?php endif ?>