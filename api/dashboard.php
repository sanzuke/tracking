<?php
session_start();
if(! isset($_SESSION['username']) ) header("location:index.php");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// if( $_POST['op'] != "listKonsumen" ) { require("header.php"); }
switch ($_POST['op']) {
  case 'listKonsumen':
  case 'sendMail':
    # code...
    break;
  
  default:
    require("header.php");
    break;
}
require("connect.php");
require("function.php");

$core = new CoreClass();

  $oper = mysql_real_escape_string($_POST['op']) == "" ? mysql_real_escape_string($_GET['op']) : mysql_real_escape_string($_POST['op']);
  switch ($oper) {
    case 'logout': 
      unset($_SESSION['username']);
      session_destroy();
      echo '<meta http-equiv="Refresh" content="0; url=index.php">';
    break;
    case 'dashboard':
        unset($_SESSION['msg']);
        require("modules/dashboard.php");
      break;
    // =============
    case 'jenis' :
        if ( $_POST['submit'] == 'submit'){
          $result = $core->saveJenis();
          if(!$result){
            echo $core->msgBox(mysql_error(), false);
          } else if($result){
            echo $core->msgBox('Data telah disimpan.', true);
          }
        }
        require("modules/jenis.php");
      break;
    case 'delJenis' :
        $core->delJenis();
      break;
    // ==============
    case 'pesanan' : 
        require("modules/pesanan.php");
      break;
    case 'updateTotal' :
        $core->updateTotal();
      break;

    //==========================
    case 'tracking':
        require("modules/tracking.php");
      break;
    case 'updateProgress' :
        $core->updateProgress();
      break;

    case "sendMail" :
      $email = mysql_escape_string($_POST['email']);
      $resi = mysql_escape_string($_POST['resi']);

      $core->sendMail($email, $resi);
      //echo $xxx;
      break;

    case 'listKonsumen' :
        //header('Content-type: application/json');
        $id = mysql_escape_string($_POST['id']);
        $result = $core->loadListKonsumen($id);
        $data = array();
        while ( $row = mysql_fetch_array($result)) {
          $rec['nama'] = $row['nama'];
          $rec['alamat'] = $row['alamat'];
          $rec['email'] = $row['email'];
          $rec['telp'] = $row['telp'];
          $rec['lembaga'] = $row['lembaga'];
          $rec['jenis'] = $row['jenis'];
          $rec['jenis_nama'] = $row['jenis_nama'];
          $rec['jumlah'] = number_format($row['jumlah']);
          $rec['total'] = number_format($row['total']);
          $rec['deadline'] = date("d-m-Y", strtotime($row['deadline']));
          $rec['wa'] = $row['wa'];
          $rec['bbm'] = $row['bbm'];
          $rec['catatan'] = $row['catatan'];
          $data[] = $rec;
        }

        echo json_encode($data);
      break;

    case 'deleteKonsumen' :
        $id = mysql_escape_string($_POST['id']);

        $qdelKon = mysql_query("DELETE FROM um_order WHERE customercode = '{$id}' ");

        if($qdelKon){
          $qdelTrk = mysql_query("DELETE FROM um_tracking WHERE customercode = '{$id}' ");
          if($qdelTrk) {
            echo 'Berhasil di hapus';
          } else {
            echo mysql_error();
          }
        } else {
          echo mysql_error();
        }
      break;
      
    // ==========================
    case 'pengaturan' :
        if ( $_POST['submit'] == 'submit'){
          $result = $core->saveKonfigurasi();
          if(!$result){
            echo $core->msgBox(mysql_error(), false);
          } else if($result){
            echo $core->msgBox('Data telah disimpan.', true);
          }
        }
        require("modules/pengaturan.php");
      break;
    default:
      # code...
      //require("modules/dashboard.php");
      break;
  }
//if( $_POST['op'] != "listKonsumen" ) require("footer.php");
switch ($_POST['op']) {
  case 'listKonsumen':
  case 'sendMail':
    # code...
    break;
  
  default:
    require("footer.php");
    break;
}
?>
