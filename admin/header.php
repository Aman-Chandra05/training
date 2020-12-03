 <?php
session_start();
include '../classes/config.php';
$conn=new dbase();
$conn=$conn->connection();
?>
 <!DOCTYPE html>
 <html>
 <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="javascript.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- ICON -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<title>CedCab</title>
	<link rel="stylesheet" href="style.css">
 </head>
 <body>
	<section id="header">
	<div>
		<img src="../pics/logo.jpg">
		<h1>Welcome to Cab Booking</h1>
	</div>
	</section>
		<section>
			<nav class="navbar navbar-expand-lg navbar-light">
			<a class="navbar-brand">Hello <?php if(isset($_SESSION['username'])) echo $_SESSION['username'];?></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link" href="admin.php">Home</a>
				</li>
				<li class="nav-item dropdown ">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Rides
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="rides.php?action=pending">Pending Rides</a>
					<a class="dropdown-item" href="rides.php?action=complete">Completed Rides</a>
					<a class="dropdown-item" href="rides.php?action=cancelled">Cancelled Rides</a>
					<a class="dropdown-item" href="allrides.php">All Rides</a>		        
				</li>
				<li class="nav-item dropdown ">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Users
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="users.php?action=pending">Pending Users Request</a>
					<a class="dropdown-item" href="users.php?action=approved">Approved users Request</a>
					<a class="dropdown-item" href="allusers.php">All users Request</a>
				</li>
				<li class="nav-item dropdown ">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Location
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="location.php">Location List</a>
					<a class="dropdown-item" href="location.php">Add New Location</a>
				</li>
				<li class="nav-item dropdown ">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Account
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="changeinfo.php?action=update">Change Password</a>
				</li>
					<li class="nav-item ">
					<a class="nav-link" href="../logout.php">Log Out</a>
				</li>
			</ul>
			</div>
			</nav>
		</section>
		