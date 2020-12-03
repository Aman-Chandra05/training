<?php 
function countusers($conn,$status=-1)
{
    if($status==-1)
    {
        $sql="SELECT count(*) as total FROM `tbl_user` WHERE `is_admin`='0'";
    }
    else
    {
        $sql="SELECT count(*) as total FROM `tbl_user` WHERE `isblocked`='$status' AND `is_admin`='0'";
    }
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();
    return $row['total'];
}

function countrides($conn,$status=-1)
{
    if($status==-1)
    {
        $sql="SELECT count(*) as total FROM `tbl_ride`";
    }
    else
    {
        $sql="SELECT count(*) as total FROM `tbl_ride` WHERE `status`='$status'";
    }
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();
    return $row['total'];   
}

function countloc($conn,$status=-1)
{
    if($status==-1)
    {
        $sql="SELECT count(*) as total FROM `tbl_location`";
    }
    else
    {
        $sql="SELECT count(*) as total FROM `tbl_location` WHERE `is_available`='$status'";
    }
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();
    return $row['total'];   
}

function earnings($conn)
{
    $sql="SELECT sum(`total_fare`) as total FROM `tbl_ride` WHERE `status`='2'";
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();
    return $row['total']; 
}