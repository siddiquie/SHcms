<?php 

/*
ERROR_Fun_Verify_001
ERROR_Fun_Verify_002
ERROR_Fun_Verify_003
ERROR_Fun_Verify_004
ERROR_Fun_Verify_005
ERROR_Fun_Verify_006
ERROR_Fun_Verify_007
ERROR_Fun_Verify_008
ERROR_Fun_Verify_009

*/

function sh_verify($virable=null, $arr=null){
    global $con;
   

    if(isset($arr["EmptyCheck"])){
        if($arr["EmptyCheck"]==true){
            if(!isset($virable)){ return(array("Status"=>"ERROR", "Code"=>"ERROR_Fun_Verify_001", "Msg"=>"is empty")); }
        }
    }

    if(isset($arr["is_numeric"]) && $arr["is_numeric"]==true){
        //$virable=intval($virable);
        if(!is_numeric($virable)){ return(array("Status"=>"ERROR", "Code"=>"ERROR_Fun_Verify_002", "Msg"=>"is not numeric")); }
    }
    
    if(isset($arr["is_email"]) && $arr["is_email"]==true){
        if(!filter_var($virable, FILTER_VALIDATE_EMAIL)) { return(array("Status"=>"ERROR", "Code"=>"ERROR_Fun_Verify_003", "Msg"=>"is not e-mail")); }
    }

    if(isset($arr["strlen"])){
        if(isset($virable)){
            $virable_strlen=strlen($virable);
            if(isset($arr["is_numeric"]) && $arr["is_numeric"]==true){ $virable_strlen=$virable; }
            $strlen_exp=explode("|", $arr["strlen"]);
            if($virable_strlen<$strlen_exp["0"]){ return(array("Status"=>"ERROR", "Code"=>"ERROR_Fun_Verify_004", "Msg"=>"less then minimum")); }
            if(isset($strlen_exp["1"]) && $virable_strlen>$strlen_exp["1"]){ return(array("Status"=>"ERROR", "Code"=>"ERROR_Fun_Verify_005", "Msg"=>"more then maximum")); }
        }
    }

    if(isset($arr["prefix"])){
        $prefix_strlen=strlen($arr["prefix"]);
        if(substr(strtolower($virable), 0, $prefix_strlen) != strtolower($arr["prefix"])){ return(array("Status"=>"ERROR", "Code"=>"ERROR_Fun_Verify_006", "Msg"=>"prefix not match"));  }
    }

    if(isset($arr["prefix=="])){
        $prefix2_strlen=strlen($arr["prefix=="]);
        if(substr($virable, 0, $prefix2_strlen) != $arr["prefix=="]){ return(array("Status"=>"ERROR", "Code"=>"ERROR_Fun_Verify_007", "Msg"=>"prefix not match"));  }
    }

    if(isset($arr["suffix"])){
        $suffix_strlen=strlen($arr["suffix"]);
        if(substr(strtolower($virable), -$suffix_strlen) != strtolower($arr["suffix"])){ return(array("Status"=>"ERROR", "Code"=>"ERROR_Fun_Verify_008", "Msg"=>"suffix not match"));  }
    }

    if(isset($arr["suffix=="])){
        $suffix2_strlen=strlen($arr["suffix=="]);
        if(substr($virable, -$suffix2_strlen) != $arr["suffix=="]){ return(array("Status"=>"ERROR", "Code"=>"ERROR_Fun_Verify_009", "Msg"=>"suffix not match"));  }
    }

    if(isset($arr["SQLcheck"])){
        list($SQL_title, $SQL_colum)=explode("|", $arr["SQLcheck"]);
        $sql = "SELECT * FROM `".$SQL_title."` WHERE `".$SQL_colum."`='".$virable."' LIMIT 1";
        $result = $con->query($sql);
        if ($result->num_rows=="0"){ return(array("Status"=>"ERROR", "Code"=>"ERROR_Fun_Verify_010", "Msg"=>"not found")); }
    }
    
    return(array("Status"=>"OK", "Code"=>"", "Msg"=>""));
}

?>