<!-- Header dan Sidebar -->
<?php
require '../header.php';
?>

<!-- VALIDASI Penginputan Form Edit Data Member -->
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
                        <i class="bi bi-people-fill"
                            style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                        <b style="color: white">Data Member</b>
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
                                    <th style='word-wrap: break-word;'>Nama</th>
                                    <th>No. Telp</th>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered table-hover"
                                style="text-align: center; border: 1px solid #ececec;">
                                <?php
                                $query  = "SELECT * FROM `member`";
                                $result = $conn->query($query);
                                $i      = 1;
                                while ($row = $result->fetch_object())
                                {
                                    echo "<tr>
                                    <td style='background-color: #f5f5f5;'><b>" . $row->MemberID . "</b></td>
                                    <td>" . $row->NamaMember . "</td>
                                    <td>" . $row->Telp . "</td>
                                    <td>" . $row->Username . "</td>
                                    <td>" . $row->EmailMember . "</td>";
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <a type="submit" class="btn btn-danger" href="../index-admin.php"><b>← Home</b></a>
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
            <?php require '../footer.php'; ?>
        </div>
        </div>
    </body>
<?php endif ?>