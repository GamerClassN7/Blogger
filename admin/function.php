<?php
class Password {
  public function __construct(){}
  public function password_verify($password, $hashedPass) {
         if(is_string($hashedPass) && $password == $hashedPass){
           return true;
         }
         return false;
  }
}

class User extends Password{
    public function __construct($db){
       parent::__construct();
       $this->_db = $db;
       $GLOBALS['db'] = $db;
    }
    public function isLogged(){
       if(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true){
          return true;
       }
       return false;
    }
    public function get_Hashed_Password($username){
      try {
			 $sql = $this->_db->prepare('SELECT password FROM blog_members WHERE username = :username');
			 $sql->execute(array(':username' => $username));
			 $row = $sql->fetch();
			 return $row['password'];
		  } catch(PDOException $e) {
		    echo '<p class="error">Nepodařilo se spojit s databází.</p>';
		  }
    }
    public function login($username, $password) {
       $hashesPass = $this->get_Hashed_Password($username);
       if($this->password_verify($password, $hashesPass)){
         $_SESSION['isLogged']  = true;
         return true;
       }
    }
    public function logout(){
       session_destroy();
    }
}
class databas{
  public function setting($name, $value = '0'){
    $result = $GLOBALS['db']->query("SELECT * FROM blog_setting WHERE name = '$name';");
    $row = $result->fetch();
    if ($value != '0'){
      if (count($row['name']) == 1) {
         try {
          $GLOBALS['db']->query("UPDATE blog_setting SET value = '$value' WHERE name = '$name';");
         } catch(PDOException $e) {
      		echo $e->getMessage();
        }
      } else {
        try {
          $GLOBALS['db']->query("INSERT INTO blog_setting (name, value) VALUES ('$name', '$value');");
        } catch(PDOException $e) {
      		echo $e->getMessage();
        }
        return $value;
      }

    } else {
      return $row['value'];
    }
  }
}

function mailer($from, $from_mail, $subject, $text){
	$headers = "From: $from <$from_email>\r\n".
						 "MIME-Version: 1.0" . "\r\n" .
						 "Content-type: text/html; charset=UTF-8" . "\r\n";
	mail(databas::setting('email'), $subject, $text, $headers);
}

function POST_TEST($name){
	if (isset($_POST[$name]) && $_POST[$name] != "") :
     return true ;
     else :
      return false;
    endif;
}
function pathFile($path){
    if(file_exists($path)){
      return $path;
    }else{
      if(substr($path, 0, 1) == "/" || substr($path, 1, 1) == "/"){
        $sav = true;
      }else{
        $sav = false;
      }
      for($i = 0; $i< 5; $i++){
          if($sav){
            $path = '.' . $path;
          } else {
            $path = './' . $path;
            $sav = true;
          }
          if(file_exists($path)){
            return $path;
            $i = 5;
          }
      }
    }
}

function datum($date){
  $aj = array("January","February","March","April","May","June","July","August","September","October","November","December");
  $cz = array("ledna","února","března","dubna","května","června","července","srpna","září","října","listopadu","prosince");
  $datum = str_replace($aj, $cz, $date);
  return $datum;
}

function blogposts(){
  try{
    $stmt = $GLOBALS['db']->query("SELECT * FROM blog_post ORDER BY id DESC");
      while($row = $stmt->fetch()){
        echo '<div class="post-container">';
          echo '<h1><a href="single.php?id='.$row['id'].'">'.$row['title'].'</a></h1>';
          echo '<div class="datum">'.datum(date('j. F Y', strtotime($row['date']))).'</div>';
          echo $row['short'];
          echo '<a href="single.php?id='.$row['id'].'" class="vice">Přečíst více</a>';
        echo '</div>';
        if (count($row)<1){
          echo 'Nic tu není';
        }
      }
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
}

function imageupload($file, $name){
 $valid_file = true;
 if($file['name'])
  {
  	if(!$file['error'])
  	{
  		if($file['size'] > (1024000)) // 1MB limit
  		{
  			$valid_file = false;
  			$message = 'Oops!  Your file\'s size is to large.';
  		}
  		if($valid_file)
  		{
  			move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']. '/image/'. $name);
  			$message = 'šoupnuli jsme to na server';
  		}
  	}
  	else
  	{
  		$message = 'Ooops!  nešoupnuli jsme to na server protože:  '.$file['error'];
  	}
  }
}
?>
