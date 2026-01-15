<?php 
    if(isset($PgCfg["navbar"])){
        if(is_file("page/inc/".$PgCfg["navbar"])){ include("page/inc/".$PgCfg["navbar"]); }
    } else {
        if(is_file("page/inc/navbar.php")){ include("page/inc/navbar.php"); }
    }
     ?>
<div class="position-fixed d-flex flex-column " id="sh-Notification" style="right:16px; top:16px; z-index:1080;" ></div>
<div class="modal" id="sh-Modal-Ajax" ><div class="modal-dialog modal-dialog-centered  text-center"><i class="fas fa-cog fa-spin fa-5x mx-auto"></i></div></div>
<div class="modal" id="sh-Modal-Waiting" ><div class="modal-dialog modal-dialog-centered  text-center"><i class="fas fa-cog fa-spin fa-5x mx-auto"></i></div></div>
<?php if(is_file("include/config/MaintenanceModeOn.php")){ ?>
    <script>
        sh_NotificationBS4("Maintenance Mode Enable");
    </script>
<?php } ?>
<?php if(is_file("page/inc/bodyHeader.proj.php")){ include("page/inc/bodyHeader.proj.php"); } ?>