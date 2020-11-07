<?php require_once 'koneksi.php';
session_start();
$checkMaxId   = mysql_fetch_array(mysql_query("SELECT max(id_karyawan) AS maxid FROM tbl_karyawan"));
$newAssignId  = $checkMaxId['maxid'] + 1;
$listKaryawan = mysql_query("SELECT * FROM tbl_karyawan ORDER BY nama_karyawan ASC");
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Metode Biseksi</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script language="javascript">
        function tambahHobi() {
            var idf = document.getElementById("idf").value;
            var stre;
            stre = "<p id='srow" + idf + "'><input type='text' size='40' name='rincian_hoby[]' placeholder='Masukkan Hobi' /> <input type='text' size='30' name='jenis_hoby[]' placeholder='Utama/Sambilan' /> <a href='#' style=\"color:#3399FD;\" onclick='hapusElemen(\"#srow" + idf + "\"); return false;'>Hapus</a></p>";
            $("#divHobi").append(stre);
            idf = (idf - 1) + 2;
            document.getElementById("idf").value = idf;
        }

        function hapusElemen(idf) {
            $(idf).remove();
        }
    </script>

    <style>
        table {
            width: 100%;
        }

        td {
            padding-left: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div id="container">
        <h2>Input Data Karyawan</h2>
        <?php if (!isset($_GET['update'])) : ?>
            <form method="post" action="proses.php">
                <input id="idf" name="myid" value="1" type="hidden" />
                <p> Nama : <input name="nama_karyawan" type="text" id="nama" size="40"> </p>
                <p> Umur : <input name="umur_karyawan" type="text" id="umur" size="8"> </p>
                <button type="button" onclick="tambahHobi(); return false;">Tambah Rincian Hobi</button>
                <div id="divHobi"></div>
                <button type="submit">Simpan</button>
            </form>
        <?php else :
            $idToUpdate = $_GET['update'];
            $gettingKaryawan = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE id_karyawan = '$idToUpdate'"));
            $listingHoby = mysql_query("SELECT * FROM tbl_hoby WHERE id_karyawan = '$idToUpdate'");
            $numListed = mysql_num_rows($listingHoby);
        ?>
            <form method="post" action="proses.php?update=<?= $gettingKaryawan['id_karyawan'] ?>">
                <input id="idf" name="myid" value="<?= $numListed + 1 ?>" type="hidden" />
                <p> Nama : <input name="nama_baru_karyawan" type="text" id="nama" value="<?= $gettingKaryawan['nama_karyawan'] ?>" size="40"> </p>
                <p> Umur : <input name="umur_karyawan" type="text" id="umur" value="<?= $gettingKaryawan['umur_karyawan'] ?>" size="8"> </p>
                <button type="button" onclick="tambahHobi(); return false;">Tambah Rincian Hobi</button>
                <div id="divHobi">
                    <?php $listForm = 1 ?>
                    <?php while ($rl = mysql_fetch_assoc($listingHoby)) : ?>
                        <p id='srow<?= $listForm ?>'><input type='text' size='40' name='rincian_hoby[]' value="<?= $rl['rincian_hoby']; ?>" placeholder='Masukkan Hobi' /> <input type='text' size='30' name='jenis_hoby[]' value="<?= $rl['jenis_hoby']; ?>" placeholder='Utama/Sambilan' /> <a href='#' style=\"color:#3399FD;\" onclick='hapusElemen("#srow<?= $listForm ?>"); return false;'>Hapus</a></p>
                        <?php $listForm++ ?>
                    <?php endwhile ?>
                </div>
                <button type="submit">Update</button>
            </form>
        <?php endif ?>
        <?php if (isset($_SESSION['pesan'])) echo $_SESSION['pesan']; ?>
        <?php unset($_SESSION['pesan']) ?>
        <hr>
        <table style="border: solid 1px;">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Hoby</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            while ($r = mysql_fetch_array($listKaryawan)) :
                $listHoby = mysql_query("SELECT * FROM tbl_hoby WHERE id_karyawan = '$r[id_karyawan]'");
            ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $r['nama_karyawan']; ?></td>
                    <td><?= $r['umur_karyawan']; ?></td>
                    <td>
                        <?php $separator = '';
                        while ($h = mysql_fetch_array($listHoby)) :
                            echo $separator . $h['rincian_hoby'] . '(' . $h['jenis_hoby'] . ')';
                            $separator = ', ';
                        endwhile ?>
                    </td>
                    <td>
                        <a href="?update=<?= $r['id_karyawan'] ?>">E</a>
                        <a href="proses.php?hapus=<?= $r['id_karyawan'] ?>">D</a>
                    </td>
                </tr>
                <?php $no++ ?>
            <?php endwhile ?>
        </table>
    </div>
</body>

</html>
