<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "work2";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

//print_r($conn);

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'BOOKING_ID',
	1 =>'BOOKER', 
	2 => 'NAME',
	3 => 'ROOM_BOOKED',
	4 => 'START_DATE',
	5 => 'END_DATE',
	6 => 'START_TIME',
	7 => 'END_TIME',
	8 => 'ITEMS_NEEDED',
	9 => 'BOOKING_ID',
	10 => 'BOOKING_ID'
);

// getting total number records without any search
$sql = "SELECT BOOKER, NAME, FLOOR, ITEMS_NEEDED, ROOM_BOOKED, START_DATE, END_DATE, START_TIME, END_TIME, BOOKING_ID ";
$sql.=" FROM bookings WHERE STATUS = 'DISAPPROVED'";
$query=mysqli_query($conn, $sql) or die("datapending.php: get bookings");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT BOOKER, NAME, FLOOR, ITEMS_NEEDED, ROOM_BOOKED, START_DATE, END_DATE, START_TIME, END_TIME, BOOKING_ID ";
$sql.=" FROM bookings WHERE STATUS = 'DISAPPROVED'";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( BOOKER LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR NAME LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("datapending.php: get bookings");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains column index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("datapending.php: get bookings");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["BOOKING_ID"];
	$nestedData[] = $row["BOOKER"];
	$nestedData[] = $row["NAME"];
	$nestedData[] = $row["ROOM_BOOKED"];
	$nestedData[] = $row["START_DATE"];
	$nestedData[] = $row["END_DATE"];
	$nestedData[] = $row["START_TIME"];
	$nestedData[] = $row["END_TIME"];
	$nestedData[] = $row['ITEMS_NEEDED'];
	$nestedData[] = "<a href='#' class='button round success' name='approve' value='{$row['BOOKING_ID']}' onclick='approvenotification({$row['BOOKING_ID']})' type='submit' id='approve' >Approve</a>";
	$nestedData[] = "<a href='#' class='button round alert' value={$row['BOOKING_ID']} onclick='bookingdelete({$row['BOOKING_ID']})' name='delete' type='submit' id='delete'>Delete</a>";
	$data[] = $nestedData;
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
