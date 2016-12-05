<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Daftar Pemesan</div>
		<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>No.</th>
					<th>Data Pemesan</th>
					<th>Deadline</th>
					<th>Jumlah</th>
					<th>Total</th>
					<th>Catatan</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$str = '';
					$i=1;
					$id="";
					$isi = $core->loadListKonsumen($id);
					while( $r = mysql_fetch_array($isi) ){ ?>
						<tr>
			              <td><?php echo $i ?></td>
			              <td><?php echo $r['customercode'] ?><br>
			              <i class="fa fa-user"></i> <?php echo $r['nama'] ?><br>
			              <i class="fa fa-home"></i> <?php echo $r['alamat'] ?><br>
			              <i class="fa fa-envelope"></i> <?php echo $r['email'] ?><br>
			              <i class="fa fa-phone"></i> Telp: <?php echo $r['telp'] ?><br>
			              <i class="fa fa-building"></i> <?php echo $r['lembaga'] ?><br>
			              <i class="fa fa-whatsapp"></i> <?php echo $r['wa'] ?><br>
			              PIN BB : <?php echo $r['bbm'] ?>
			              </td>
			              <td><?php echo date('d-m-Y', strtotime($r['deadline'])) ?></td>
			              <td><?php echo number_format($r['jumlah']) ?> Pcs</td>
			              <td><?php echo number_format($r['total']) ?></td>
			              <td><?php echo $r['catatan'] ?></td>
			              <td>
			                <!-- <button class="btn btn-primary btn-sm" onclick="ubah('<?php echo $r['customercode'] ?>','<?php echo $r['nama'] ?>')">Ubah</button> -->
			                <button class="btn btn-danger btn-sm" onclick="hapus('<?php echo $r['customercode'] ?>')">Hapus</button>
			                <button class="btn btn-default btn-sm" onclick="inputTotal('<?php echo $r['id'] ?>')">Masukan Total</button>
			              </td>
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
<script type="text/javascript">
	function inputTotal(id){
		var confirm = prompt("Masukan total pesanan");

		var total = new Number(confirm);
		if(total > 0){
			$.post("dashboard.php", {op: 'updateTotal', total : total, id : id}, function(data){
				window.location.reload();
			})
		} else {
			alert("Anda belum memasukan total pesanan")
		}
		
	}

	function hapus(id){
		var psn = confirm("Anda yakin akan menghapus konsumen dengan ID : '"+id+"' ?");
		if(psn){
			$.post("dashboard.php", {op: 'deleteKonsumen', id : id}, function(data){
				window.location.reload();
			})
		}
	}
</script>