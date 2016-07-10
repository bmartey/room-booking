<?php
	include_once("bookingsclass.php");
	$subs=new bookingsclass();
	if(isset($_REQUEST['submit'])){
		$name=$_REQUEST['name'];
		$floor=$_REQUEST['floor'];
		$description=$_REQUEST['description'];
		$room=$_REQUEST['room'];
		$sdate=$_REQUEST['date'];
		$edate=$_REQUEST['date'];
		$email=$_REQUEST['email'];
		if(!($_REQUEST['date'])){
			$sdate=$_REQUEST['startdate'];
			$edate=$_REQUEST['enddate'];
		}
		$start=$_REQUEST['starttime'];
		$end=$_REQUEST['endtime'];
		$booker=$_REQUEST['personname'];

		if(!empty($_REQUEST['items'])){
	      $items=$_REQUEST['items'];
	      $itemlist=implode(", ",$items);
	    }else{
	      $items="";
	      $itemlist="";
	    }
	    
		$r=$subs->addBooking($name,$floor,$description,$room,$booker,$email,$itemlist,$sdate,$edate,$start,$end);
		//email function
		
		include_once("emailclass.php");
		$email=new emailclass();
		$send=$email-> sendinfo($booker);
	
		header('Location:index.php');
	}else{
		header('Location:bookroom.php');
	}

	header('Location:index.php');
	
?>
