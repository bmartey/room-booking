<?php
  session_start();
  
  $sessname=$_SESSION['USERNAME'];
  $sessfirstname=$_SESSION['FNAME'];
  $sesslastname=$_SESSION['LNAME'];
  $sessemail=$_SESSION['EMAIL'];

  if(!isset($_SESSION['USERNAME'])){
    header("Location: admin.php");
    exit();
  }
?>
<?php 
	include_once("bookingsclass.php");
	$info= new bookingsclass();
	$change= new bookingsclass();
	if(isset($_REQUEST['approve'])){
		$id=$_REQUEST['approve'];
		$request="approved";
		$status="approve";
	}else if(isset($_REQUEST['disapprove'])){
		$id=$_REQUEST['disapprove'];
		$request="denied";
		$status="disapprove";
	}
	$getinfo=$info->getBookingById($id);
	$getinforow=$info->fetch();
	$email=$getinforow['EMAIL'];
	$title=$getinforow['NAME'];
	$room=$getinforow['ROOM_BOOKED'];
	$date=$getinforow['START_DATE'];
	$starttime=$getinforow['START_TIME'];
	$action=$change->changeStatus($status,$id);
	if($action==1){
		$bookeremail=$email;
		$sessname=$sessfirstname." ".$sesslastname;
		include_once("emailclass.php");
		$email=new emailclass();
		$send=$email-> recieveinfo($sessemail,$sessname,$request,$title,$date,$room,$starttime,$bookeremail);
	}	

	header('Location:bookinglist.php');
?>