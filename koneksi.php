<?php
$server   = "127.0.0.1";
$username = "root";
$password = "";
$database = "bgferi_dinamis";

// Koneksi dan memilih database di server
mysql_connect($server, $username, $password) or die("Koneksi gagal");
mysql_select_db($database) or die(mysql_error());
