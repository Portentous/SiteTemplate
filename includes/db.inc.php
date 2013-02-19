<?
if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'){ // a local server
	$host = "localhost";
	$db = "";
	$user = "root";
	$pass = "";
}else{
	$host = ""; // Host IP
	$db = "";   // Database Name
	$user = ""; // Database User
	$pass = ""; // Database Password
}
try {
	$pdo = new PDO("mysql:host={$host};dbname={$db}",$user,$pass);
} catch (PDOException $e){
	die("There was a problem connecting to the database.");
}
// Website Constants and configurations
if(session_id() == '') session_start();

$config = array();
$configurations = $pdo->query("SELECT name,value FROM config");
while(list($name,$value) = $configurations->fetch()){
	$config[$name] = $value;
}
define("SITE_EMAIL",$config['siteemail']);
define("SITE_NAME",$config['sitename']);
define("SITE_URL",$config['siteurl']);
define("SCRIPT_PATH",$config['scriptpath']);
?>