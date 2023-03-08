<!-- Header dan Sidebar -->
<?php
require '../header-subadmin.php';
?>

<!-- VALIDASI Penginputan Form Edit Data User -->
<?php
include("../template/import.php");

if (isset($_SESSION['username'])):
    ?>

    <body onload="zoom_auto()">
        <div id="layoutSidenav_content" style="background-color: #fafafa">
            <main>
                <br>
                <div class="card mb-4" style="margin-left: 1%; margin-right: 1%; border: 1px solid #2e2d2d">
                    <div class="card-header" style="text-align: center; background-color: #2e2d2d">
                        <i class="bi bi-person-square"
                            style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                        <b style="color: white">Data Admin</b>
                    </div>
                    <div class="card-body tabel-mahasiswa cell-border">
                        <button onclick='window.location.reload(true);' class="btn btn-danger" style="float: right" title='Refresh'><b><i
                                    class="bi bi-arrow-clockwise"></i></b></button>
                        <br><br>
                        <table id="admin-tabel-mahasiswa" class="cell-border table-sm dataTable" cellspacing="1"
                            width="100%"
                            style="border: 0px solid; box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.75); font-size: 14px; table-layout: fixed;">
                            <thead style="background-color: #2e2d2d; color: white; text-align: center;">
                                <tr>
                                    <th style='word-wrap: break-word; width: 20px;'>ID</th>
                                    <th style='word-wrap: break-word; width: 100px;'>
                                        Nama
                                    </th>
                                    <th style='word-wrap: break-word;'>Akses</th>
                                    <th style='word-wrap: break-word;'>Unit 1</th>
                                    <th style='word-wrap: break-word;'>Unit 2</th>
                                    <th style='word-wrap: break-word;'>Unit 3</th>
                                    <th style='word-wrap: break-word;'>Unit 4</th>
                                    <th style='word-wrap: break-word; width: 70px;'>No. Telp</th>
                                    <th style='word-wrap: break-word;'>TTL</th>
                                    <th style='word-wrap: break-word;'>Username</th>
                                    <th style='word-wrap: break-word;'>E-mail</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered table-hover"
                                style="text-align: center; border: 1px solid #ececec;">
                                <?php
                                $query  = "SELECT * FROM `user`";
                                $result = $conn->query($query);
                                $i      = 1;
                                while ($row = $result->fetch_object())
                                {
                                    if (($row->Unit1) == NULL)
                                    {
                                        $unit_1 = "<b>--</b>";
                                    }
                                    else
                                    {
                                        $unit_1 = $row->Unit1;
                                    }

                                    if (($row->Unit2) == NULL)
                                    {
                                        $unit_2 = "<b>--</b>";
                                    }
                                    else
                                    {
                                        $unit_2 = $row->Unit2;
                                    }

                                    if (($row->Unit3) == NULL)
                                    {
                                        $unit_3 = "<b>--</b>";
                                    }
                                    else
                                    {
                                        $unit_3 = $row->Unit3;
                                    }

                                    if (($row->Unit4) == NULL)
                                    {
                                        $unit_4 = "<b>--</b>";
                                    }
                                    else
                                    {
                                        $unit_4 = $row->Unit4;
                                    }
                                    echo "<tr>
                                    <td style='background-color: #f5f5f5; word-wrap: break-word;'><b>" . $row->ID . "</b></td>
                                    <td style='word-wrap: break-word;'>" . $row->Nama . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->Akses . "</td>
                                    <td style='word-wrap: break-word;'>" . $unit_1 . "</td>
                                    <td style='word-wrap: break-word;'>" . $unit_2 . "</td>
                                    <td style='word-wrap: break-word;'>" . $unit_3 . "</td>
                                    <td style='word-wrap: break-word;'>" . $unit_4 . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->Telp . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->TmptLahir . ", " . $row->TglLahir . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->username . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->email . "</td>";
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <a type="submit" class="btn btn-danger" href="../index-subadmin.php"><b>← Home</b></a>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('#admin-tabel-mahasiswa').dataTable();
                    });
                </script>
                <script type="text/javascript">
                    function zoom_auto() {
                        document.body.style.zoom = "100%"
                    }
                </script>
            </main>
            <?php require '../footer-subadmin.php'; ?>
        </div>
        </div>
    </body>
<?php endif ?>