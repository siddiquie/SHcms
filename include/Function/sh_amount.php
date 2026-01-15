<?php 
function sh_amount($Amount='0.00', $Symbol=null, $Decimals=null, $DecimalSeparator=null, $ThousandsSeparator=null){
    $Amount=floatval($Amount);

    if(isset($Symbol)){
    } else {
        $Symbol='Yes';
    }
    if(isset($Decimals)){
    } else {
        if(config("Region/Decimals")!=""){ $Decimals=config("Region/Decimals"); } else { $Decimals='2'; }
    }
    if(!isset($DecimalSeparator)){ if(config("Region/DecimalSeparator")!=""){ $DecimalSeparator=config("Region/DecimalSeparator"); } else { $DecimalSeparator=','; } }
    if(!isset($ThousandsSeparator)){ if(config("Region/ThousandsSeparator")!=""){ $ThousandsSeparator=config("Region/ThousandsSeparator"); } else { $ThousandsSeparator=''; } }

    $Amount=number_format($Amount, $Decimals, $DecimalSeparator, $ThousandsSeparator);

    if($Symbol=="Yes"){ 
        if(config("Region/CurrencySymbol")!=""){ $Amount=config("Region/CurrencySymbol")."&nbsp;$Amount"; } else { $Amount="&euro;&nbsp;$Amount"; }
        //$Amount="&euro; $Amount";
    }
    return $Amount;
}
?>