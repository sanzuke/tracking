<div class="col-md-4 ">
	<div class="panel panel-default">
		<div class="panel-heading">Buat Jenis Baru</div>
		<form action="" method="post">
			<div class="panel-body">
				<div class="form-group">
					<label>Nama Jenis</label>
					<input type="text" name="jenis" class="form-control">
					<input type="hidden" name="id" class="form-control">
				</div>
			</div>
			<div class="panel-footer">
				<button class="btn btn-primary" name="submit" value="submit"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</form>
	</div>
</div>
<div class="col-md-8">
	<div class="panel panel-default">
		<div class="panel-heading">Daftar jenis</div>
		<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Jenis</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$str = '';
					$i=1;
					$isi = $core->loadListJenis();
					while( $r = mysql_fetch_array($isi) ){ ?>
						<tr>
			              <td><?php echo $i ?></td>
			              <td><?php echo $r['categoryname'] ?></td>
			              <td>
			                <button class="btn btn-primary btn-sm" onclick="ubah('<?php echo $r['categorycode'] ?>','<?php echo $r['categoryname'] ?>')">Ubah</button>
			                <button class="btn btn-danger btn-sm" onclick="hapus('<?php echo $r['categorycode'] ?>')">Hapus</button>
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
	function ubah(id, name){
		$('input[name="jenis"]').val(name);
		$('input[name="id"]').val(id);

		$('input[name="jenis"]').focus();

		$("form").scroll();
	}
	function hapus(id){
		var psn = confirm("Anda yakin akan menghapus data?");
		if(psn){
			$.post("dashboard.php?op=delJenis", {id:id}, function(data){
				window.location.reload();
			});
		}
	}
</script>