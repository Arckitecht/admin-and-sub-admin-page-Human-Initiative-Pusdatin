<!-- Header dan Sidebar -->
<?php
require '../header.php';
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
                        <b><i class="bi bi-list-check"
                                style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i></b>
                        <b style="color: white">Data Kategori</b>
                    </div>
                    <div class="card-body tabel-mahasiswa cell-border">
                        <center>
                            <b style="color: #2e2d2d; font-size: 28px">JENIS DOKUMEN</b>
                        </center>
                        <a type="submit" class="btn btn-success" href="../input/tamb-jnsd.php" title='Tambah Jenis Dokumen Baru'><b>+ Baru</b></a>
                        <button onclick='window.location.reload(true);' class="btn btn-danger" style="float: right" title='Refresh'><b><i
                                    class="bi bi-arrow-clockwise"></i></b></button>
                        <br><br>
                        <table id="admin-tabel-mahasiswa1" class="cell-border table-sm dataTable" cellspacing="1"
                            width="100%"
                            style="border: 0px solid; box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.75); font-size: 14px; table-layout: fixed;">
                            <thead style="background-color: #2e2d2d; color: white; text-align: center;">
                                <tr>
                                    <th style='word-wrap: break-word; width: 20px;'>ID</th>
                                    <th>Jenis Dokumen</th>
                                    <th style='word-wrap: break-word; width: 190px;'>Edit</th>
                                    <th style='word-wrap: break-word; width: 190px;'>Hapus</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered table-hover"
                                style="text-align: center; border: 1px solid #ececec;">
                                <?php
                                $query  = "SELECT * FROM `jenis_dok`";
                                $result = $conn->query($query);
                                $i      = 1;
                                while ($row = $result->fetch_object())
                                {
                                    echo "<tr>
                                    <td style='background-color: #f5f5f5;'><b>" . $row->ID . "</b></td>
                                    <td>" . $row->JenisDok . "</td>
                                    <td>
                                        <form action='../edit/edit-ktgr-jnsd.php?name=" . $row->JenisDok . "' method='GET'>
                                            <input type='hidden' name='jenisdok' value='" . $row->JenisDok . "'>
                                            <input type='submit' class='btn btn-primary' name='submit' value='📝' title='Edit Jenis Dokumen ini'>
                                        </form>
                                    </td>
                                    <td>
                                        <form action='../edit/del-ktgr-jnsd.php?name=" . $row->ID . "' method='POST'>
                                            <input type='hidden' name='ID-jnsd' value='" . $row->ID . "," . $row->JenisDok . "'>
                                            <input type='submit' class='btn btn-danger' name='submit' value='🗙' onclick='return checkDelete()' title='Hapus Jenis Dokumen ini'>
                                        </form>
                                    </td>";
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>

                        <center style="margin-bottom: 1%; background-color: #5a5a5a; border-radius: 50px;">
                            <hr size="3px" color="black" style="background-color: black; border-radius: 50px;" />
                        </center>

                        <center>
                            <b style="color: #2e2d2d; font-size: 28px">JENIS AKSES</b>
                        </center>
                        <a type="submit" class="btn btn-success" href="../input/tamb-jnsa.php" title='Tambah Jenis Akses Baru'><b>+ Baru</b></a>
                        <button onclick='window.location.reload(true);' class="btn btn-danger" style="float: right" title='Refresh'><b><i
                                    class="bi bi-arrow-clockwise"></i></b></button>
                        <br><br>
                        <table id="admin-tabel-mahasiswa2" class="cell-border table-sm dataTable" cellspacing="1"
                            width="100%"
                            style="border: 0px solid; box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.75); font-size: 14px; table-layout: fixed;">
                            <thead style="background-color: #2e2d2d; color: white; text-align: center;">
                                <tr>
                                    <th style='word-wrap: break-word; width: 20px;'>ID</th>
                                    <th>Jenis Akses</th>
                                    <th style='word-wrap: break-word; width: 190px;'>Edit</th>
                                    <th style='word-wrap: break-word; width: 190px;'>Hapus</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered table-hover"
                                style="text-align: center; border: 1px solid #ececec;">
                                <?php
                                $querysss  = "SELECT * FROM `jenis_akses`";
                                $resultsss = $conn->query($querysss);
                                $isss      = 1;
                                while ($rows = $resultsss->fetch_object())
                                {
                                    echo "<tr>
                                    <td style='background-color: #f5f5f5;'><b>" . $rows->ID . "</b></td>
                                    <td>" . $rows->JenisAkses . "</td>
                                    <td>
                                        <form action='../edit/edit-ktgr-jnsa.php?name=" . $rows->JenisAkses . "' method='GET'>
                                            <input type='hidden' name='jenisakses' value='" . $rows->JenisAkses . "'>
                                            <input type='submit' class='btn btn-primary' name='submit' value='📝' title='Edit Jenis Akses ini'>
                                        </form>
                                    </td>
                                    <td>
                                        <form action='../edit/del-ktgr-jnsa.php?name=" . $rows->ID . "' method='POST'>
                                            <input type='hidden' name='ID-jnsa' value='" . $rows->ID . "," . $rows->JenisAkses . "'>
                                            <input type='submit' class='btn btn-danger' name='submit' value='🗙' onclick='return checkDelete()' title='Hapus Jenis Akses ini'>
                                        </form>
                                    </td>";
                                    $isss++;
                                }
                                ?>
                            </tbody>
                        </table>

                        <center style="margin-bottom: 1%; background-color: #5a5a5a; border-radius: 50px;">
                            <hr size="3px" color="black" style="background-color: black; border-radius: 50px;" />
                        </center>

                        <center>
                            <b style="color: #2e2d2d;  font-size: 28px">KATEGORI DOKUMEN</b>
                        </center>
                        <a type="submit" class="btn btn-success" href="../input/tamb-ktgr.php" title='Tambah Kategori Dokumen Baru'><b>+ Baru</b></a>
                        <button onclick='window.location.reload(true);' class="btn btn-danger" style="float: right" title='Refresh'><b><i
                                    class="bi bi-arrow-clockwise"></i></b></button>
                        <br><br>
                        <table id="admin-tabel-mahasiswa3" class="cell-border table-sm dataTable" cellspacing="1"
                            width="100%"
                            style="border: 0px solid; box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.75); font-size: 14px; table-layout: fixed;">
                            <thead style="background-color: #2e2d2d; color: white; text-align: center;">
                                <tr>
                                    <th style='word-wrap: break-word; width: 20px;'>ID</th>
                                    <th>Kategori Dokumen</th>
                                    <th style='word-wrap: break-word; width: 190px;'>Edit</th>
                                    <th style='word-wrap: break-word; width: 190px;'>Hapus</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered table-hover"
                                style="text-align: center; border: 1px solid #ececec;">
                                <?php
                                $queryss  = "SELECT * FROM `kategori_dok`";
                                $resultss = $conn->query($queryss);
                                $iss      = 1;
                                while ($rowss = $resultss->fetch_object())
                                {
                                    echo "<tr>
                                    <td style='background-color: #f5f5f5;'><b>" . $rowss->ID . "</b></td>
                                    <td>" . $rowss->KategoriDok . "</td>
                                    <td>
                                        <form action='../edit/edit-ktgr-dok.php?name=" . $rowss->KategoriDok . "' method='GET'>
                                            <input type='hidden' name='ktgrdok' value='" . $rowss->KategoriDok . "'>
                                            <input type='submit' class='btn btn-primary' name='submit' value='📝' title='Edit Kategori Dokumen ini'>
                                        </form>
                                    </td>
                                    <td>
                                        <form action='../edit/del-ktgr-dok.php?name=" . $rowss->ID . "' method='POST'>
                                            <input type='hidden' name='ID-ktgr' value='" . $rowss->ID . "," . $rowss->KategoriDok . "'>
                                            <input type='submit' class='btn btn-danger' name='submit' value='🗙' onclick='return checkDelete()' title='Hapus Kategori Dokumen ini'>
                                        </form>
                                    </td>";
                                    $iss++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <a type="submit" class="btn btn-danger" href="../index-admin.php"><b>← Home</b></a>
                    </div>
                </div>
                <script language="JavaScript" type="text/javascript">
                    function checkDelete() {
                        return confirm('Anda yakin untuk menghapus?');
                    }
                </script>
                <script>
                    $(document).ready(function () {
                        $('#admin-tabel-mahasiswa1').dataTable();
                        $('#admin-tabel-mahasiswa2').dataTable();
                        $('#admin-tabel-mahasiswa3').dataTable();
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