<?php 

function sh_file_get_contents($url){

    
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );

    $html = file_get_contents($url, false, stream_context_create($arrContextOptions));

    return $html;
}
?>