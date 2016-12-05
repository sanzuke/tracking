<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Daftar Tracking Order</div>
		<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>No.</th>
					<th>tanggal Order</th>
					<th>Data Pemesan</th>
					<th>No. Resi</th>
					<th>Proses</th>
					<th>Info Pesanan</th>
					<th align="center">Opsi</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$str = '';
					$i=1;
					$isi = $core->loadListTracking();
					while( $r = mysql_fetch_array($isi) ){ ?>
						<tr>
			              <td><?php echo $i ?></td>
			              <td><?php echo  date('d-m-Y', strtotime($r['createddate'])) ?></td>
			              <td><?php echo $r['nama']." (".$r['customercode'].")" ?></td>
			              <td><?php echo $r['noresi'] ?></td>
			              <td><?php echo $r['onprogress'] ?></td>
			              <td align="center"><button class="btn btn-default btn-sm" onclick="info('<?php echo $r['customercode'] ?>')"><i class="fa fa-search"></i></button></td>
			              <td>
			                <!-- <button class="btn btn-primary btn-sm" onclick="ubah('<?php echo $r['customercode'] ?>','<?php echo $r['nama'] ?>')">Ubah</button> 
			                <button class="btn btn-danger btn-sm" onclick="hapus('<?php echo $r['customercode'] ?>')">Hapus</button>-->
			                <button class="btn btn-default btn-sm" onclick="sendMail('<?php echo $r['email'] ?>', '<?php echo $r['noresi'] ?>')"><i class="fa fa-envelope"></i></button>
			                <!-- <button class="btn btn-default btn-sm" onclick=""><i class="fa fa-phone"></i></button> -->
			              </td>
			              <td><button class="btn btn-default btn-sm" onclick="ubahStatus('<?php echo $r['id'] ?>','<?php echo $r['progress'] ?>')"><i class="fa fa-edit"></i></button></td>
			            </tr>
					<?php
					      $i++;
					}
				?>
			</tbody>
		</table>
		</div>
	</div>
</div>


<div id="myModal" class="modal fade ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Proses Pengerjaan</h4>
            </div>
            <div class="modal-body">
            	<div class="form-group">
            		<label>Proses</label>
            		<select class="form-control" name="progress">
            			<option value="">[ Pilih ]</option>
            			<?php
			            $isi = $core->loadProgress();
			            while ($row = mysql_fetch_array($isi)) {
			            	echo '<option value="'.$row['kode'].'">'.$row['nama'].'</option>';
			            }
			            ?>
            		</select>
            		<input type="hidden" name="id" id="id">
            		<input type="hidden" name="before_ps" id="before_ps">
            	</div>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-primary" type="button" onclick="updateProgress()"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<div id="myModalInfo" class="modal fade ">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Info Pesanan</h4>
            </div>
            <div class="modal-body">
            	<div class="isiOrder"></div>
            	<div class="col-md-8">
            		<table class="table table-striped isiOrder1"></table>
            	</div>
            	<div class="col-md-4">
            		<table class="table table-striped isiOrder2"></table>
            	</div>
            	<div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function sendMail(email, resi){
		$.post("dashboard.php", {op:'sendMail', email : email, resi : resi}, function(data){
			alert("No. Resi telah dikirim ulang");
		})
	}

	function ubahStatus(id, prs){
		$("#myModal").modal("show");
		$("#id").val(id);
		if( prs > 0){
			$('select[name="progress"]').val(prs);
		} 
		$('#before_ps').val(prs)
	}

	function updateProgress(){
		var psn = confirm("Anda yakin akan mengubah proses pengerjaan?");

		if(psn){
			var id = $("#id").val();
			var updateprogress = $('select[name="progress"]').val();
			$.post('dashboard.php', {op : 'updateProgress', id: id, progress : updateprogress }, function(data){ 
				window.location.reload(); 
			})
		}
	}

	function info(id){
		$.post("dashboard.php", {op : 'listKonsumen', id : id}, function(data){
			var table1 = '', table2;
			$(".isiOrder").html('<center><i class="fa fa-spin fa-spinner fa-3x"></i></center>')
			$.each(JSON.parse(data), function(i, val){
				table1 += '<tr><td>Nama</td><td> : '+val.nama+'</td></tr>';
				table1 += '<tr><td>Alamat</td><td> : '+val.alamat+'</td></tr>';
				table1 += '<tr><td>Telp</td><td> : '+val.telp+'</td></tr>';
				table1 += '<tr><td>Email</td><td> : '+val.email+'</td></tr>';
				table1 += '<tr><td>Lembaga</td><td> : '+val.lembaga+'</td></tr>';
				table2 += '<tr><td>Jenis Pesanan</td><td> : '+val.jenis_nama+'</td></tr>';
				table2 += '<tr><td>Jumlah</td><td> : '+val.jumlah+'</td></tr>';
				table2 += '<tr><td>Total</td><td> : '+val.total+'</td></tr>';
				table1 += '<tr><td>Dealine</td><td> : '+val.deadline+'</td></tr>';
				table1 += '<tr><td>WA</td><td> : '+val.wa+'</td></tr>';
				table1 += '<tr><td>BBM</td><td> : '+val.bbm+'</td></tr>';
				table1 += '<tr><td>Catatan</td><td> : '+val.catatan+'</td></tr>';
			})
			$(".isiOrder1").html(table1);
			$(".isiOrder2").html(table2);
			$(".isiOrder").html('');
		});

		$("#myModalInfo").modal("show");
	}

	$(document).ready(function(){
		
		$('select[name="progress"]').on("change", function(){
			var before_ps = $("#before_ps").val();
			if( $(this).val() < before_ps ){
				var psn = confirm("Proses pengerjaan mundur dari sebelumnya, anda yakin akan mundur?")
				if(psn){
					$('select[name="progress"]').val( $(this).val() );
				} else {
					$('select[name="progress"]').val( before_ps );
				}
			}

			console.log( before_ps )
		})
	})
</script>