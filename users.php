<?php
/**
*/
include_once("adb.php");
/**
*Users  class
*/
class users extends adb{
	function users(){
	}
	/**
	*Adds a new user
	*@param string username login name
	*@param string firstname first name
	*@param string lastname last name
	*@param string password login password
	*@param string email
	*@param int level level of the user account
	*@return boolean returns true if successful or false 
	*/
	function addUser($username,$firstname='none',$lastname='none',$password='none',$email="",$level=""){
		$strQuery="insert into users set
						USERNAME='$username',
						FIRSTNAME='$firstname',
						LASTNAME='$lastname',
						PASSWORD=MD5('$password'),
						EMAIL='$email',
						LEVEL='$level'";
		return $this->query($strQuery);				
	}

	/**
	*updates a user
	*@param int id gives usercode of the user account
	*@param string username login name
	*@param string firstname first name
	*@param string lastname last name
	*@param string password login password
	*@param string email
	*@param int level level of the user account
	*@return boolean returns true if successful or false 
	*/
	function updateUser($usercode,$username,$firstname,$lastname,$email,$password,$level){
		//$permissions=implode(",",$permission);
		$strQuery="update users set USERNAME='$username',FIRSTNAME='$firstname',LASTNAME='$lastname',EMAIL='$email',LEVEL='$level' where ID = '$usercode'";
		return $this->query($strQuery);				
	}

	/**
	*gets user records based on the filter
	*@param string mixed condition to filter. If  false, then filter will not be applied
	*@return boolean true if successful, else false
	*/
	function getUsers($filter=false){
		$strQuery="select ID,USERNAME,FIRSTNAME,LASTNAME,EMAIL,PASSWORD,LEVEL from users";
		if($filter!=false){
			$strQuery=$strQuery . " where $filter";
		}
		return $this->query($strQuery);
	}
	
	/**
	*delete user
	*@param int usercode the user code to be deleted
	*returns true if the user is deleted, else false
	*/
	function deleteUser($usercode){
		$strQuery="Delete from users where users.ID = $usercode";
		return $this->query($strQuery);	
	}

	/**
	*user log in
	*@param string username  
	*@param password login password
	*returns a boolean true if successful, else, false
	*/

	function login($username, $password){
			$strQuery="select * from users where USERNAME = '$username' && PASSWORD = MD5('$password')";
			
			$result = $this->query($strQuery);
			if ($result){
				echo"true";
				return $this->fetch();
			}else{
				echo $result;
				return $result;
			}
	}
			
}
?>