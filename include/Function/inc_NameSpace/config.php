<?php
$PluginCodename = substr(__NAMESPACE__, 2); // Automatic Getting NameSpace Name after P
if(is_file("include/config/CMS/Plugin/$PluginCodename/$virable.php")){
    $config=\config("CMS/Plugin/$PluginCodename/".$virable);
} else {
    if(is_file("include/config/CMS/Plugin/$PluginCodename/$virable.cfg.php")){
        $config=\config("CMS/Plugin/$PluginCodename/".$virable);
    } else {
        $config=\config($virable);
    }
}

?>