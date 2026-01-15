<?php 

function singleQuery($Where, $return='*'){
    global $con;
    $result = $con->query("SELECT ".$return."  FROM ".$Where." LIMIT 1");
    $num=mysqli_num_rows($result);
    $row = $result->fetch_assoc();
    if($return=="*"){ 
        $return=$row;
    } else { 
        $return=$row[$return]; }
    return $return;
}

?>