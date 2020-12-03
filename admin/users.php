<?php
include 'header.php';
include '../classes/user.php';
$user=new user();

if(isset($_GET['type']) && isset($_GET['id']) && isset($_GET['operation']))
{
	if($_GET['type']=='status')
	{
		$user->changestatus($_GET['id'],$_GET['operation'],$conn);
	}
}
?>
<section id="content">
	<div>
		<h3>Sort By:</h3>
		<form method="post" action="">
			<button type="submit" value="name" name="sortname">Name</button>
			<button type="submit" value="date" name="sortdate">Date</button>
		</form>
	 </div>
	<div class="table">
	<h1>All Users</h1>
	<?php
	if(isset($_GET['action']))
	{?>
	<table>
		<tr>
			<th>User Name</th>
			<th>Name</th>
			<th>Date Of Signup</th>
			<th>Status</th>
		</tr>
		<?php
			$action=$_GET['action'];
			if(isset($_POST['sortname']))
				$res=$user->sort($conn,$_POST['sortname'],$action);
			elseif(isset($_POST['sortdate']))
				$res=$user->sort($conn,$_POST['sortdate'],$action);
			else
				$res=$user->users($conn,$_GET['action'],$action);
			if($res!=0)
			{
				foreach($res as $key)
				{?>
					<tr>
						<td><?php echo $key['user_name']; ?></td>
						<td><?php echo $key['name']; ?></td>
						<td><?php echo $key['dateofsignup']; ?></td>
						<?php
						if($key['isblocked']==0)
							{
								echo "<td><a class='active zoom' href='?action=".$action."&type=status&operation=block&id=".$key['user_id']."'>Unblocked</a>";
							}
							else
							{
								echo "<td><a class='deactive zoom' href='?action=".$action."&type=status&operation=unblock&id=".$key['user_id']."'>Blocked</a>";	
							}?>
					</tr>
				<?php
				}
			}
		}?>

	</table>
</div>
</section>
<?php
include 'footer.php';
?>
