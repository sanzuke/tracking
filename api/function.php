<?php
/**
 *
 */
class CoreClass
{

  function randomString($length){
    $allchars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //$allchars = array ($a, "a", "b", "c", "5", "8");
    $string = '';

    mt_srand ((double) microtime() * 1000000);

    for ($i = 0; $i < $length; $i++) {

      $string .= $allchars{mt_rand (0,strlen($allchars))};
    }
    return $string;
  }

  function randomToken($length) {
    $allow = "abcdefghijklnmopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $i = 1;
    while ($i <= $length) {
      $max = strlen($allow)-1;
      $num = rand(0, $max);
      $temp = substr($allow, $num, 1);
      $ret = $ret . $temp;
      $i++;
    }
    return $ret;
  }

  function sendMail($email, $resi){
    $q = mysql_query("SELECT send_mail FROM cf_config WHERE id = '1'");
    $row = mysql_fetch_row($q);

    $find = array('{noresi}');
    $replace = array($resi);

    $txt = str_replace($find, $replace, $row[0]);
  	$to = $email;
  	$subject = "No. Resi Pemesanan Gesit Konveksi";
  	// $txt = "Berikut No. Resi pesanan anda";
  	// $txt .= "No. Resi : ".$resi;
  	$headers = "From: Gesit Konveksi <order@gesitkonveksi.co.id>" . "\r\n";
    $headers .='Reply-To: '. $email . "\r\n" ;

    // To send HTML mail, the Content-type header must be set
    $headers .= 'MIME-Version: 1.0' . "\r\n"; 
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "X-Mailer: PHP/".phpversion();

  	mail($to,$subject,$txt,$headers);

    //return $result;
  }

  function msgBox($str, $op){
    if ($op == true){
      return '<div class="col-md-12 "><div class="row"><div class="col-md-12 ">
                <div class="panel panel-success">
                  <div class="panel-heading">Success</div>
                  <div class="panel-body">
                    '.$str.'
                  </div>
                </div></div>
              </div></div>';
    } else {
      return '<div class="row"><div class="col-md-12 ">
                <div class="panel panel-danger">
                  <div class="panel-heading">Error</div>
                  <div class="panel-body">
                    '.$str.'
                  </div>
                </div></div>
              </div></div>';
    }
  }

  function loadProgress(){
    $result = mysql_query("SELECT parametervaluecode as kode, parametervalue as nama 
      FROM ss_parametervalue 
      WHERE parametercode = '1' ");
    return $result;
  }

  function updateProgress(){
    $id = mysql_real_escape_string($_POST['id']);
    $progress = mysql_real_escape_string($_POST['progress']);

    $result = mysql_query("UPDATE um_tracking SET progress = '{$progress}' WHERE id = '${id}' ");

    return $result;
  }

  // Admin function
  function cekLogin(){

    $user = mysql_real_escape_string($_POST['username']);
    $pass = mysql_real_escape_string($_POST['password']);

    $q = mysql_query("SELECT username, password FROM ss_user WHERE username = '{$user}'  AND password = password('{$pass}')");
    if( mysql_num_rows($q) > 0 ){
      $row = mysql_fetch_row($q);
      return 'true';
    } else {
      return 'false';
    }
  }

  // konten admin jenis
  function loadListJenis(){
    $q = mysql_query("SELECT categorycode, categoryname FROM ss_category");
    $i = 1;
    $str = mysql_fetch_array($q);
    // while ($r = mysql_fetch_array($q)) {
    //   $str .= '<tr>
    //           <td>'.$i.'</td>
    //           <td>'.$r['categoryname'].'</td>
    //           <td>
    //             <button class="btn btn-primary btn-sm">Ubah</button>
    //             <button class="btn btn-danger btn-sm">Hapus</button>
    //           </td>
    //         </tr>';
    //   $i++;
    // }
    return $q;
  }

  function saveJenis(){
    $jenis = mysql_real_escape_string($_POST['jenis']);
    $id = mysql_real_escape_string($_POST['id']);

    $cek = mysql_query("SELECT * FROM ss_category WHERE categoryname = '{$jenis}' ");
    if( mysql_fetch_row($cek) == 0 ){
      if($id == ""){
        $q = mysql_query("INSERT INTO ss_category (categoryname, parent) VALUES('{$jenis}', '0')");
      } else {
        $q = mysql_query("UPDATE ss_category SET categoryname = '{$jenis}' WHERE categorycode = '{$id}' ");
      }
    } else {
      $q = mysql_query("UPDATE ss_category SET categoryname = '{$jenis}' WHERE categorycode = '{$id}' ");
    }
    if($q){
      return true;
    } else {
      return false;
    }
  }

  function delJenis(){
    $id = mysql_real_escape_string($_POST['id']);

    $qDel = mysql_query("DELETE FROM ss_category WHERE categorycode = '{$id}' ");
    if($qDel){
      return 'true';
    } else {
      return 'false';
    }
  }

  // konten admin konsumen
  function loadListKonsumen($id){
    if($id == ""){
      return mysql_query("SELECT * FROM um_order ORDER BY id DESC");
    } else {
      return mysql_query("SELECT um.*, pv.categoryname as jenis_nama 
          FROM um_order um, ss_category pv 
          WHERE um.customercode = '{$id}'
          AND um.jenis = pv.categorycode");
    }
  }

  function updateTotal(){
    $id = mysql_real_escape_string($_POST['id']);
    $total = mysql_real_escape_string($_POST['total']);

    $up = mysql_query("UPDATE um_order SET total = '{$total}' WHERE id = '{$id}' ");
    if($up){
      return true;
    } else {
      return false;
    }
  }


  // konten admin tracking order
  function loadListTracking(){
    return mysql_query("SELECT tr.*, od.`nama`, od.`email`, (SELECT parametervalue FROM `ss_parametervalue` WHERE parametervaluecode = `tr`.`progress`) as onprogress
      FROM um_tracking tr, um_order od
      WHERE tr.`customercode` = od.`customercode`
      ORDER BY tr.`id` DESC");
  }


  // pengaturan
  function loadKonfigurasi(){
    $result =  mysql_query("SELECT phone, email, fb, tw, ig, send_mail, nama, alamat, bbm, text_isi, txt_success_order FROM cf_config WHERE id='1'");
    $r = mysql_fetch_row($result);

    $isi = array('phone'=> $r[0], 'email'=> $r[1], 'fb'=> $r[2], 'tw'=> $r[3], 'ig'=> $r[4], 'send_mail'=> $r[5], 'nama' => $r[6], 'alamat'=> $r[7], 'bbm'=> $r[8], 'text_isi' => $r[9], 'txt_success_order' => $r[10]);
    return $isi;
  }

  function saveKonfigurasi(){
    $phone = mysql_escape_string($_POST['phone']);
    $email = mysql_escape_string($_POST['email']);
    $fb = mysql_escape_string($_POST['fb']);
    $tw = mysql_escape_string($_POST['tw']);
    $ig = mysql_escape_string($_POST['ig']);
    $send_mail = mysql_escape_string($_POST['send_mail']);
    $nama = mysql_escape_string($_POST['nama']);
    $alamat = mysql_escape_string($_POST['alamat']);
    $bbm = mysql_escape_string($_POST['bbm']);
    $text_isi = mysql_escape_string($_POST['text_isi']);
    $txt_success_order = mysql_escape_string($_POST['txt_success_order']);

    $up = mysql_query("UPDATE cf_config SET fb = '{$fb}', tw = '{$tw}', ig = '{$ig}', send_mail = '{$send_mail}', text_isi = '{$text_isi}', txt_success_order = '{$txt_success_order}' ");
    // $up = mysql_query("UPDATE cf_config SET phone = '{$phone}', email = '{$email}', fb = '{$fb}', tw = '{$tw}', ig = '{$ig}', send_mail = '{$send_mail}', nama = '{$nama}', alamat = '{$alamat}', bbm = '{$bbm}' ");

    if($up){
      return true;
    } else {
      return false;
    }
  }

  function dashboard(){
    $qAllOrder = mysql_query("SELECT count(*) FROM um_order");
    $countAllOrder = mysql_fetch_row($qAllOrder);

    $qOnProgress = mysql_query("SELECT count(*) FROM um_tracking WHERE progress NOT IN ('0','7') ");
    $countOnProgress = mysql_fetch_row($qOnProgress);

    $qOrderToday = mysql_query("SELECT count(*) FROM um_tracking WHERE status <> '0' AND createddate = current_date");
    $countOrderToday = mysql_fetch_row($qOrderToday);

    $qOnFinish = mysql_query("SELECT count(*) FROM um_tracking WHERE progress = '7' ");
    $countOnFinish = mysql_fetch_row($qOnFinish);

    return array(
        "AllOrder" => $countAllOrder[0],
        "OnProgress" => $countOnProgress[0],
        "OrderToday" => $countOrderToday[0],
        "OnFinish" => $countOnFinish[0]
      );
  }

  function loadMsgOrder($op, $resi){

    if($op === 'success'){
      $q = mysql_query("SELECT txt_success_order FROM cf_config WHERE id = '1' ");
      $row = mysql_fetch_row($q);

      $str = str_replace("{NORESI}", $resi, $row[0]);

     } else {
      $str = "Data anda gagal disimpan, coba beberapa saat lagi.";
     }

    return $str;
  }


}

?>
