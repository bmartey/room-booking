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

	if (isset($_REQUEST['submitroom'])) {
		$floor2=$_REQUEST['floorold'];
		$room=$_REQUEST['newroom'];
		$getfloor= $subs->getFloors();
		$getfloors= $subs->fetch();
		$i=0;

		while($getfloors){
			$floorarray[$i]= $getfloors['NAME'];
			$i++;
			$getfloors= $subs->fetch();
		}
		if (in_array($floor2, $floorarray)) {
			$floorget= $subs->getFloors($floor2);
			$floorfetch= $subs ->fetch();
			$floorId= $floorfetch['FLOOR_ID'];
		}
		
		$add= $subs->addRoom($floorId,$room);
		header('Location:bookinglist.php');

	} else if(isset($_REQUEST['submitfloor'])){
		$floor1=$_REQUEST['floornew'];

		$flooradd=$subs->addFloor($floor1);
		header('Location:bookinglist.php');
	}

	header('Location:bookinglist.php');

?>