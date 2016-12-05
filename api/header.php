<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Admin Panel Tracking Order - Gesit Konveksi</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="assets/admin/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="assets/admin/css/style.css" rel='stylesheet' type='text/css' />
<link href="assets/admin/css/font-awesome.css" rel="stylesheet"> 
<script src="assets/admin/js/jquery.min.js"> </script>
<!-- Mainly scripts -->
<script src="assets/admin/js/jquery.metisMenu.js"></script>
<script src="assets/admin/js/jquery.slimscroll.min.js"></script>
<!-- tinymice editor -->
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<!-- Custom and plugin javascript -->
<link href="assets/admin/css/custom.css" rel="stylesheet">

<script src="assets/admin/js/custom.js"></script>
<script src="assets/admin/js/screenfull.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
			

			
		});
		</script>

<!---- -->
</head>
<body>
<div id="wrapper">
	<nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="index.html">Admin Panel</a></h1>         
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <section class="full-top">
				<button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
			</section>
			<form class=" navbar-left-right" style="display: none">
              <input type="text"  value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
              <input type="submit" value="" class="fa fa-search">
            </form>
            <div class="clearfix"> </div>
           </div>
     
       
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="drop-men" >
		        <ul class=" nav_1">
		           
		    		<li class="dropdown at-drop">
		              <a href="#" class="dropdown-toggle dropdown-at " data-toggle="dropdown"><i class="fa fa-globe"></i> <span class="number">5</span></a>
		              <ul class="dropdown-menu menu1 " role="menu">
		                <li><a href="#">
		               
		                	<div class="user-new">
		                	<p>New user registered</p>
		                	<span>40 seconds ago</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-user-plus"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                	</a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>Someone special liked this</p>
		                	<span>3 minutes ago</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-heart"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>John cancelled the event</p>
		                	<span>4 hours ago</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-times"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>The server is status is stable</p>
		                	<span>yesterday at 08:30am</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-info"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>New comments waiting approval</p>
		                	<span>Last Week</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-rss"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#" class="view">View all messages</a></li>
		              </ul>
		            </li>
					<li class="dropdown">
		              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret">Administrator<i class="caret"></i></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-user fa-3x"></i>&nbsp;&nbsp;&nbsp;</a>
		              <ul class="dropdown-menu " role="menu">
		                <li><a href="profile.html"><i class="fa fa-user"></i>Edit Profile</a></li>
		                <li><a href="dashboard.php?op=logout"><i class="fa fa-logout"></i>Logout</a></li>
		                <!-- <li><a href="calendar.html"><i class="fa fa-calendar"></i>Calender</a></li>
		                <li><a href="inbox.html"><i class="fa fa-clipboard"></i>Tasks</a></li> -->
		              </ul>
		            </li>
		           
		        </ul>
		     </div><!-- /.navbar-collapse -->
			<div class="clearfix">
       
     </div>
	  
		    <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
				
                    <li>
                        <a href="dashboard.php?op=dashboard" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                    </li>

                    <li>
                        <a href="?op=jenis" class=" hvr-bounce-to-right"><i class="fa fa-list nav_icon"></i> <span class="nav-label">jenis</span> </a>
                    </li>
                    <li>
                        <a href="?op=pesanan" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i> <span class="nav-label">Daftar Konsumen</span> </a>
                    </li>
                    <li>
                        <a href="?op=tracking" class=" hvr-bounce-to-right"><i class="fa fa-truck nav_icon"></i> <span class="nav-label">Tracking Pesanan</span> </a>
                    </li>
                    <li>
                        <a href="?op=pengaturan" class=" hvr-bounce-to-right"><i class="fa fa-gear nav_icon"></i> <span class="nav-label">Pengaturan</span> </a>
                    </li>
                     <!-- <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-truck nav_icon"></i> <span class="nav-label">Pesanan</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="?op=pesanan" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon"></i>Daftar Pesanan</a></li>
                       </ul>
                    </li> -->

                    <!-- <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-newspaper-o nav_icon"></i> <span class="nav-label">Post</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="admin_page/add" class=" hvr-bounce-to-right"> <i class="fa fa-arrow-right nav_icon"></i>Tambah Posting</a></li>
                            <li><a href="admin_page/list" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon"></i>Daftar Posting</a></li>
                       </ul>
                    </li>

                    <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-map nav_icon"></i> <span class="nav-label">Mangemen Iklan</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="admin_page/profile" class=" hvr-bounce-to-right"> <i class="fa fa-arrow-right nav_icon"></i>Tambah Iklan</a></li>
                            <li><a href="admin_page/marketing" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon"></i>Daftar Iklan</a></li>
                       </ul>
                    </li> 

                    <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-cog nav_icon"></i> <span class="nav-label">Pengaturan</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="forms.html" class=" hvr-bounce-to-right"><i class="fa fa-align-left nav_icon"></i>Umum</a></li>
                            <li><a href="forms.html" class=" hvr-bounce-to-right"><i class="fa fa-align-left nav_icon"></i>Kirim Email</a></li>
                            <li><a href="dashboard.php?op=sosial" class=" hvr-bounce-to-right"><i class="fa fa-check-square-o nav_icon"></i>Sosial Media</a></li>
                        </ul>
                    </li>-->
                   
                </ul>
            </div>
			</div>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
  		<!--banner-->	
		    <div class="banner">
				<h2>
				<a href="admin_dashboard">Dashboard</a>
				<i class="fa fa-angle-right"></i>
				<span><?php echo ucwords(strtolower($_GET['op'])) ?></span>
				</h2>
		    </div>
		<!--//banner-->
		<!--content-->
		<div class="content-top">

