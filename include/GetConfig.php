<?php
function GetConfig($ConfigCodename){
	global $con;
	$Return=null; 

	// OLD Config
	$query="SELECT `FilterTo`, `ConfigValue` FROM `config_extra` WHERE `CodeName`='$ConfigCodename' ";
	$query .=" AND `FilterTo`='Default' ";
	if(isset($_SESSION["LoggedInUserID"])){ $query .=" OR `FilterTo`='UserID:$_SESSION[LoggedInUserID]' "; }
	$query .=" ORDER BY `OrderBy` ASC ";
	
    
    $result = $con->query($query);
	while($obj = mysqli_fetch_object($result)){
		if($obj->FilterTo=="Default"){ $Return="$obj->ConfigValue"; }
		if(isset($SESSION["LoggedInUserID"]) AND $obj->FilterTo=="UserID:".$_SESSION["LoggedInUserID"]){ $Return="$obj->ConfigValue"; }
	}
    // END of OLD Config


	// New Config , Default Config
	$query="SELECT `ConfigValue` FROM `config_extra` WHERE `CodeName`='$ConfigCodename' AND `FilterTo`='Default' ";
	$result = $con->query($query);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$Return=$row["ConfigValue"];
	}

	// New Config , User Specific Config
	if(isset($_SESSION["LoggedInUserID"])){ // if User is LogedIn
		$query="SELECT `ConfigValue` FROM `config_extra` WHERE `CodeName`='$ConfigCodename' AND `FilterTo`='UserID:".$_SESSION["LoggedInUserID"]."'";
		$result = $con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$Return=$row["ConfigValue"];
		}
	}


    
	eval("\$Return = \"$Return\";");
	
    
    
	return $Return;
}
?>