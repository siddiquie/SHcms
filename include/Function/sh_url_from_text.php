<?php 

function generate_url_from_text($strText) {
    $strText = preg_replace('/[^A-Za-z0-9-]/', ' ', $strText);
    $strText = preg_replace('/ +/', ' ', $strText);
    $strText = trim($strText);
    $strText = str_replace(' ', '-', $strText);
    $strText = preg_replace('/-+/', '-', $strText);
    $strText = strtolower($strText);
    return $strText;
}

?>