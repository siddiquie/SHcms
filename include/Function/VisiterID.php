<?php

function VisiterID(){
	
	global $con;
	global $hostname;
	
	static $VisiterID;
	
	$VisiterIP = VisiterIP();
	
	$datetime = date("Y-m-d H:i:s");

	//if(isset($version) && $version="v2"){ include(); }


	
	if(!isset($VisiterID)){
		
		if(isset($_COOKIE['VisiterID'])){ 
			//echo"CookieFound";
			if($_COOKIE['VisiterID']=="0"){ 
				//echo"CookieZero";
				setcookie("VisiterID", "", time()-86400, "/");
				unset($_SESSION["VisiterID"]);
			} else {
				$value="$_COOKIE[VisiterID]";
				setcookie("VisiterID", $value, time()+2592000, "/"); // i Think i have ever set for 30days
				$_SESSION['VisiterID']= "$value";
				$VisiterID="$value";
				$con->query("UPDATE `visiters` SET `OnlineDateTime`='$datetime' WHERE Id=$VisiterID");
			}
		
			
		} else {
			
			unset($_SESSION["VisiterID"]);
		}

		if(!isset($_SESSION["VisiterID"])){
			//echo"SessionNotFound";
			//$con->query("INSERT INTO `visiters` (`OnlineDateTime`, `Ip`, `CreateDateTime`) VALUES (date('Y-m-d H:i:s'), VisiterIP(), date('Y-m-d H:i:s'))");
			//$con->query("INSERT INTO `visiters` (`OnlineDateTime`, `Ip`, `CreateDateTime`) VALUES ('$datetime', VisiterIP())");
			$con->query("INSERT INTO `visiters` (`OnlineDateTime`, `Ip`, `Hostname`, `CreateDateTime`) VALUES ('$datetime', '$VisiterIP', '$hostname', '$datetime')");
			
			$VisiterID=mysqli_insert_id($con);
			$_SESSION['VisiterID']= "$VisiterID";
			setcookie("VisiterID", $VisiterID, time()+2592000, "/");	// i Think i have ever set for 30days

			
		}
	}
	


	//unset($_SESSION);
	$return=$_SESSION['VisiterID'];
	return $return;
	
}


?>