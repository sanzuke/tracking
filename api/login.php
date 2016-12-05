<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require("connect.php");

$user = mysql_real_escape_string($_POST['username']);
$pass = mysql_real_escape_string($_POST['password']);

$q = mysql_query("SELECT username, password FROM ss_user WHERE username = '{$user}'  AND password = password('{$pass}')");
if( mysql_num_rows($q) > 0 ){
  $row = mysql_fetch_row($q);
  $_SESSION['username'] = $row[0];
  //echo $row[0];
  echo '<meta http-equiv="Refresh" content="0; url=dashboard.php?op=dashboard">';
  return 'true';
} else {
	$_SESSION['msg'] ='Username atau password anda salah, coba kembali';
	echo '<meta http-equiv="Refresh" content="0; url=index.php">';
  return 'false';
}
?>