<?php 

Function is_Page(){
	
	global $con;
    $debug_function="N"; // Y=Yes / N=No
	
	if($debug_function=="Y"){ $myfile = fopen("is_Page.log.txt", "w") or die("Unable to open file!"); }
	
	$Return="";
	$Access="";
	if(isset($_GET["MyURL"])){ $MyURL=$_GET["MyURL"]; } else { $MyURL=""; }
	
	if($debug_function=="Y"){ fwrite($myfile, "1.)MyURL = $MyURL\n"); } // 1.DebugFile
	
	if(isset($con)){ 
		if($debug_function=="Y"){ fwrite($myfile, "2.)MySQL connected\n"); } // 2.DebugFile
		while($Return==""){
			
			$result = $con->query("SELECT `Page`,`Access`  FROM `pages` WHERE `URL`='$MyURL' ");
			$num=mysqli_num_rows($result);
			if($num=="0"){
				if($debug_function=="Y"){ fwrite($myfile, "2.1.) = Query = 0  -- $MyURL -- \n"); }
				$i=0;
				//print_r($MyURL);
				//if($debug_function=="Y"){ fwrite($myfile, "MyURL = $MyURL\n"); }
				if(isset($ProcentON) AND $ProcentON=="Yes"){ $NumberToExit="-2"; } else { $NumberToExit="-1"; $ProcentON=""; }
				$MyURL_exp=explode('/', $MyURL, $NumberToExit); // Remove Last one & Explode
				//print_r($MyURL_exp);
				$MyURL="";
				$count=count($MyURL_exp);
				if($debug_function=="Y"){ fwrite($myfile, "Explode (with lost one) Count = $count \n"); }
				if($count=="0"){ 
					if($debug_function=="Y"){ fwrite($myfile, "Explode count was 0 -- Return : 404 -- \n"); }
					$Return="404"; 
				} else {
					while($i<$count){
						if($debug_function=="Y"){ fwrite($myfile, "While to create new url = $MyURL & i =  $i\n"); }
						$MyURL .=$MyURL_exp[$i];
						if($debug_function=="Y"){ fwrite($myfile, "Create 1 = $MyURL \n"); }
						++$i;
						if($i<=$count){ 
							$MyURL .="/";
							if($debug_function=="Y"){ fwrite($myfile, "Create 2 = $MyURL \n"); }
						}
						if($i==$count){ 
							$MyURL .="%"; $ProcentON="Yes";
							if($debug_function=="Y"){ fwrite($myfile, "Create 3 = $MyURL \n"); }
						}
						
						
					}
				}
			} else {
				while($obj = mysqli_fetch_object($result)){
					
					$Return="$obj->Page"; 
					$Access="$obj->Access"; 
					if($Access=="User"){  $Return="Login.php"; 
						if(isset($_SESSION["LoggedInUserID"])){ $Return=$obj->Page;  }
					}
				}
			}
		}
    } else {
		if($debug_function=="Y"){ fwrite($myfile, "2.)MySQL not connected\n"); } // 2.DebugFile
		// Where there is no $MyURL go to Home
		if(!$MyURL){ $Return="Home.php"; 
		} else { 
			$Return=$MyURL.".php";
		}
	}
	eval("\$Return = \"$Return\";");
	if($debug_function=="Y"){ fclose($myfile);  } 
	
	return $Return;
}

?>