<?php
include 'header.php';
include'../classes/loc.php';
$loc=new loc();
$error="";
$msg='';
$location='';
$dist='';
$Available='';
if(isset($_POST['submit']))
{
	if(isset($_GET['operation'])&& isset($_GET['id']))
	{  
		$id=$_GET['id'];
		if($_GET['operation']=='edit')
		{ 
			$res=$loc->update($_POST['location'],$_POST['dist'],$id,$conn);
			if($res)
			$msg="Location updated";
		}		   
	}
	else if(isset($_POST['location']) && isset($_POST['dist']))
	{
		$add=$loc->add($_POST['location'],$_POST['dist'],$conn);
		if($add==0)
			$error="Location already added";
		else
			$msg="Location added successfully";
	}
	
}
if(isset($_GET['operation'])&& isset($_GET['id']))
{
	$id=$_GET['id'];
	if($_GET['operation']=='edit')
	{
		$res=$loc->fetch($conn,$id);
		$res=$res->fetch_assoc();
		$location=$res['name'];
		$dist=$res['distance'];
	}
	if($_GET['operation']=='delete')
	{
		$loc->delete($conn,$id);
	}
 }
if(isset($_GET['type']) && isset($_GET['id']) && isset($_GET['operation']))
{
	if($_GET['type']=='status')
	{
		$loc->changestatus($_GET['id'],$_GET['operation'],$conn);
	}
}
?>

	<section id="content">
		<div class="form">
			<h1>Add Location</h1>
			<form method="post">
				<label for="location">Location</label>
			    <input type="text" id="location" name="location" required placeholder="Enter location" value="<?php echo $location;?>">
			    <label for="dist">Distance</label>
			    <input type="text" id="dist" name="dist" required placeholder="Enter distance" value="<?php echo $dist;?>">
			    <input type="submit"  name="submit" value="Submit">
			    <div class="unsuccessful"><?php echo $error; ?></div>
			    <div class="successful"><?php echo $msg; ?></div>
		</div>
		<?php
		$arr=$loc->show($conn);
		if($arr->num_rows>0)
		{
		while($row=$arr->fetch_assoc())
		{
			$ar[]=$row;
		}
		if(count($ar)>0)
		{?>
			<div class="table">
				<h1>Available Locations</h1>
				<table>
					<tr>
						<th>Location</th>
						<th>Distance</th>
						<th>Is Available</th>
						<th>Action</th>
					</tr>
					<?php
					foreach ($ar as $key) 
					{
						echo '<tr>';
						echo '<td>'.$key['name'].'</td>';
						echo '<td>'.$key['distance'].'</td>';
						if($key['is_available']==1)
						{
							echo "<td><a class='active zoom' href='?type=status&operation=deactive&id=".$key['id']."'>Active</a>";
						}
						else
						{
							echo "<td><a class='deactive zoom' href='?type=status&operation=active&id=".$key['id']."'>Deactive</a>";	
						}?>			
							<td> <a class="edit zoom" href="location.php?operation=edit&id=<?php echo $key['id'];?>">Edit</a>
							<a class="delete zoom" href="location.php?operation=delete&id=<?php echo $key['id'];?>">Delete</a>
						</td>
						<?php echo '</tr>';	
					}
					?>
				</table>
			</div>
		<?php
		}
		}?>
	</section>
<?php
include 'footer.php';
?>
