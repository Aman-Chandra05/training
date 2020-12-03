<?php
include 'classes/config.php';
$conn=new dbase();
$conn=$conn->connection();
include 'classes/loc.php';
$loc=new loc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="myjavascript.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>CedCab</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light rounded">
	  <a class="navbar-brand" href="#"><img src="pics/logo.jpg"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Home </a>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="#">contact Us</a>
	      </li>
	      
	      <li class="nav-item active">
	        <a class="nav-link " href="account/account.php">Log in</a>
	      </li>
	    </ul>
	  </div>
	</nav>	
<div id="content" class="my-1 rounded">
	<section id="middle" class="container pt-3">
		<h1 class="text-white text-center font-weight-bold">Book a City Taxi to your Destination in Town</h1>
		<h5 class="text-white text-center">Choose from a range of categories and Prices</h5>
	</section>
	<section id="form" class="container mt-5">
		<div class="row">
		<div class="col-sm-6 p-3">
			<div class="bg-light p-3 rounded">
				<p class="text-center"><span class="p-2" id="citytaxi">City Taxi</span></p>
				<p class="text-center font-weight-bold mb-0">Your Everyday travel partner </p>
				<p class="text-center">AC cabs for point to point travel</p>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
					  <span class="input-group-text" id="basic-addon1">PICK UP</span>
					</div>
					  <select id="pickup" class="form-control" onchange="pickuperr()">
					  <option class="form-control" value="" disabled selected>Current Location</option>
					  <?php
						$res=$loc->getall($conn);
						foreach($res as $key)
						{?>
							<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
						<?php
						}
						?>
					 </select>
				</div>
				<div class="errmsg" id="pickmsg">
					<p>Enter Pickup Location</p>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
					  <span class="input-group-text">DROP</span>
					</div>
					  <select id="drop" class="form-control" onchange="droperr()">
					  <option class="form-control" value="" disabled selected>Enter Drop for Estimate Ride</option>
					  <?php
					  foreach($res as $key)
						{?>
							<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
						<?php
						}?>
					</select>
				</div>
				<div class="errmsg" id="dropmsg">
					<p>Enter Drop Location</p>

				</div>
				<p class="errmsg" id="samelocation">Pickup and Drop Location can not be same</p>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
					  <span class="input-group-text">CAB TYPE</span>
					</div>
					<select id="cab" name="cars" class="form-control mdb-select md-form" onchange="cabtype(this.value)">
					  <option selected value="" disabled="">Select-Cab-Type</option>
					  <option value="micro">CedMicro</option>
					  <option value="mini">CedMini</option>
					  <option value="suv">CedSuv</option>
					  <option value="royal">CedRoyal</option>
					</select>
				</div>
				<div class="errmsg" id="cabmsg">
					<p>Enter Cab Type</p>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
					  <span class="input-group-text">LUGGAGE</span>
					</div>
					<input onchange="luggerr()" type="text" id="luggage" class="form-control" placeholder="Enter weight in Kg">
				</div>
				<div class="errmsg" id="luggmsg">
					<p>Enter Positive Integer value</p>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend"></div>
					<input type="button" id="sub" class="btn btn-warning btn-block" value="Calculate Fare">
				  </div>		
			</div>
		</div>
		<div class="col-sm-6 p-3" id="result">
			<div class="bg-light p-3 rounded w-auto">
				<p>Pick Up: <span id="pickuplocation"></span></p>
				<p>Drop Location: <span id="droplocation"></span></p>
				<p>Total Distance: <span id="dist"></span></p>
				<p>Total Fare: <span id="fare"></span></p>
				<button type="button" class="btn btn-warning">OK</button>
				<p>Log in to book</p>
			</div>
			
		</div>
		</div>
	</section>
	</div>
	
	<section id="footer" class="rounded">
		<p class="text-center p-3">Footer</p>
	</section>
</body>
</html>