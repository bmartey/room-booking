<?php 

	include_once("adb.php");
	/**
	*booking class
	*/
	class bookingsclass extends adb{
		function bookingsclass(){
		}
		/**
		*Adds a new booking
		*@param string bookie person booking the room's name
		*@param int room name of room booked 
		*@param int date date the room is booked
		*@param int duration how long you want the room to be booked
		*@return boolean returns true if successful or false 
		*/
		function addBooking($name,$floor,$description,$room,$booker,$email,$itemlist,$sdate,$edate,$start,$end){
			$strQuery="insert into bookings set NAME='$name',FLOOR='$floor', DESCRIPTION='$description', ROOM_BOOKED='$room', BOOKER = '$booker',
			EMAIL = '$email', ITEMS_NEEDED='$itemlist', START_DATE='$sdate', END_DATE='$edate', START_TIME='$start',END_TIME='$end' ";
			return $this->query($strQuery);				
		}

		/**
		*Adds a new booking
		*@param string bookie person booking the room's name
		*@param int room name of room booked 
		*@param int date date the room is booked
		*@param int duration how long you want the room to be booked
		*@return boolean returns true if successful or false 
		*/
		function adminAddBooking($name,$floor,$description,$room,$booker,$email,$itemlist,$sdate,$edate,$start,$end,$colour){
			$strQuery="insert into bookings set NAME='$name',FLOOR='$floor', DESCRIPTION='$description', ROOM_BOOKED='$room', BOOKER = '$booker',
			EMAIL = '$email', ITEMS_NEEDED='$itemlist', START_DATE='$sdate', END_DATE='$edate', START_TIME='$start',END_TIME='$end',STATUS='APPROVED',COLOUR='$colour' ";
			return $this->query($strQuery);				
		}

		/**
		*Deletes a booking
		*@param int bookingId id of the room booked
		*@return boolean returns true if successful or false 
		*/
		function deleteBooking($bookingId){
			$strQuery="delete from bookings where BOOKING_ID = '$bookingId'";
			return $this->query($strQuery);				
		}

		/**
		*gets list of bookings based on the filter
		*@param string mixed condition to filter. If  false, then filter will not be applied
		*@return boolean true if successful, else false
		*/
		function getBookings($filter=false){
			$strQuery="select * from bookings";
			if($filter!=false){
				$strQuery=$strQuery . " where STATUS = '$filter'";
			}
			return $this->query($strQuery);
		}

		/**
		*gets a booking based on the ID
		*@param string mixed condition to filter. 
		*@return boolean true if successful, else false
		*/
		function getBookingById($filter){
			$strQuery="select * from bookings where BOOKING_ID = '$filter'";
			return $this->query($strQuery);
		}


		/**
		*gets list of rooms based on the filter
		*@param string mixed condition to filter. If  false, then filter will not be applied
		*@return boolean true if successful, else false
		*/
		function getRooms($filter=false){
			$strQuery="select ROOM_ID, ROOM_NAME, FLOOR_ID from rooms";
			if($filter!=false){
				$strQuery=$strQuery . " where FLOOR_ID = '$filter'";
			}
			return $this->query($strQuery);
		}

		/**
		*adds a room based on filters
		*@param string mixed condition to filter. If  false, then filter will not be applied
		*@return boolean true if successful, else false
		*/
		function addRoom($filter,$room){
			$strQuery="insert into rooms set ROOM_NAME='$room', FLOOR_ID='$filter'";
			return $this->query($strQuery);
		}

		/**
		*gets list of floors based on the filter
		*@param string mixed condition to filter. If  false, then filter will not be applied
		*@return boolean true if successful, else false
		*/
		function getFloors($filter=false){
			$strQuery="select * from floor";
			if($filter!=false){
				$strQuery=$strQuery . " where NAME = '$filter'";
			}
			return $this->query($strQuery);
		}

		/**
		*adds a room based on filters
		*@param string mixed condition to filter. If  false, then filter will not be applied
		*@return boolean true if successful, else false
		*/
		function addFloor($filter){
			$strQuery="insert into floor set NAME='$filter'";
			return $this->query($strQuery);
		}

		/**
		*/
		function changeStatus($filter,$id){
			switch ($filter){
				case 'approve':
					$strQuery="update bookings set STATUS='APPROVED'";
					if($id!=false){
						$strQuery=$strQuery. "where BOOKING_ID = '$id'";
					}
					break;
				case 'disapprove':
					$strQuery="update bookings set STATUS='DISAPPROVED'";
					if($id!=false){
						$strQuery=$strQuery. "where BOOKING_ID = '$id'";
					}
					break;
				default:
					$strQuery="";
			}
			return $this->query($strQuery);
		}

	}
?>