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
      if (count($row['name']) == '1') {
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

function blogposts(){
  try{
    $stmt = $GLOBALS['db']->query("SELECT * FROM blog_post ORDER BY id DESC");
      while($row = $stmt->fetch()){ 
        echo '<div class="post-container">';
          echo '<h1><a href="single.php?id='.$row['id'].'">'.$row['title'].'</a></h1>';
          echo '<p>Posted on '.date('d/m/y H:i:s', strtotime($row['date'])).'</p>';
          echo '<p>'.$row['desc'].'</p>';                
          echo '<p><a href="single.php?id='.$row['id'].'">Read More</a></p>';                
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
  	//if no errors...
  	if(!$file['error'])
  	{
  		//now is the time to modify the future file name and validate the file
  		if($file['size'] > (1024000)) //can't be larger than 1 MB
  		{
  			$valid_file = false;
  			$message = 'Oops!  Your file\'s size is to large.';
  		}
  		
  		//if the file has passed the test
  		if($valid_file)
  		{
  			//move it to where we want it to be
  			move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']. '/image/'. $name . '.png');
  			$message = 'Congratulations!  Your file was accepted.';
  		}
  	}
  	//if there is an error...
  	else
  	{
  		//set that to be the returned message
  		$message = 'Ooops!  Your upload triggered the following error:  '.$file['error'];
  	}
  }
}
?>