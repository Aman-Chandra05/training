<?php
include 'header.php';
include '../classes/ride.php';
$ride=new ride();

if(isset($_GET['operation']) && isset($_GET['id']))
{
    $ride->changestatus($_GET['operation'],$_GET['id'],$conn);
}
?>
<section id="content">
	<div>
		<h3>Sort By:</h3>
		<form method="post" action="">
		<button type="submit" value="fare" name="sortfare">Fare</button>
		</form>
	</div>
	<div class="table">
	<h1>All rides</h1>
	<?php
	if(isset($_GET['action']))
	{?>
	<table>
		<tr>
            <th>Customer Id</th>
            <th>Ride Id</th>
            <th>Cab Type</th>
			<th>Date</th>
			<th>Pick Up</th>
            <th>Drop</th>
            <th>Total Distance</th>
            <th>Luggage</th>
            <th>TOtal Fare</th>
            <th>Status</th>
            <th>Action</th>
		</tr>
		<?php
			$action=$_GET['action'];
			if(isset($_POST['sortfare']))
				$res=$ride->sort($conn,$_POST['sortfare'],$action);
			else
				$res=$ride->rides($conn,$_GET['action']);
			if($res!=0)
			{
				foreach($res as $key)
				{?>
					<tr>
                        <td><?php echo $key['customer_user_id']; ?></td>
                        <td><?php echo $key['ride_id']; ?></td>
                        <td><?php echo $key['cab']; ?></td>
                        <td><?php echo $key['ride_date']; ?></td>
                        <td><?php echo $key['pick']; ?></td>
                        <td><?php echo $key['drop']; ?></td>
                        <td><?php echo $key['total_distance']; ?></td>
                        <td><?php echo $key['luggage']; ?></td>
                        <td><?php echo $key['total_fare']; ?></td>
						<?php
						if($key['status']==0)
							{
								echo "<td>Cancelled</td>";
							}
						elseif($key['status']==1)
							{
								echo "<td>Pending</td>";	
                            }
                            elseif($key['status']==2)
                            {
                                echo "<td>Completed</td>";	
                            }?>
                        <?php
							if($key['status']==1)
							{
							echo "<td><a class='cancel zoom' href='?action=".$action."&operation=cancel&id=".$key['ride_id']."'>Cancel</a>";
							echo " <a class='approve zoom' href='?action=".$action."&operation=approve&id=".$key['ride_id']."'>Approve</a></td>";	
							}
							else echo "<td> </td>";
							?>
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
