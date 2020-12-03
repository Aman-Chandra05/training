<?php
class loc
{
	public function add($location,$distance,$conn)
	{
		$sql = "SELECT * FROM `tbl_location` WHERE `name`='".$location."'";	    
		$res=$conn->query($sql);
	    if($res->num_rows>0)
	    {
	    	return 0;
	    }
	       else
	    {
	        $sql="INSERT INTO `tbl_location`(`name`, `distance`,`is_available`) VALUES ('$location','$distance','1')";
	        $res=$conn->query($sql);
	        return 1;
	    }  
	}
	public function show($conn)
	{
		$sql = "SELECT * FROM `tbl_location`";	    
		$res=$conn->query($sql);
		return $res;
	}
	public function changestatus($id,$operation,$conn)
	{
		if($operation=='active')
			$status=1;
		else
			$status=0;
		$sql="UPDATE `tbl_location` SET `is_available`='$status' WHERE `id`='$id'";
		$res=$conn->query($sql);
	}
	public function fetch($conn,$id)
	{
		$sql = "SELECT * FROM `tbl_location` WHERE `id`=$id";	    
		$res=$conn->query($sql);
		return $res;
	}
	public function delete($conn,$id)
	{
		$sql = "DELETE FROM `tbl_location` WHERE `id`='$id'";	    
		$conn->query($sql);
	}
	public function update($location,$distance,$id,$conn)
	{
		$sql="UPDATE `tbl_location` SET `name`='$location',`distance`='$distance' WHERE `id`='$id'";
		$res=$conn->query($sql);
		return 1;
	}
	public function getall($conn)
	{
		$sql="SELECT * FROM `tbl_location` WHERE `is_available`='1'";
		$res=$conn->query($sql);
		while($row=$res->fetch_assoc())
		{
			$arr[]=$row;
		}
		return $arr;
	}
}