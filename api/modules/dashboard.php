<?php $result = $core->dashboard(); ?>
<div class="col-md-12 ">
	<div class="content-top-1 col-md-4">
		<div class="col-md-6 top-content">
			<h5>Semua Pesanan</h5>
			<label><?php echo $result['AllOrder'] ?></label>
		</div>
		<div class="col-md-6 top-content1">	   
			<div id="demo-pie-1" class="pie-title-center" data-percent="25"> <span class="pie-value"></span> </div>
		</div>
		 <div class="clearfix"> </div>
	</div>
	<div class="content-top-1 col-md-4">
		<div class="col-md-6 top-content">
			<h5>Dalam Prosess</h5>
			<label><?php echo $result['OnProgress'] ?></label>
		</div>
		<div class="col-md-6 top-content1">	   
			<div id="demo-pie-2" class="pie-title-center" data-percent="50"> <span class="pie-value"></span> </div>
		</div>
		 <div class="clearfix"> </div>
	</div>
	<div class="content-top-1 col-md-4">
		<div class="col-md-6 top-content">
			<h5>Pesanan Hari Ini</h5>
			<label><?php echo $result['OrderToday'] ?></label>
		</div>
		<div class="col-md-6 top-content1">	   
			<div id="demo-pie-3" class="pie-title-center" data-percent="75"> <span class="pie-value"></span> </div>
		</div>
		 <div class="clearfix"> </div>
	</div>
</div>