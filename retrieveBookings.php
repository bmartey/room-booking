<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "work2";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* Database connection end */
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
// getting total number records without any search
$sql = "SELECT BOOKER, NAME, FLOOR, ROOM_BOOKED, START_DATE, END_DATE, START_TIME, END_TIME, BOOKING_ID, COLOUR ";
$sql.=" FROM bookings WHERE STATUS = 'APPROVED'";
$query=mysqli_query($conn, $sql) or die("retrieveBookings.php: get bookings");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	$nestedData["id"] = $row["BOOKING_ID"];
	$nestedData["title"] = $row["NAME"]." in ".$row["ROOM_BOOKED"]." on ".$row["FLOOR"];
	$nestedData["start"] = $row["START_DATE"]."T".$row["START_TIME"];
	$nestedData["end"] = $row["END_DATE"]."T".$row["END_TIME"];
	$nestedData["allday"] = false;
	$nestedData["color"] = $row["COLOUR"];
	
    $data[] = $nestedData;
}
$json_data =$data;

echo json_encode($json_data);  // send data as json format

?>