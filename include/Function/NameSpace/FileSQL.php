<?php

namespace FileSQL;

function Select($table){

}

function Insert(){

}


function readData($tableName){
    $directory = $_SERVER['DOCUMENT_ROOT'].'/include/DB/'.$tableName.'/data';  // Yahan apni directory ka path den

    // Directory se saari files le lo
    $files = scandir($directory);
    
    foreach ($files as $file) {
        // Directories aur chhoti system files ko skip karo
        if ($file === '.' || $file === '..' || is_dir($directory . '/' . $file)) {
            continue;
        }
    
        // Full file path
        $filePath = $directory . '/' . $file;
    
        // File ka content read karo
        $fileContent = file_get_contents($filePath);
    
        // Content ko JSON mein decode karo
        $data = json_decode($fileContent, true);

        $returnData[]=$data;
    

    }

    if(is_file($_SERVER['DOCUMENT_ROOT'].'/include/DB/'.$tableName.'/config/sortByColum')){
        $sortByColum = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/include/DB/'.$tableName.'/config/sortByColum');
        usort($returnData, function ($a, $b) use ($sortByColum) {            
            return strcmp($a[$sortByColum], $b[$sortByColum]);
        });
    }
    
    return $returnData;
}


function Update($table, $updateID, $data){
    $return=null;
    $filePath = $_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/data/".$updateID;
    if(is_file($filePath)){ 
        
        


        $FileData=file_get_contents($filePath);
        $FileData = json_decode($FileData, true); 


        // Index Delete
        if(is_file($_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/config/index_colums")){
            $FileData_index_colums=file_get_contents($_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/config/index_colums");
            $FileData_index_colums = json_decode($FileData_index_colums, true);
            foreach($FileData_index_colums as $index_colum){
                if(!is_dir($_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/index/".$index_colum)){ mkdir($_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/index/".$index_colum, 0777, true); }
                $indexData_ID=$FileData["Id"];
                $indexData_value=$FileData[$index_colum];
                $deleteFile=$_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/index/".$index_colum."/".$FileData["Username"];
                if($deleteFile){ unlink($deleteFile); }

            }
            
        }



        foreach ($data as $key => $value) { // Start Update
            $FileData[$key]=$data[$key];       
        }
        $FileData_export = json_encode($FileData, JSON_PRETTY_PRINT);
        if (file_put_contents($filePath, $FileData_export)){
            $return=array("Successfully", "Data successfully updated");
        }


        // Index update
        if(is_file($_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/config/index_colums")){
            echo"index_colum found";
            $FileData_index_colums=file_get_contents($_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/config/index_colums");
            $FileData_index_colums = json_decode($FileData_index_colums, true);
            foreach($FileData_index_colums as $index_colum){
                if(!is_dir($_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/index/".$index_colum)){ mkdir($_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/index/".$index_colum, 0777, true); }
                $indexData_ID=$FileData["Id"];
                $indexData_value=$FileData[$index_colum];
                if (file_put_contents($_SERVER['DOCUMENT_ROOT']."/include/DB/".$table."/index/".$index_colum."/".$indexData_value, $indexData_ID)){
                }

            }

        }
    } else {
        $return=array("Error", "Data file not found");
    }

    return $return;
}
?>