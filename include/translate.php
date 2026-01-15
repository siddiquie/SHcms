<?php 

Function translate($Get){
    
    global $con;
    
    if(!$Get[Language]){ $Get[Language]=GetConfig("WebLanguage"); }
    
    $query="SELECT * FROM `translate` WHERE `Place`='$Get[Place]' AND `Text`='$Get[Text]' AND `LanguageCode`='$Get[Language]'  ORDER BY `Id` ASC LIMIT 1 " ;
    $result=mysqli_query($con, $query);
    $num = mysqli_num_rows($result);
    if($num=="1"){
        $obj = mysqli_fetch_object($result);
        $ReturnText=$obj->ReturnText;
    } 
    if($num=="0"){
        $query2="SELECT * FROM `translate` WHERE `Text`='$Get[Text]' AND `LanguageCode`='$Get[Language]'  ORDER BY `Id` ASC LIMIT 1 " ;
        $result2=mysqli_query($con, $query2);
        $num2 = mysqli_num_rows($result2);
        if($num2=="1"){
            $obj2 = mysqli_fetch_object($result2);
            $ReturnText=$obj2->ReturnText;
        }
        if($num2=="0"){
            $ReturnText=$Get[Text];
        }
    }
    
    
    //$ReturnText=$num;
    return $ReturnText;
    
}

Function t($Get, $array=''){
    
    global $con;
    
    global $Function__t__Language;
    global $Function__t__Place;
    
    

    if(is_array($Get)){
        $Get_Text=$Get["Text"];
        
        if($Get["Place"]){  $Get_Place=$Get["Place"]; 
        } else {
            
            if($Function__t__Place){ $Get_Place=$Function__t__Place; }
        }
        
        if($Get["Language"]){ $Get_Language=$Get["Language"]; 
        } else {
            if($Function__t__Language){ $Get_Language=$Function__t__Language; 
            } else {
                $Get_Language=config("WebLanguage");
            }
        }
        
    } else {
        
        $Get_Text=$Get;
        
        $Get_Language=$Function__t__Language ?? config("WebLanguage") ; 
       
        $Get_Place=$Function__t__Place ?? null;
        
    }
    
    //$Get_Text=htmlspecialchars($Get_Text);
    
    if(is_file("include/Function/Plugin/Translate/NameSpace.php")){
        $ReturnText=\P\Translate\text($Get_Text, $Get_Language, $Get_Place);
    } else { // Just Return
        $ReturnText=$Get_Text;
    }
    // $query="SELECT * FROM `translate` WHERE `Place`='$Get_Place' AND `Text`='$Get_Text' AND `LanguageCode`='$Get_Language'  ORDER BY `Id` ASC LIMIT 1 " ;
    // $result=mysqli_query($con, $query);
    // if($result){ $num = mysqli_num_rows($result); 
    //     if($num=="1"){
    //         $obj = mysqli_fetch_object($result);
    //         $ReturnText=$obj->ReturnText;
    //     } 
    // } else { $num=0; }
    // if($num=="0"){
    //     $query2="SELECT * FROM `translate` WHERE `Text`='$Get_Text' AND `LanguageCode`='$Get_Language'  ORDER BY `Id` ASC LIMIT 1 " ;
    //     $result2=mysqli_query($con, $query2);
    //     if($result2){
    //         $num2 = mysqli_num_rows($result2);
    //         if($num2=="1"){
    //             $obj2 = mysqli_fetch_object($result2);
    //             $ReturnText=$obj2->ReturnText;
    //         }
    //     } else { $num2=0; }
    //     if($num2=="0"){
            
    //         $ReturnText=$Get_Text;
    //     }
    // }
    eval("\$ReturnText = \"$ReturnText\";");
    return $ReturnText;
    
}

function et(){

    global $con;

    if(function_exists("\P\Translate\text")){

    } else { // Just Return
        $ReturnText=$Get_Text;
    }

    echo $ReturnText;
}
?>