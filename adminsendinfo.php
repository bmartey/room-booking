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
	    $colour="#B22222";
		$r=$subs->adminAddBooking($name,$floor,$description,$room,$booker,$email,$itemlist,$sdate,$edate,$start,$end,$colour);
		
	}
	header('Location:bookinglist.php');
	
?>
..