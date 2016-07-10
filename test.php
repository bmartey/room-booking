<?php
	include_once("bookingsclass.php");
    $get= new bookingsclass();
    $status="APPROVED";
    $getbooks= $get-> getBookings($status);
    $getrow=$get->fetch();
    $r=0;

    while($getrow){;
      $allstatus[$r]=$getrow['BOOKER'];
      $r++;
      $getrow=$get->fetch();
    } 
    $approved=$r;
 
    echo "{ name: '".$status."', y:".$approved."},";
?>