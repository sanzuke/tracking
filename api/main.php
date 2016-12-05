<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require("connect.php");
require("function.php");

$core = new Coreclass();
$op = mysql_real_escape_string($_POST['op']) =="" ? mysql_real_escape_string($_GET['op']) : mysql_real_escape_string($_POST['op']);
switch ($op) {
  case 'order':
      $nama = mysql_real_escape_string($_POST['nama']);
      $email = mysql_real_escape_string($_POST['email']);
      $alamat = mysql_real_escape_string($_POST['alamat']);
      $telp = mysql_real_escape_string($_POST['telp']);
      $lembaga = mysql_real_escape_string($_POST['lembaga']);
      $produk = mysql_real_escape_string($_POST['produk']);
      $jumlah = mysql_real_escape_string($_POST['jumlah']);
      $catatan = mysql_real_escape_string($_POST['catatan']);
      $deadline = mysql_real_escape_string(date('Y-m-d', strtotime($_POST['deadline'])));
      $wa = mysql_real_escape_string($_POST['wa']);
      $bbm = mysql_real_escape_string($_POST['bbm']);

      $CusCode ='CUS-'.date("dmy").'-'. $core->randomString(5);
      $qry = "INSERT INTO um_order (customercode, nama,alamat,email, telp, lembaga, jenis, jumlah, catatan, deadline, wa, bbm)
      VALUES('{$CusCode}','{$nama}', '{$alamat}', '{$email}', '{$telp}', '{$lembaga}', '{$produk}', '{$jumlah}', '{$catatan}','{$deadline}','{$wa}','{$bbm}')";
      $data = array();
      $query = mysql_query($qry);
      if($query){
        // Insert into um_tracking
        //Generate No. Resi
        $resi = $core->randomString(8);
        $tr = "INSERT INTO um_tracking (noresi, transactioncode, progress, customercode, createddate)
        VALUES('{$resi}', '{1234}', '0', '{$CusCode}', current_date)";

        $query = mysql_query($tr);

        $core->sendMail($email, $resi);
        // get msg 
        $psn = $core->loadMsgOrder('success', $resi);

        $rec['text'] = 'Message';
        $rec['success'] = $psn;
        $rec['error'] = '';
        $rec['status'] = true;
        $rec['noresi'] = $resi;
        $rec['data'] = array("nama"=> $nama,
                            "alamat"=> $alamat,
                            "email" =>  $email,
                            "telp"=> $telp,
                            "lembaga"=>$lembaga,
                            "jenis"=> $produk,
                            "jumlah" => $jumlah,
                            "catatan"=>$catatan,
                            "noresi"=>$resi
                          );
        $data[] =$rec;
      } else {
        // get msg 
        $psn = $core->loadMsgOrder('error', '');

        $rec['text'] = 'Message';
        $rec['success'] = $psn;
        $rec['error'] = mysql_error();
        $rec['status'] = false;
        $rec['data'] = array("nama"=> $nama, "alamat"=> $alamat, "email" =>  $email, "telp"=> $telp, "lembaga"=>$lembaga, "jenis"=> $produk, "jumlah" => $jumlah, "catatan"=>$catatan);
        $data[] =$rec;
      }

      echo json_encode($data);
    break;
  case 'getCategory':
      $qry = "SELECT * FROM ss_category WHERE parent = '0'";
      $query = mysql_query($qry);
      $data = array();
      while ($r =  mysql_fetch_array($query)) {
        $rec['categorycode'] = $r['categorycode'];
        $rec['categoryname'] = $r['categoryname'];
        $data[] = $rec;
      }
      echo json_encode($data);
    break;

    case 'getProduct':
        $qry = "SELECT * FROM ss_products";
        $query = mysql_query($qry);
        $data = array();
        while ($r =  mysql_fetch_array($query)) {
          $rec['productcode'] = $r['productcode'];
          $rec['productname'] = $r['productname'];
          $data[] = $rec;
        }
        echo json_encode($data);
      break;

    case 'auth':
        $noresi = mysql_real_escape_string($_POST['noresi']);
        $auth_token =$core->randomToken(14);
        $data = array();

        $qry = "SELECT noresi, pr FROM um_tracking WHERE noresi = '{$noresi}' ";
        $query = mysql_query($qry);

        if( mysql_num_rows($query) > 0 ){
          // get token
          $qryToken = "INSERT INTO ss_authtoken VALUES('{$noresi}','{$auth_token}',CURRENT_TIMESTAMP(), 1 )";

          while ($r =  mysql_fetch_array($query)) {
            $rec['auth_token']    = $auth_token;
            $rec['noresi']        = $noresi;
            $rec['progress']      = $r['progress'];
            $rec['customercode']  = $r['customercode'];
            $data[] = $rec;
          }
        } else {
          $rec['text'] = 'Message';
          $rec['success'] = 'No. Resi tidak terdaftar';
          $rec['error'] = mysql_error();
          $rec['status'] = false;
          $data[] = $rec;
        }
        echo json_encode($data);
      break;

      case 'cekresi' :
        $noresi = mysql_real_escape_string($_POST['noresi']);
        $data = array();
        $qry = "SELECT
              	tr.`noresi`,
                tr.`progress`,
                o.`nama`,
                o.`alamat`,
                o.`email`,
                o.`telp`,
                o.`lembaga`,
                o.`jenis`,
                c.`categoryname` as jenis_nama,
                o.`jumlah`,
                o.`catatan`,
                o.`total`
            FROM `um_tracking` tr, `um_order` o, ss_category c
            WHERE tr.`customercode` = o.`customercode`
            AND c.`categorycode` = o.`jenis`
            AND tr.`noresi`  = '{$noresi}' ";
        $query = mysql_query($qry);

        if( mysql_num_rows($query) > 0 ){
          while ($r =  mysql_fetch_array($query)) {
            $rec['noresi']        = $r['noresi'];
            $rec['progress']      = $r['progress'];
            $rec['nama']  = $r['nama'];
            $rec['alamat']  = $r['alamat'];
            $rec['email']  = $r['email'];
            $rec['telp']  = $r['telp'];
            $rec['lembaga']  = $r['lembaga'];
            $rec['jenis']  = $r['jenis'];
            $rec['jenis_nama']  = $r['jenis_nama'];
            $rec['jumlah']  = $r['jumlah'];
            $rec['catatan']  = $r['catatan'];
            $rec['total']  = $r['total'];
            $rec['status']  = true;
            $data[] = $rec;
          }
        } else {
          $rec['text'] = 'Message';
          $rec['success'] = 'No. Resi tidak terdaftar';
          $rec['error'] = mysql_error();
          $rec['status'] = false;
          $data[] = $rec;
        }
        echo json_encode($data);
      break;

      case 'listproses' :
        $noresi = mysql_real_escape_string($_POST['noresi']);
        $data = array();
        $qry = "SELECT pv.*,
            CASE WHEN (SELECT progress FROM `um_tracking` WHERE noresi = '{$noresi}') = pv.`parametervaluecode` THEN
                'aktif'
              ELSE
                null
              END as active,
              (SELECT statusdate FROM um_progress WHERE noresi = '{$noresi}' AND progress = pv.`parametervaluecode` ) as statusdate
          FROM `ss_parametervalue` `pv`
          WHERE parametercode = '1' ;";
        $query = mysql_query($qry);

        if( mysql_num_rows($query) > 0 ){
          while ($r =  mysql_fetch_array($query)) {
            if($r['statusdate'] !== 'NULL' ){
              $statusdate = date("d/m/Y", strtotime($r['statusdate']));
            } else {
              $statusdate = null;
            }
            $rec['kode']        = $r['parametervaluecode'];
            $rec['progress']    = $r['parametervalue'];
            $rec['active']    = $r['active'];
            $rec['icon']    = $r['option'];
            $rec['status']  = true;
            $rec['statusdate']  = $statusdate;
            $data[] = $rec;
          }
        } else {
          $rec['text'] = 'Message';
          $rec['success'] = 'No. Resi tidak terdaftar';
          $rec['error'] = mysql_error();
          $rec['status'] = false;
          $data[] = $rec;
        }
        echo json_encode($data);
      break;

      case "pengaturan":
        $result =  mysql_query("SELECT phone, email, fb, tw, ig, send_mail, alamat, nama, bbm,text_isi FROM cf_config WHERE id='1'");
        $r = mysql_fetch_row($result);

        //$isi = array('phone'=> $r[0], 'email'=> $r[1], 'fb'=> $r[2], 'tw'=> $r[3], 'ig'=> $r[4], 'send_mail'=> $r[5]);
        $rec['phone']        = $r[0];
        $rec['email']    = $r[1];
        $rec['fb']    = $r[2];
        $rec['tw']    = $r[3];
        $rec['ig']    = $r[4];
        $rec['send_mail']    = $r[5];
        $rec['status']  = true;
        $rec['alamat']  = $r[6];
        $rec['nama']  = $r[7];
        $rec['bbm']  = $r[8];
        $rec['text_isi']  = $r[9];
        $data[] = $rec;
        echo json_encode($data);
      break;
  default:

    break;
}

?>
