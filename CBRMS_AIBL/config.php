<?
session_cache_limiter('nocache');
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once __DIR__ . '/local_compat.php';
$set_user=true; 
if (empty($_SESSION['user_id'])){
	$set_user=false;	
}
ini_set("memory_limit", "56M");
 
//ini_set("memory_limit", "66M");

date_default_timezone_set('Asia/Dhaka');
//DATABASE INFORMATION

define('aibl_DB_HOST',getenv('CBRMS_DB_HOST') ?: '127.0.0.1:3307');
define('aibl_DB_USER',getenv('CBRMS_DB_USER') ?: 'root');       // edit here
define('aibl_DB_PASS',getenv('CBRMS_DB_PASSWORD') ?: '');           // edit here
define('aibl_DB_BASE',getenv('CBRMS_DB_NAME') ?: 'cbrms_aibl');  // edit here
define('aibl_DB_PREFIX','aibl');

define('BANK_TITLE','aibl Cheque Requisition');


//DATABASE ACCESS
mysql_connect(aibl_DB_HOST,aibl_DB_USER,aibl_DB_PASS);
@mysql_select_db(aibl_DB_BASE) or die ("<b><center>Unable to access database. Please notify administrator.<br><br>Software by http://www.networld-bd.com</center></b>");

?>
