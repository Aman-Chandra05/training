<?php
session_start();
include '../classes/config.php';
include '../classes/user.php';
$conn=new dbase();
$conn=$conn->connection();
$user=new user();
$signupsuccess=''; $signuperr=''; $loginsuccess=''; $loginerr='';
if(isset($_POST['reg']))
{
	if(isset($_POST['username']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['mobile']))
	{
		$reg=$user->register($_POST['username'],$_POST['name'],$_POST['password'],$_POST['mobile'],$conn);
		if($reg==0)
			$signuperr="username already Registered";
		else
			$signupsuccess="Registration Successfull. Admin will let you in soon!!!";
	}
}

if(isset($_POST['login']))
{
	if(isset($_POST['rememberme']))
	{
		setcookie("username", $_POST['username'], time() + 3600, "/");
		setcookie("password", $_POST['password'], time() + 3600, "/"); 

	}
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$log=$user->login($_POST['username'],$_POST['password'],$conn);
		if($log==0)
			$loginerr="Enter Corect Login Details";
		else
		{
			if($log['isblocked']==0)
			{
				$_SESSION['username']=$log['user_name'];
				$_SESSION['user_id']=$log['user_id'];
                if($log['is_admin']==0)
					header('location:customer.php');
				else
					header('location:../admin/admin.php');
			}
			else
				$loginsuccess="Admin will let you in soon.";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cab Booking</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="javascript.js"></script>
</head>
<body>
	<section id="header">
		<div>
		  <img src="../pics/logo.jpg">
		  <h1>Welcome to Cab Booking</h1>
		</div>
	</section>
	<section id="forms">
		<div id="signup">
			<h1>Sign Up</h1>
			<form action="" method="post" onsubmit="return validate()">
			    <label for="username">User Name</label>
			    <input type="text" id="username" name="username" required placeholder="Enter User name">
			    <div class="errmsg" id="usrmsg">
					<p></p>
				</div>

			    <label for="name">Name</label>
			    <input type="text" id="name" name="name" required placeholder="Enter name">
			    <div class="errmsg" id="namemsg">
					<p></p>
				</div>
			    
			    <label for="password">Password</label>
			    <input type="password" id="password" name="password" required placeholder="Enter password">
			    <div class="errmsg" id="passmsg">
					<p></p>
				</div>

			    <label for="mobile">Mobile Numbrer</label>
			    <input type="number" id="mobile" name="mobile" required placeholder="Enter Mobile Number">
			    <div class="errmsg" id="mobmsg">
					<p></p>
				</div>
			    <input type="submit"  name="reg" value="Submit">
			    <div class="unsuccessful"><?php echo $signuperr; ?></div>
			    <div class="successful"><?php echo $signupsuccess; ?></div>


			</form>
		</div>
		<div id="login">
			<h1>Log in</h1>
			<form action="" method="post">

			    <label for="loginname">User Name</label>
			    <input type="text" id="loginname" name="username" placeholder="Enter name" value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];} else echo "";?>">
			    <div class="errmsg" id="logusrmsg">
					<p>Wrong User Name</p>
				</div>
			    
			    <label for="loginpassword">Password</label>
			    <input type="password" id="loginpassword" name="password" placeholder="Enter password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} else echo "";?>">
			    <div class="errmsg" id="logpassmsg">
					<p>Wrong Password</p>
				</div>
				<input type="checkbox" id="checkbox" name="rememberme"> Remember me
			    <input type="submit" name="login" value="Submit">
			    <div class="unsuccessful"><?php echo $loginerr; ?></div>
			    <div class="successful"><?php echo $loginsuccess; ?></div>
			</form>
		</div>
	</section>
	<section id="footer" class="rounded">
	<p>	&copy; Copyright
		</p>
	</section>
</body>
</html>