<?php 
include 'header.php';
include '../classes/ride.php';
$ride=new ride();
if(isset($_GET['operation']) && isset($_GET['id']))
{
    $ride->changestatus($_GET['operation'],$_GET['id'],$conn);
}
if(isset($_GET['action'])&& isset($_GET['id']))
{
    $id=$_GET['id'];
	if($_GET['action']=='delete')
	{
		$ride->delete($conn,$id);
    }
    
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
	<h1>All Rides</h1>
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
            <th>Action</th>
		</tr>
		<?php
			if(isset($_POST['sortfare']))
				 $res=$ride->sort($conn,$_POST['sortfare']);
			else
				$res=$ride->getall($conn);
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
                        }
                        if($key['status']==1)
                        {
                            ?>
                        <td> <a class="cancel zoom" href="?operation=cancel&id=<?php echo $key['ride_id'];?>">Cancel</a>
							<a class="approve zoom" href="?operation=approve&id=<?php echo $key['ride_id'];?>">Approve</a>
						</td>
                        <?php
                        }
                        else echo '<td> </td>';
                        ?>
						<td> 
							<a class="delete zoom" href="?action=delete&id=<?php echo $key['ride_id'];?>">Delete</a>
						</td>
						
					</tr>
				<?php
				}
			}?>

	</table>
</div>
</section>
<?php 
include 'footer.php';
?>