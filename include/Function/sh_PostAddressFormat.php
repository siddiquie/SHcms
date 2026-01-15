<?php 

function sh_PostAddressFormat($CountryCode, $City, $Zipcode=null, $Address=array()){

    // Default
    $return=null;
    foreach($Address as $AddrLine){
        if(isset($AddrLine) AND strlen($AddrLine)>"0"){ $Line[]=$AddrLine; }
    }
    $Line[]=$Zipcode;
    $Line[]=$City;
    $first=true;
    foreach($Line as $SingleLine){
        if($first==true){ 
            $return=$SingleLine;
            $first=false;
        } else {
            $return .="\n".$SingleLine;
        }
        
    }



    if($CountryCode=="NL"){

        $Line1=$Address["0"]." ".$Address["1"];
        if(isset($Address["2"]) AND strlen($Address["2"])>"0"){ $Line1 .="-".$Address["2"]; }
        $Line2=$Zipcode." ".$City;

        $return="$Line1\n$Line2";
    }
    if($CountryCode=="NO"){

        $Line1=$Address["0"]." ".$Address["1"];
        if(isset($Address["2"]) AND strlen($Address["2"])>"0"){ $Line1 .="-".$Address["2"]; }
        $Line2=$Zipcode." ".$City;

        $return="$Line1\n$Line2";
    }

    return $return;
}







?>