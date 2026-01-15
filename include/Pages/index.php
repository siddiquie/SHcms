<?php 
session_start(); 
$debug_file="N"; // Y=Yes / N=No
if($debug_file=="Y"){ $myfile = fopen("index.php.log.txt", "w") or die("Unable to open file!"); }
sh_debug(array("Msg"=>"In File","File"=>__FILE__,"Line"=>__LINE__));

date_default_timezone_set('Europe/Amsterdam');
if(is_file("include/config/php/date_default_timezone_set.php")){ include("include/config/php/date_default_timezone_set.php"); }
if(is_file("include/config.php")){ 
	
	include("include/config.php"); 
}

if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){ $VisiterBrowserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); } else {  $VisiterBrowserLang="en"; }

$protocol = isset($_SERVER['HTTPS']) && \strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
$hostname = $_SERVER['HTTP_HOST'];
$date = date("Y-m-d");
$datetime = date("Y-m-d H:i:s");
$sh_time = date("H:i:s");
$timestamp = time();
$sh_yesterday=date("Y-m-d", strtotime("yesterday"));
$path = $_SERVER['REQUEST_URI'];
$path_parse_url=parse_url($_SERVER["REQUEST_URI"]);
$path_exp=explode('/', $path_parse_url['path']);
if(!isset($_SESSION["VisiterToken"])){ 
	$VisiterTokenBytes=strtoupper(bin2hex(random_bytes("32")));
	$_SESSION["VisiterToken"]=hash('sha256', $VisiterTokenBytes.time());
	$sh_VisiterToken=$_SESSION["VisiterToken"]; // VisiterToken
} else {
	$sh_VisiterToken=$_SESSION["VisiterToken"]; // VisiterToken
}



sh_debug(array("Msg"=>"Load SHcms Functions","File"=>__FILE__,"Line"=>__LINE__));

include("include/Function/index.php");

if(is_file("include/Function/cdn.php")){
	include("include/Function/cdn.php");
}
if(is_file("include/VisiterIP.php")){
	include("include/VisiterIP.php");
}
if(is_file("include/Function/sh_amount.php")){
	include("include/Function/sh_amount.php");
}
if(is_file("include/sh_include.php")){
	include("include/sh_include.php");
}
if(is_file("include/Function/sh_password_gen.php")){
	include("include/Function/sh_password_gen.php");
}

sh_debug(array("Msg"=>"Load SHcms Plugins NameSpace Files","File"=>__FILE__,"Line"=>__LINE__));
if(is_dir("include/Function/Plugin")){
if ($handle = opendir('include/Function/Plugin/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
			//echo "$entry\n";
			if(config("CMS/Plugin/".$entry."/PluginStatus")!="Disable"){
				if(is_dir("include/Function/Plugin/".$entry)){ 
					if(is_file("include/Function/Plugin/".$entry."/NameSpace.php")){ 
						include_once("include/Function/Plugin/".$entry."/NameSpace.php");
					}
				}
			} // Plugin Status is Disable
        }
    }
    closedir($handle);
} /* opendir */ } /* Plugin Dir Check */


if(function_exists("config") AND config("MaintenanceMode")=="Enable"){
	header("HTTP/1.1 503 Service Temporarily Unavailable");
	header("Status: 503 Service Temporarily Unavailable");
	include("include/Pages/Maintenance.php");
	exit();
}

if(function_exists("config")){
	if($debug_file=="Y"){ fwrite($myfile, "Function Config : Founded ( Befor SQL connection )\n"); } // DebugFile
	if(config('MySQL/hostname')){
		if($debug_file=="Y"){ fwrite($myfile, "config MySQL/hostname : Founded ( Befor SQL connection )\n"); } // DebugFile
		try{
			$con = mysqli_connect(config('MySQL/hostname'),config('MySQL/username'),config('MySQL/password'),config('MySQL/database'));
			
		} catch (mysqli_sql_exception $e) {
			// Display a basic error message
			echo "An error occurred while connecting to the database. Please try again later.";
		}

		
	}
}


if(isset($con)){ 
	$con->set_charset("utf8");
	include("include/Function/VisiterID.php"); 
	if($path_exp["1"]!="api"){ VisiterID(); }
	
}


if(isset($con)){ 
	include("include/GetConfig.php"); 
}
if(is_file("include/is_Page.php")){
	include("include/is_Page.php");
}
if(is_file("include/translate.php")){
	include("include/translate.php");
}
if(isset($con) && function_exists("\P\WAF_iP\check_ip")){
	if(\P\WAF_iP\check_ip()){
		header('HTTP/1.0 403 Forbidden');
		header("Status: 403 Forbidde");
		include("include/Pages/ErrorPages/403.php");
		exit;
	}
}

if (isset($_GET['ChangeWebLanguage'])) {

    $_SESSION['WebLanguage'] = $_GET['ChangeWebLanguage'];

    header("Location: ".strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}



if(is_file("include/Class/Account.php")){
	include("include/Class/Account.php");
	if(class_exists('Account')){ $Account = new Account; }
}


if(is_file("include/Class/Cart.php")){
	include("include/Class/Cart.php");
	if(class_exists('Cart')){ $class_Cart = new Cart; }
}

if(is_file("include/Class/Orders.php")){
	include("include/Class/Orders.php");
	if(class_exists('Orders')){ $class_Orders = new Orders; }
}

if(is_file("include/Class/Invoice.php")){
	include("include/Class/Invoice.php");
	if(class_exists('Invoice')){ $Class_Invoice = new Invoice; }
}

if(is_file("include/Class/Inventory.php")){
	include("include/Class/Inventory.php");
	if(class_exists('Inventory')){ $Inventory = new Inventory; }
}

if(is_file("include/Class/MarktplaatsManager.php")){
	include("include/Class/MarktplaatsManager.php");
	if(class_exists('MarktplaatsManager')){ $MarktplaatsManager = new MarktplaatsManager; }
}

if(is_file("include/Class/PointOfSale.php")){
	include("include/Class/PointOfSale.php");
	if(class_exists('PointOfSale')){ $PointOfSale = new PointOfSale; }
}

if(is_file("include/Class/crm.php")){
	include("include/Class/crm.php");
	if(class_exists('crm')){ $class_CRM = new crm; }
}




if(is_file("page/inc/suite_functions.php")){
	sh_debug(array("Msg"=>"Load SHcms Suite Function File","File"=>__FILE__,"Line"=>__LINE__));
	include("page/inc/suite_functions.php");
}
if(is_file("page/inc/project_functions.php")){
	sh_debug(array("Msg"=>"Load SHcms Project Function File","File"=>__FILE__,"Line"=>__LINE__));
	include("page/inc/project_functions.php");
}



if(is_file("page/inc/web_inc.php")){ require_once('page/inc/web_inc.php'); }



if(isset($_POST['Script'])){
	if(is_file("include/Script/".$_POST['Script'].".php")){ include("include/Script/".$_POST['Script'].".php"); }
}
if(isset($_GET['Script'])){
	if(is_file("include/Script/".$_GET['Script'].".php")){ include("include/Script/".$_GET['Script'].".php"); }
}


// Template Loding 
/* Disable on 2015-11-10 */
if(config("CMS/Template")){
	
	
	if(is_file("Template/".config("CMS/Template")."/Start.php")){
		include_once("Template/".config("CMS/Template")."/Start.php");
	} else {
		// Old version befor 2021 // used ont one place KDV-kinderverblijf //i think i have already removed 
		if(is_file("Template/".config("CMS/Template")."/Class.php")){
			include("Template/".config("CMS/Template")."/Class.php");
			$Template = new Template();
			
		}
	}
}
	

if(is_file("page/inc/tpl_function.php")){ require_once('page/inc/tpl_function.php'); }


if(function_exists("\P\Account\decrypt_loginKey")){
	\P\Account\decrypt_loginKey();
}

$Page=is_Page();

// Page Virable Found
if(isset($Page)){ 
	// Check if there is File Found & Include
	
	if(is_file("page/".$Page)){ 
		sh_debug(array("Msg"=>"Load Page [ $Page ]","File"=>__FILE__,"Line"=>__LINE__));
		if(is_file("include/config/page/".$Page)){ include("include/config/page/".$Page); }
		include("page/".$Page);
	} else { 
		header("HTTP/1.1 404 Not Found");
		if(is_file("page/ErrorPages/404.php")){ include("page/ErrorPages/404.php"); } else {
			include("include/Pages/ErrorPages/404.php");
		//print_r(explode('/', $_GET["MyURL"], 1));
		}
	}

}

if($debug_file=="Y"){ fclose($myfile);  } 

$_SESSION["FormToken"]=md5($sh_VisiterToken);
?>