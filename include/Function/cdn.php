<?php
function cdn($src, $return="echo"){ 
	//$cdn_url="https://cdn.sidhosting.net";
	// create config file config("CMS/Plugin/CDN/") =>
	
	if(config("CMS/Plugin/CDN/Hostname")!=""){
		$cdn_url=config("CMS/Plugin/CDN/Hostname");
	}
    if(isset($cdn_url)){ 
		$src="https://".$cdn_url."/".$src; 
	} else {
		$Parse_url=parse_url($src);
		if(!isset($Parse_url["host"]) AND !isset($Parse_url["scheme"])){ 
			$Parse_url["scheme"]="$_SERVER[REQUEST_SCHEME]";
			$Parse_url["host"]="$_SERVER[HTTP_HOST]"; 
			$src=$Parse_url["scheme"]."://".$Parse_url["host"]."/".$src;
		}
	}
	//print_r($Parse_url);
	if($return=="echo"){
		echo "$src"; 
	} 
	if($return=="return"){
		return $src;
	}
	
}
?>
