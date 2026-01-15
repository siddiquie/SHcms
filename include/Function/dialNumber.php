<?php 

function dialNumber($input) {
    // Houd alleen cijfers en het plusteken over
    return preg_replace('/[^\d+]/', '', $input);
}
?>