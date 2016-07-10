<?php
	
	class emailclass{
		function emailclass(){
		}

		function sendinfo($booker){
			//Email portion of the code
			require_once('PHPMailer-master/class.phpmailer.php');
			require 'PHPMailer-master/PHPMailerAutoload.php';

			$account="youremail@gmail.com";
			$password="youremailpassword";
			$from="sender email@yahoo.com";
			$from_name="NCA Booking Platform";
			$adminemail="adminemailaddress@gmail.com";
			$subject="Booking Notification";
			$message="Booking request received from ".$booker.".<br> Please approve or disapprove in the <a href='http://crbooking.nca.org.gh/' >Booking</a> Interface.<br> Thank you. ";

			$mail = new PHPMailer;

			$mail->IsSMTP();
			$mail->CharSet = 'UTF-8';
		    $mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth= true;
			$mail->Port = 465; //587;
			$mail->Username= $account;
			$mail->Password= $password;
			$mail->SMTPSecure = 'ssl';// 'tls';
			$mail->From = $from;
		    $mail->FromName= $from_name;
			$mail->addAddress($adminemail);	  
			$mail->isHTML(true);                                 

			$mail->Subject = $subject;
			$mail->Body    = $message;

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent. ';
			}
		}



		function recievedeleteinfo($sessemail,$sessname,$request,$title,$date,$room,$starttime,$bookeremail){
			//Email portion of the code
			require_once('PHPMailer-master/class.phpmailer.php');
			require 'PHPMailer-master/PHPMailerAutoload.php';

			$account="youremail@gmail.com";
			$password="youremailpassword";
			$from=$sessemail;
			$from_name=$sessname;
			$subject="Booking Request";
			$message="Your booking request has been ".$request."<br> Booking Information:<br> Title: ".$title."<br> Date: ".$date."<br> Room: ".$room."<br>Start Time: ".$starttime."<br>Thank you. ";

			$mail = new PHPMailer;

			$mail->IsSMTP();
			$mail->CharSet = 'UTF-8';
		    $mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth= true;
			$mail->Port = 465; //587;
			$mail->Username= $account;
			$mail->Password= $password;
			$mail->SMTPSecure = 'ssl';// 'tls';
			$mail->From = $from;
		    $mail->FromName= $from_name;
			$mail->addAddress($bookeremail);	  
			$mail->isHTML(true);                                 

			$mail->Subject = $subject;
			$mail->Body    = $message;

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent. ';
			}
		}


		function recieveinfo($sessemail,$sessname,$request,$title,$date,$room,$starttime,$bookeremail){
			//Email portion of the code
			require_once('PHPMailer-master/class.phpmailer.php');
			require 'PHPMailer-master/PHPMailerAutoload.php';

			$account="youremail@gmail.com";
			$password="youremailpassword";
			$from=$sessemail;
			$from_name=$sessname;
			$subject="Booking Request";
			$message="Your booking request has been ".$request.".<br> Booking Information:<br> Title: ".$title."<br> Date: ".$date."<br> Room: ".$room."<br>Start Time: ".$starttime."<br>Thank you. ";

			$mail = new PHPMailer;

			$mail->IsSMTP();
			$mail->CharSet = 'UTF-8';
		    $mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth= true;
			$mail->Port = 465; //587;
			$mail->Username= $account;
			$mail->Password= $password;
			$mail->SMTPSecure = 'ssl';// 'tls';
			$mail->From = $from;
		    $mail->FromName= $from_name;
			$mail->addAddress($bookeremail);	  
			$mail->isHTML(true);                                 

			$mail->Subject = $subject;
			$mail->Body    = $message;

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent. ';
			}
		}
	}
?>
