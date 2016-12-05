<?php $values = $core->loadKonfigurasi(); ?>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Pengaturan</div>
		<form action="" method="post">
			<div class="panel-body">
				<!-- <div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" value="<?php echo $values["nama"] ?>">
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" class="form-control" value="<?php echo $values["alamat"] ?>">
				</div>
				<div class="form-group">
					<label>Call Center</label>
					<input type="text" name="phone" class="form-control" value="<?php echo $values["phone"] ?>">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control" value="<?php echo $values["email"] ?>">
				</div> -->
				<div class="form-group">
					<label>Text</label>
					<textarea class="form-control" id="text_isi" name="text_isi"><?php echo $values["text_isi"] ?></textarea>
				</div>
				<hr>
				<div class="form-group">
					<label>Facebook</label>
					<input type="text" name="fb" class="form-control"  value="<?php echo $values["fb"] ?>">
				</div>
				<div class="form-group">
					<label>Twitter</label>
					<input type="text" name="tw" class="form-control"  value="<?php echo $values["tw"] ?>">
				</div>
				<div class="form-group">
					<label>Instagram</label>
					<input type="text" name="ig" class="form-control"  value="<?php echo $values["ig"] ?>">
				</div>
				<!-- <div class="form-group">
					<label>BBM</label>
					<input type="bbm" name="bbm" class="form-control"  value="<?php echo $values["bbm"] ?>">
				</div> -->
				<hr>
				<div class="form-group">
					<label>Format Email</label>
					<textarea class="form-control" id="send_mail" name="send_mail"><?php echo $values["send_mail"] ?></textarea>
				</div>
				<hr>
				<div class="form-group">
					<label>Format Pesan order</label>
					<textarea class="form-control" id="txt_success_order" name="txt_success_order"><?php echo $values["txt_success_order"] ?></textarea>
				</div>
			</div>
			<div class="panel-footer">
				<button class="btn btn-primary" name="submit" value="submit"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	CKEDITOR.replace("text_isi");
	CKEDITOR.replace("send_mail");
	CKEDITOR.replace("txt_success_order");
</script>