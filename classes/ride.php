<?php
date_default_timezone_set("Asia/Bangkok");
class ride
{
	public function insert($conn,$ses)
	{
		if(isset($ses['username']))
		{
			$date=date("Y/m/d");
			$pick=$ses['pickup'];
			$drop=$ses['drop'];
			$total_distance=$ses['dist'];
			$luggage=$ses['luggage'];
			$total_fare=$ses['price'];
			$customer_user_id=$ses['userid'];
			$cab=$ses['cab'];
			if(isset($ses['userid']) && isset($ses['price']))
			{
				$sql="INSERT INTO `tbl_ride`(`ride_date`, `pick`, `drop`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`,`cab`) VALUES  ('$date','$pick','$drop','$total_distance','$luggage','$total_fare','1','$customer_user_id','$cab')";
				$res=$conn->query($sql);
				if($res)
				{
					return 1;
				}
			}
		}
	}
	
	public function getall($conn)
	{
		$arr=array();
		$sql="SELECT * FROM `tbl_ride`";
		$res=$conn->query($sql);
		if($res->num_rows>0)
		{
			while($row=$res->fetch_assoc())
			{
				$arr[]=$row;
			}
			return $arr;
		}
		else
		return 0;	
	}

	public function changestatus($action,$id,$conn)
	{
		if($action=='cancel')
			$status=0;
		elseif($action=='approve')
			$status=2;
		$sql="UPDATE `tbl_ride` SET `status`='$status' WHERE `ride_id`='$id'";
		$res=$conn->query($sql);
	}

	public function delete($conn,$id)
	{
		$sql = "DELETE FROM `tbl_ride` WHERE `ride_id`='$id'";
		$conn->query($sql);
	}

	public function rides($conn,$action)
	{

		$arr=array();
		if($action=='pending')
			$sql="SELECT * FROM `tbl_ride` WHERE `status`='1'";
		elseif($action=='complete')
			$sql="SELECT * FROM `tbl_ride` WHERE `status`='2'";
		elseif($action=='cancelled')
			$sql="SELECT * FROM `tbl_ride` WHERE `status`='0'";
		$res=$conn->query($sql);
		if($res->num_rows>0)
		{
			while($row=$res->fetch_assoc())
			{
				$arr[]=$row;
			}
			return $arr;
		}
		else
		return 0;	
	}
		
	public function showrides($status,$conn,$ses)
	{
		if(isset($ses['username']))
		{
			$customer_user_id=$ses['userid'];
			if($status=='pending')
				$status=1;
			elseif ($status=='complete') 
				$status=2;
			if($status==1 || $status==2)
			{
				$sql="SELECT * FROM `tbl_ride` WHERE `customer_user_id`='$customer_user_id'AND `status`='$status'";
			}
			else 
				$sql="SELECT * FROM `tbl_ride` WHERE `customer_user_id`='$customer_user_id'";
			$res=$conn->query($sql);
			while($row=$res->fetch_assoc())
			{
				$arr[]=$row;
			}
			return $arr;
		}
	}

	public function sort($conn,$para,$action=-1)
	{
		
		if($para=='fare')
			$para='total_fare';
		$arr=array();
		if($action==-1)
			$sql="SELECT * FROM `tbl_ride` ORDER BY `$para`";
		else
		{
			if($action=='pending')
			{
				$sql="SELECT * FROM `tbl_ride` WHERE `status`='1' ORDER BY `$para`";
			}
			elseif($action=='complete')
			{
				$sql="SELECT * FROM `tbl_ride` WHERE `status`='2' ORDER BY `$para`";
			}
			elseif($action=='cancelled')
			{
				$sql="SELECT * FROM `tbl_ride` WHERE `status`='0' ORDER BY `$para`";
			}
		}
		$res=$conn->query($sql);
		if($res->num_rows>0)
		{
			while($row=$res->fetch_assoc())
			{
				$arr[]=$row;
			}
			return $arr;
		}
		else
		return 0;	
	}
}
?>