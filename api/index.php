<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Tracking Order - Gesit Konveksi</title>
	<script type="text/javascript" src="js/jquery-2.2.4.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.cookie.js"></script>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

	<link rel="shortcut icon" href="gesit-fav.png" type="image/x-icon" />
	<style media="screen">
		@-ms-viewport     { width: device-width; }
		@-o-viewport      { width: device-width; }
		@viewport         { width: device-width; }
	</style>
</head>
<body>
		<div class="container"><br>
			<div class="row">
	      <div class="col-md-12 col-sm-12 col-xs-12" align="center">
				     <img src="assets/Logo-Gesit.png" class="img-responsive">
	      </div>
			</div><br>

      <div class="row">
				<?php
				if( isset($_SESSION['msg']) ){
					echo '<span class="label label-danger">
						'.$_SESSION['msg'].'
					</span>';
				} 
				?>
        <form class="form-tracking" action="login.php" method="post">
          <h2 class="form-signin-heading">Admin Area </h2>
          <label for="inputEmail" class="sr-only">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
					<input type="hidden" name="op" value="login"  />
          <label for="inputEmail" class="sr-only">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required autofocus>
          <button class="btn btn-lg btn-primary btn-block" type="submit">login</button>
        </form>
      </div>

    </div> <!-- /container -->
</body>
</html>
