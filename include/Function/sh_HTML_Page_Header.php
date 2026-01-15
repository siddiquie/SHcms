<?php 
function sh_HTML_Page_Header(){

    ?><!DOCTYPE html>
    <html lang="en">
    <head>
        <?php if(is_file("page/inc/HTML_HEAD.php")){ include("page/inc/HTML_HEAD.php"); } ?>
    </head>
    <body>
    <?php if(is_file("page/inc/navbar.php")){ include("page/inc/navbar.php"); } ?>
    <div class="modal" id="sh-Modal-Ajax"></div>
    <div class="modal" id="sh-Modal-Waiting"><div class="modal-dialog modal-dialog-centered text-center"><i class="fas fa-cog fa-spin fa-5x mx-auto"></i></div></div><?
    
}
?>