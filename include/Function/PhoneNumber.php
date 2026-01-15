<?php
    function sh_PhoneNumber($number){
		$number=str_replace("+","","$number");
		if(substr("$number", 0, 2)=="00"){
			$number_strlen=strlen($number); $number=substr("$number", 2, "$number_strlen");
		} else {
			if(substr("$number", 0, 1)=="0"){
			   $number_strlen=strlen($number);
			   $number=substr("$number", 1, "$number_strlen"); }
			}
		$return=$number;
		return $return;
	}
?>