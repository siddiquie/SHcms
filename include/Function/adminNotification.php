<?php 

function adminNotification($Level, $Title, $Note){
    global $con;
    global $datetime;
    $query="INSERT INTO `admin_notification` (`Datetime`, `LEVEL`, `Title`, `Note`, `[admin_users]Id`) 
        VALUES 
        ('$datetime', '$Level', '$Title', '$Note', '1')";
    $con->query("$query");
}

?>