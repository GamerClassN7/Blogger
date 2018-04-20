<?php
  include($_SERVER['DOCUMENT_ROOT'] . '/config.php');
  $user->logout();
  header('Location: login.php'); 
?>