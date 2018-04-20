<?php
  ob_start();
  session_start();
  define('DBHOST','sql2.webzdarma.cz');
  define('DBUSER','bloggerwzcz5168');
  define('DBPASS','WcVpZGr');
  define('DBNAME','bloggerwzcz5168');
    
  $db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  include($_SERVER['DOCUMENT_ROOT'] . '/admin/function.php');  
  date_default_timezone_set('Europe/London');
  $user = new User($db);
?>