<?php 

	include_once("adb.php");
	/**
	*Subscribers class
	*/
	class itemsclass extends adb{
		function itemsclass(){
		}

		/**
		*gets list of items based on the filter
		*@param string mixed condition to filter. If  false, then filter will not be applied
		*@return boolean true if successful, else false
		*/
		function getItems($filter=false){
			$strQuery="select * from items";
			if($filter!=false){
				$strQuery=$strQuery . " where NAME LIKE '%$filter%'";
			}
			return $this->query($strQuery);
		}

	}
?>