<?php
include 'koneksi.php';
session_start();
if (isset($_GET['update'])) :
	$idKaryawan = $_GET['update'];
	$nama = $_POST['nama_baru_karyawan'];
	$umur = $_POST['umur_karyawan'];
	$hoby = $_POST['rincian_hoby'];
	$tipe = $_POST['jenis_hoby'];

	// update karyawan
	$updateKaryawan = mysql_query("UPDATE tbl_karyawan SET nama_karyawan='$nama', umur_karyawan='$umur' WHERE id_karyawan = '$idKaryawan'");

	// update hoby
	mysql_query("DELETE FROM tbl_hoby WHERE id_karyawan = '$idKaryawan'");
	if ($updateKaryawan) {
		for ($i = 0; $i < sizeof($hoby); $i++) {
			mysql_query("INSERT INTO tbl_hoby (rincian_hoby,jenis_hoby,id_karyawan) VALUES ('$hoby[$i]','$tipe[$i]','$idKaryawan')");
		}
	}

	$_SESSION['pesan'] = 'data ' . $nama . ' berhasil diupdate';
	header('location:index.php');

elseif (isset($_POST['nama_karyawan'])) :
	$nama = $_POST['nama_karyawan'];
	$umur = $_POST['umur_karyawan'];
	$hoby = $_POST['rincian_hoby'];
	$tipe = $_POST['jenis_hoby'];

	// insert karyawan
	$insertKaryawan = mysql_query("INSERT INTO tbl_karyawan (nama_karyawan,umur_karyawan) VALUES ('$nama','$umur')");

	// insert hoby
	$karyawanId = mysql_insert_id();
	if ($insertKaryawan) {
		for ($i = 0; $i < sizeof($hoby); $i++) {
			mysql_query("INSERT INTO tbl_hoby (rincian_hoby,jenis_hoby,id_karyawan) VALUES ('$hoby[$i]','$tipe[$i]','$karyawanId')");
		}
	}

	$_SESSION['pesan'] = 'data ' . $nama . ' berhasil diinput';
	header('location:index.php');
elseif (isset($_GET['hapus'])) :
	$deleteKaryawan = mysql_query("DELETE FROM tbl_karyawan WHERE id_karyawan = '$_GET[hapus]'");
	$deleteHoby     = mysql_query("DELETE FROM tbl_hoby WHERE id_karyawan     = '$_GET[hapus]'");

	if ($deleteKaryawan && $deleteHoby) {
		$_SESSION['pesan'] = 'data berhasil dihapus';
	} else {
		$_SESSION['pesan'] = 'Terjadi kesalahan saat menghapus data';
	}
	header('location:index.php');
else :
	$_SESSION['pesan'] = 'Terjadi kesalahan proses';
	header('location:index.php');
endif;
