<?php 
function sh_calc($Value){
    $Value_exp=explode('|', $Value);
    $total=0;
   
    foreach($Value_exp as $x => $val){
        $CalcProcent="No";

        //Procent Found in Last
        if (strpos($val, '%') !== false) {
            $val = str_replace('%', "", "$val");
            $CalcProcent="Yes";
        }

        //Calculater 
        if (strpos($val, '+') !== false) {
            $val = str_replace('+', "", "$val");
            if($CalcProcent=="Yes"){ $val=$val / 100 * $total; }
            $total=$total + $val;
        } elseif (strpos($val, '-') !== false) {
            $val = str_replace('-', "", "$val");
            if($CalcProcent=="Yes"){ $val=$val / 100 * $total; }
            $total=$total - $val;
        } elseif (strpos($val, '*') !== false) {
            $val = str_replace('*', "", "$val");
            if($CalcProcent=="Yes"){ $val=$val / 100 * $total; }
            $total=$total * $val;
        } elseif (strpos($val, '/') !== false) {
            $val = str_replace('/', "", "$val");
            if($CalcProcent=="Yes"){ $val=$val / 100 * $total; }
            $total=$total / $val;
        } else {
            $total=$val;
        }
        
    }
    //$total=$Val1 $Do $Var2;
    return $total;
}
?>