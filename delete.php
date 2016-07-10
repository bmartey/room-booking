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
	$delete= new bookingsclass();
  $info= new bookingsclass();
	
	if(isset($_REQUEST['delete'])){
		$id=$_REQUEST['delete'];

    $request="deleted";

    $getinfo=$info->getBookingById($id);
    $getinforow=$info->fetch();
    $email=$getinforow['EMAIL'];
    $title=$getinforow['NAME'];
    $room=$getinforow['ROOM_BOOKED'];
    $date=$getinforow['START_DATE'];
    $starttime=$getinforow['START_TIME'];

    echo $reason;

		$deletebooking=$delete->deleteBooking($id);
    
    if($deletebooking==1){

      $bookeremail=$email;
      $sessname=$sessfirstname." ".$sesslastname;
      include_once("emailclass.php");
      $email=new emailclass();
      $send=$email-> recievedeleteinfo($sessemail,$sessname,$request,$title,$date,$room,$starttime,$bookeremail);
    }
	}
	header('Location:bookinglist.php');
?>