<!-- Header dan Sidebar -->
<?php
require '../header-subadmin.php';
?>

<!-- VALIDASI Penginputan Form Edit Data Sub-Admin -->
<?php
include("../template/import.php");

if (isset($_SESSION['username'])):
    ?>
    <style>
        div.dataTables_wrapper {
            width: 100%;
        }
    </style>

    <body onload="zoom_auto()">
        <div id="layoutSidenav_content" style="background-color: #fafafa">
            <main>
                <br>
                <div class="card mb-4" style="margin-left: 1%; margin-right: 1%; border: 1px solid #2e2d2d">
                    <div class="card-header" style="text-align: center; background-color: #2e2d2d">
                        <i class="bi bi-journals"
                            style="margin-right: 2px; font-size: 16px; color: white; font-weight: bolder;"></i>
                        <b style="color: white">Data Dokumen</b>
                    </div>
                    <div class="card-body tabel-mahasiswa cell-border">
                        <a type="submit" class="btn btn-success" href="../input-subadmin/tamb-dok-subadmin.php" title='Tambah Dokumen Baru'><b>+
                                Baru</b></a>
                        <button onclick='window.location.reload(true);' class="btn btn-danger" style="float: right" title='Refresh'><b><i
                                    class="bi bi-arrow-clockwise"></i></b></button>
                        <br><br>
                        <table id="admin-tabel-mahasiswa" class="cell-border table-sm dataTable" cellspacing="1"
                            width="100%"
                            style="border: 0px solid; box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.75); font-size: 14px;">
                            <thead style="background-color: #2e2d2d; color: white; text-align: center;">
                                <tr>
                                    <th style='width: 30px;'>ID</th>
                                    <th style='word-wrap: break-word; width: 110px;'>Dokumen</th>
                                    <th style='word-wrap: break-word;'>Jenis Dokumen</th>
                                    <th style='word-wrap: break-word;'>Jenis Akses</th>
                                    <th style='word-wrap: break-word;'>Kategori</th>
                                    <th style='word-wrap: break-word;'>Unit 1</th>
                                    <th style='word-wrap: break-word;'>Unit 2</th>
                                    <th style='word-wrap: break-word;'>Unit 3</th>
                                    <th style='word-wrap: break-word;'>Unit 4</th>
                                    <th style='word-wrap: break-word;'>Judul</th>
                                    <th style='word-wrap: break-word;'>Tahun</th>
                                    <th style='word-wrap: break-word;'>Pengarang</th>
                                    <th style='word-wrap: break-word;'>Penerbit</th>
                                    <th style='word-wrap: break-word;'>Download</th>
                                    <th style='word-wrap: break-word;'>Tanggal Input</th>
                                    <th style='word-wrap: break-word;'>Tanggal Edit</th>
                                    <th style='word-wrap: break-word;'>Edit</th>
                                    <th style='word-wrap: break-word;'>Hapus</th>
                                    <th style='width: 30px;'>ID</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered table-hover"
                                style="text-align: center; border: 1px solid #ececec;">
                                <?php
                                $query  = "SELECT * FROM `book` ORDER BY BookID_Num";
                                $result = $conn->query($query);
                                $i      = 1;
                                while ($row = $result->fetch_object())
                                {
                                    if (($row->Tgledit) == NULL)
                                    {
                                        $tgled = "<b>--</b>";
                                    }
                                    else
                                    {
                                        $tgled = $row->Tgledit;
                                    }
                                    if (($row->Unit1) == NULL)
                                    {
                                        $unitt1 = "<b>--</b>";
                                    }
                                    else
                                    {
                                        $unitt1 = $row->Unit1;
                                    }
                                    if (($row->Unit2) == NULL)
                                    {
                                        $unitt2 = "<b>--</b>";
                                    }
                                    else
                                    {
                                        $unitt2 = $row->Unit2;
                                    }
                                    if (($row->Unit3) == NULL)
                                    {
                                        $unitt3 = "<b>--</b>";
                                    }
                                    else
                                    {
                                        $unitt3 = $row->Unit3;
                                    }
                                    if (($row->Unit4) == NULL)
                                    {
                                        $unitt4 = "<b>--</b>";
                                    }
                                    else
                                    {
                                        $unitt4 = $row->Unit4;
                                    }
                                    echo "<tr>
                                    <td style='background-color: #f5f5f5; width: 30px;'><b>" . $row->BookID . "</b></td>
                                    <td id='display-image' style='outline: 1px solid #CCC; overflow:auto;'>
                                        <a href='../assets/pdf/" . $row->PDF . "' target='_new' title='Klik untuk Download' download='" . $row->PDF . "'>
                                            <img src='../assets/imageinput/" . $row->Gambar . "' style='width:76px; height:100px;'>
                                        </a>
                                    </td>
                                    <td style='word-wrap: break-word;'>" . $row->JenisDok . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->JenisAkses . "</td>
                                    <td style='word-wrap: break-word;'>
                                        " . $row->KategoriDok . "
                                        <form action='../edit-subadmin/cek-unit-ktgr.php?name=" . $row->BookID . "' method='POST'>
                                            <input type='hidden' name='IDBook' value='" . $row->BookID . "," . $unitt1 . "," . $unitt2 . "," . $unitt3 . "," . $unitt4 . "'>
                                            <input type='submit' class='btn btn-default' name='submit' value='📝' title='Edit Kategori Dokumen ini'>
                                        </form>
                                    </td>
                                    <td style='word-wrap: break-word;'>" . $unitt1 . "</td>
                                    <td style='word-wrap: break-word;'>" . $unitt2 . "</td>
                                    <td style='word-wrap: break-word;'>" . $unitt3 . "</td>
                                    <td style='word-wrap: break-word;'>" . $unitt4 . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->Judul . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->TahunTerbit . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->Pengarang . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->Penerbit . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->JmlDownload . "</td>
                                    <td style='word-wrap: break-word;'>" . $row->Tglinput . "</td>
                                    <td style='word-wrap: break-word;'>" . $tgled . "</td>
                                    <td>
                                        <form action='../edit-subadmin/cek-unit.php?name=" . $row->BookID . "' method='POST'>
                                            <input type='hidden' name='IDBook' value='" . $row->BookID . "," . $unitt1 . "," . $unitt2 . "," . $unitt3 . "," . $unitt4 . "'>
                                            <input type='submit' class='btn btn-primary' name='submit' value='📝' title='Edit Dokumen ini'>
                                        </form>
                                    </td>
                                    <td>
                                        <form action='../edit-subadmin/del-dok-subadmin.php?name=" . $row->BookID . "' method='POST'>
                                            <input type='hidden' name='BookID' value='" . $row->BookID . "," . $unitt1 . "," . $unitt2 . "," . $unitt3 . "," . $unitt4 . "'>
                                            <input type='submit' class='btn btn-danger' name='submit' value='🗙' onclick='return checkDelete()' title='Hapus Dokumen ini'>
                                        </form>
                                    </td>
                                    <td style='background-color: #f5f5f5; width: 30px;'><b>" . $row->BookID . "</b></td>
                                    </tr>";
                                    $i++;
                                }
                                ?>
                            </tbody>
                            <tr
                                style="background-color: #2e2d2d; color: white; text-align: center; font-weight: bolder; border: 0px solid #2e2d2d;">
                                <td style='width: 30px; border: 0px solid #2e2d2d;'>ID</td>
                                <td style='word-wrap: break-word; width: 110px; border: 0px solid #2e2d2d;'>Dokumen</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Jenis Dokumen</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Jenis Akses</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Kategori</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Unit 1</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Unit 2</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Unit 3</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Unit 4</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Judul</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Tahun</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Pengarang</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Penerbit</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Download</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Tanggal Input</td>
                                <td style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Tanggal Edit</td>
                                <th style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Edit</th>
                                <th style='word-wrap: break-word; border: 0px solid #2e2d2d;'>Hapus</th>
                                <td style='width: 30px; border: 0px solid #2e2d2d;'>ID</td>
                            </tr>
                        </table>
                        <a type="submit" class="btn btn-danger" href="../index-subadmin.php"><b>← Home</b></a>
                    </div>
                </div>
                <script language="JavaScript" type="text/javascript">
                    function checkDelete() {
                        return confirm('Anda yakin untuk menghapus dokumen ini?');
                    }
                </script>
                <script>
                    $(document).ready(function () {
                        $('#admin-tabel-mahasiswa').DataTable({
                            scrollX: true,
                            scrollY: '525px',
                            scrollCollapse: true,
                            order: [],
                            "columnDefs": [
                                { "orderable": false, "targets": [0, 16] },
                                { "orderable": true, "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15] }
                            ]
                        });
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