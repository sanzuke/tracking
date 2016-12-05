<?php
//$host = 'localhost';
//$user = 'gesitko2_track';
//$pass = 'GKTr4ck1n90rd3r';
//$dbname = 'gesitko2_tracking';

$host = 'localhost';
$user = 'root';
$pass = 'kosong';
$dbname = 'san_tracking';

$data = array();
$con = mysql_connect($host, $user, $pass);
if($con){
  $dbSelect = mysql_select_db($dbname, $con);
  if(!$dbSelect){
    //die("Database tidak ditemukan");
    $rec['text'] = 'message';
    $rec['data'] = 'Database tidak ditemukan';

    $data[] = $rec;
    echo json_encode($data);
  }
} else {
  //die("Database tidak terhubung");
  $rec['text'] = 'message';
  $rec['data'] = 'Database tidak terhubung';

  $data[] = $rec;
  echo json_encode($data);
}
?>
