<?php
session_start();
include 'classes/loc.php';
include 'classes/config.php';
$conn=new dbase();
$conn=$conn->connection();
$loc=new loc();
$arr=array();
$res=$loc->getall($conn);
foreach($res as $key)
{
	$arr[$key['id']]=$key['distance'];
}

$obj=array();
$dist=0;
$pickup='';
$drop='';
$cab='';
$luggage='';
$price=0;
if(isset($_POST))
{
	$pickup=$_POST['pickup'];
	$drop=$_POST['drop'];
	$cab=$_POST['cab'];
	$luggage=$_POST['luggage'];
	$dist=$arr[$pickup]-$arr[$drop];
	$dist=abs($dist);
	$price=calc($cab,$dist);
	$_SESSION['price']=$price;
	$_SESSION['dist']=$dist;
	foreach($res as $key)
	{
		if($key['id']==$pickup)
			$_SESSION['pickup']=$key['name'];
		if($key['id']==$drop)
			$_SESSION['drop']=$key['name'];
	}
	$obj=array("price"=>$price, "dist"=>$dist, "pickup"=>$_SESSION['pickup'], "drop"=>$_SESSION['drop']);
	echo json_encode($obj);
}    
function calc($cab,$dist)
{
	$price=0;
	global $luggage;
	if($dist<=10)
	{
		if($cab=="micro")
		{
			$price=50+$dist*13.5;
		}
		elseif($cab=="mini")
		{
			$price=150+$dist*14.5+weight($luggage,1);
		}
		elseif($cab=="royal")
		{
			$price=200+$dist*15.5+weight($luggage,1);
		}
		elseif ($cab=="suv") 
		{
			$price=250+$dist*16.5+weight($luggage,2);
		}
	}
	elseif($dist>10 && $dist<=60)
	{
		if($cab=="micro")
		{
			$price=50+10*13.5+($dist-10)*12.00;  
		}
		elseif($cab=="mini")
		{
			$price=150+10*14.5+($dist-10)*13+weight($luggage,1);
		}
		elseif($cab=="royal")
		{
			$price=200+10*15.5+($dist-10)*14+weight($luggage,1);      

		}
		elseif ($cab=="suv") 
		{
			$price=250+10*16.5+($dist-10)*15+weight($luggage,2);;  
		}
	}
	elseif($dist>60 && $dist<=160)
	{
		if($cab=="micro")
		{
			$price=50+10*13.5+50*12+($dist-10-50)*10.2;
		}
		elseif($cab=="mini")
		{
			$price=150+10*14.5+50*13+($dist-10-50)*11.2+weight($luggage,1);
		}
		elseif($cab=="royal")
		{
			$price=200+10*15.5+50*14+($dist-10-50)*12.2+weight($luggage,1);
		}
		elseif ($cab=="suv") 
		{
			$price=250+10*16.5+50*15+($dist-10-50)*13.2+weight($luggage,2);;		
		}
	}
	else
	{
		if($cab=="micro")
		{
			$price=50+10*13.5+50*12+100*10.2+ ($dist-10-50-100)*8.5;
		}
		elseif($cab=="mini")
		{
			$price=150+10*14.5+50*13+100*11.2+ ($dist-10-50-100)*9.5+weight($luggage,1);
		}
		elseif($cab=="royal")
		{
			$price=200+10*15.5+50*14+100*12.2+ ($dist-10-50-100)*10.5+weight($luggage,1);
		}
		elseif ($cab=="suv") 
		{
			$price=250+10*16.5+50*12+100*13.2+ ($dist-10-50-100)*11.5+weight($luggage,2);;			
		}
	}
	return $price;
}
function weight($luggage,$para)
{
	if($luggage==0)
	{
		return 0;
	}
	else
	{
		if($luggage<=10)
			return $para*50;
		elseif($luggage>10 && $luggage<=20)
			return $para*100;
		else
			return $para*200;
	}
}
?>