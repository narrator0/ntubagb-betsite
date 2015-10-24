<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="/web/bootstrap-3.3.5-dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<style>
	  	table {
			text-align: center;
			display: table;
		    border-collapse: separate;
		    border-spacing: 2px;
		    margin: 5px auto 10px auto;
		}
		th {
			background-color: gray;
		}
		th, td {
			text-align: center;
		}
		caption {
			text-align: center;
		}
		.data-title {
			padding-right: 5px;
			color: blue;
		}
		.warning {
			color: red;
		}
		.delete-btn, .delete-btn:hover {
			color: gray;
		}
  	</style>
</head>
<body>
	
	<div class="container">
	<!-- nav bar -->
	<nav class="navbar navbar-default fix-navbar-border-radius">
	  
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">Manage</a>
	    </div>
	    <div id="navbar" class="collapse navbar-collapse">
	      <ul class="nav navbar-nav navbar-left">
	        <li class="navTag"><a href="#">公告欄</a></li>
			<li class="navTag"><a href="/web/manage/index.php/manageController/viewData/video">Video</a></li>
			<li class="navTag"><a href="/web/manage/index.php/manageController/viewData/picture">Picture</a></li>
			<li class="navTag"><a href="/web/manage/index.php/manageController/viewData/player">Member</a></li>
			<li class="navTag"><a href="/web/manage/index.php/manageController/viewCup">Game Data</a></li>
	      </ul>
	    </div><!--/.nav-collapse -->
	  
	</nav>
	</div>
	











