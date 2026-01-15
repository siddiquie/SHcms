<?php 

Function config($name='', $extra=null){
	global $con;
	global $Page;
	global $hostname;
	global $path;
	if(function_exists("VisiterIP")){
		$VisiterIP=VisiterIP(); 
	}
	$ConfigCodename=$name;



	$MaintenanceMode="Disable"; //Enable/Disable
	$MaintenanceModeEmail="info@sidhosting.net"; //Enable/Disable
	$MaintenanceModeDisableForIP=array('');
	
    $MySQL_address="localhost"; // Older version then 3.1.1
    $MySQL_database=""; // Older version then 3.1.1
    $MySQL_username=""; // Older version then 3.1.1
    $MySQL_password=""; // Older version then 3.1.1
	if($name=="MySQL_address"){ $name='MySQL/hostname'; } // Older version then 3.1.1
	if($name=="MySQL_username"){ $name='MySQL/username'; } // Older version then 3.1.1
	if($name=="MySQL_password"){ $name='MySQL/password'; } // Older version then 3.1.1
	if($name=="MySQL_database"){ $name='MySQL/database'; } // Older version then 3.1.1
    
    $WebSiteName="PointOfSale";
	$WebSiteShortName="POS";
	
	$WebSiteFontIcon='<span class="fa fa-file-text-o fa-lg"></span>';
	
	$Default_CMS_Pages="include/Pages/"; /* always end with slush*/
	
	
	$Installed_Bootstrap3="Y"; /* (Y/N) */
    
	
	
	
	/*
	========
	== No Changes After this
	========
	*/
	
	// Comment OUT on "2020-11-21"
	// if(is_file($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".cfg.php")){
	// 	$ReturnFile=file_get_contents($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".cfg.php"); // Loading Default Setting
	// 	if(is_file($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".php")){ // When PHP file there
	// 		include($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".php");	
	// 	}
	// 	$name="ReturnFile";
	// } else {
	// 	$ReturnFile="";
	// 	$name="ReturnFile";
	// }
	



	// Default 
	$ReturnFile=null;

	// Default for creating website
	if($name=="WebLanguage"){ $ReturnFile="EN"; }
	if($name=="Contact/Phone"){ $ReturnFile="+31 50 123 45 67"; }
	if($name=="Contact/Email"){ $ReturnFile="email@example.com"; }
	if($name=="Project/LogoText"){ $ReturnFile="MyWebSite"; }




	// Load Config from File cfg.php
	if(is_file($_SERVER['DOCUMENT_ROOT']."/include/config/".$ConfigCodename.".cfg.php")){
		$ReturnFile=file_get_contents($_SERVER['DOCUMENT_ROOT']."/include/config/".$ConfigCodename.".cfg.php"); // Loading Default Setting
		$name="ReturnFile";
	}
	
	// New Style After 2020-11-21
	if(is_file($_SERVER['DOCUMENT_ROOT']."/include/config/".$ConfigCodename.".php")){ // When PHP file there
		include($_SERVER['DOCUMENT_ROOT']."/include/config/".$ConfigCodename.".php");	
		$name="ReturnFile";
	} else {
		// When there is no PHP File
		if(is_file($_SERVER['DOCUMENT_ROOT']."/include/config/".$ConfigCodename.".cfg.php")){
			$ReturnFile=file_get_contents($_SERVER['DOCUMENT_ROOT']."/include/config/".$ConfigCodename.".cfg.php"); // Loading Default Setting
			$name="ReturnFile";
		} else {
			
			// Back To Really Old 
			
			$name="ReturnFile";
		}
	}


	

	
	if(isset($con)){
		sh_debug(array("Msg"=>"Config $ConfigCodename SQL","File"=>__FILE__,"Line"=>__Line__));
		$query="SELECT `ConfigValue` FROM `config_extra` WHERE `ConfigName`='$ConfigCodename' AND `FilterTo`='Default' ";
		$result = $con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$ReturnFile=$row["ConfigValue"];
			$name="ReturnFile";
		}


		$query="SELECT `ConfigValue` FROM `config_extra` WHERE `ConfigName`='$ConfigCodename' AND `FilterTo`='VisiterIP:".$VisiterIP."'";
		$result = $con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$ReturnFile=$row["ConfigValue"];
			$name="ReturnFile";
		}


		if(isset($_SESSION["LoggedInUserID"])){ $extra["UserID"]=$_SESSION["LoggedInUserID"]; }
		if(isset($extra["UserID"])){ $extra["UserID"]=intval($extra["UserID"]); }
		if(isset($extra["UserID"])){ // if User is LogedIn
			sh_debug(array("Msg"=>"Config $ConfigCodename SQL > UserID","File"=>__FILE__,"Line"=>__Line__));
			$query="SELECT `ConfigValue` FROM `config_extra` WHERE `ConfigName`='$ConfigCodename' AND `FilterTo`='UserID:".$extra["UserID"]."'";
			$query_html=htmlspecialchars($query);
			sh_debug(array("Msg"=>"Config $ConfigCodename SQL > UserID $query_html","File"=>__FILE__,"Line"=>__Line__));
			$result = $con->query($query);
			if ($result->num_rows > 0) {
				sh_debug(array("Msg"=>"Config $ConfigCodename SQL > UserID Found ","File"=>__FILE__,"Line"=>__Line__));
				$row = $result->fetch_assoc();
				$ReturnFile=$row["ConfigValue"];
				$name="ReturnFile";
			}
		}
		
	}


	if(isset($_SESSION["$ConfigCodename"])){
		$ReturnFile=$_SESSION["$ConfigCodename"];
		$name="ReturnFile";
	}

	

	
	if(function_exists("VisiterIP")){
		$VisiterIP=VisiterIP(); 
		if (in_array("$VisiterIP", $MaintenanceModeDisableForIP)) {
			$MaintenanceMode="Disable"; //Enable/Disable
		}
	}

	
    return ${$name};	
}

?>