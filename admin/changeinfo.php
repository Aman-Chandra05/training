<?php
include 'header.php';
include '../classes/user.php';
$user=new user();
$err='';
$msg='';
if(isset($_POST['submit']))
{
    $res=$user->fetch($conn,$_SESSION['user_id']);
    // echo "<pre>";
    // print_r($res);
    // echo "</pre>";
    if($res!=0)
    {
        if($res[0]['password']!=md5($_POST['old']))
            $err="Your Old Password is incorrect";
        else {
            $res=$user->changepassword($conn,$_SESSION['user_id'],$_POST['old'],$_POST['new']);
            $msg="updated successfully";
        }
    }
}
?>

<section id="content">
		<div class="form">
			<h1>Your Info</h1>
			<form method="post">
				<label for="old">Old Password</label>
			    <input type="password" id="old" name="old" required placeholder="Enter old Password">
			    <label for="new">New Password</label>
			    <input type="password" id="new" name="new" required placeholder="Enter new Password">
			    <input type="submit"  name="submit" value="Submit">
			    <div class="unsuccessful"><?php echo $err; ?></div>
			    <div class="successful"><?php echo $msg; ?></div>
        </div>
</section>

<?php
include 'footer.php';
?>