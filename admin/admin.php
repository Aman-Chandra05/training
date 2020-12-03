<?php
include 'header.php';
include 'func.php';
?>
	<section id="content" class="container-fluid">
	<div class="row no-gutters">
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="users.php?action=pending"><div class="tile "><span class="icon text-center"><i class="fas fa-user-lock"></i></span>
			<p>Blocked Users</p>
			<p><?php echo (countusers($conn,1));?></p>
		</div></a>
		</div>
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="users.php?action=approved"><div class="tile "><span class="icon text-center"><i class="fas fa-user"></i></span>
			<p>Active Users</p>
			<p><?php echo (countusers($conn,0));?></p>
			</div></a>
		</div>
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="allusers.php"><div class="tile "><span class="icon text-center"><i class="fas fa-users"></i></span>
			<p>Total Users</p>
			<p><?php echo (countusers($conn));?></p>
			</div></a>
		</div>
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="rides.php?action=cancelled"><div class="tile "><span class="icon text-center"><i class="fa fa-taxi" aria-hidden="true"></i></span>
			<p>Cancelled Rides</p>
			<p><?php echo (countrides($conn,0));?></p>
			</div></a>
		</div>
	</div>
	<div class="row no-gutters">
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="rides.php?action=pending"><div class="tile "><span class="icon text-center"><i class="fa fa-taxi" aria-hidden="true"></i></span>
			<p>Pending Rides</p>
			<p><?php echo (countrides($conn,1));?></p>
		</div></a>
		</div>
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="rides.php?action=complete"><div class="tile "><span class="icon text-center"><i class="fa fa-taxi" aria-hidden="true"></i></span>
			<p>Completed Rides</p>
			<p><?php echo (countrides($conn,2));?></p>
			</div></a>
		</div>
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="allrides.php"><div class="tile "><span class="icon text-center"><i class="fa fa-taxi" aria-hidden="true"></i></span>
			<p>Total Rides</p>
			<p><?php echo (countrides($conn));?></p>
			</div></a>
		</div>
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="location.php"><div class="tile "><span class="icon text-center"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
			<p>Total Locations</p>
			<p><?php echo (countloc($conn));?></p>
			</div></a>
		</div>
	</div>
	<div class="row no-gutters">
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="location.php"><div class="tile "><span class="icon text-center"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
			<p>Available Locations</p>
			<p><?php echo (countloc($conn,1));?></p>
		</div></a>
		</div>
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="location.php"><div class="tile "><span class="icon text-center"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
			<p>Blocked Locations</p>
			<p><?php echo (countloc($conn,0));?></p>
			</div></a>
		</div>
		<div class="col-lg-3 col-sm-6 p-3" >
			<a href="#"><div class="tile "><span class="icon text-center"><i class="fas fa-money-bill-wave"></i></span>
			<p>Total Earnings</p>
			<p>Rs. <?php echo (earnings($conn));?></p>
			</div></a>
		</div>

	</div>
</section>

<?php
include 'footer.php';
?>


