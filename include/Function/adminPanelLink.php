<?php 
function sh_adminPanelLink(){
    global $con;

    $return=false;
    if(isset($_SESSION["LoggedInUserID"])){
        $UserID=$_SESSION["LoggedInUserID"];
        $sql = "SELECT `adminPanelLink` FROM `users` WHERE `Id`='$UserID'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row["adminPanelLink"]=="Yes"){
                $return=true;
            }
        }

    }
    return $return;

} 
?>