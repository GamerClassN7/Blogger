<?php include('../part_header.php');
	if($user->isLogged()) : header('Location: index.php');
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		if($user->login($username, $password)){
			header('Location: index.php');
			exit;
		} else {
			$message = '<p class="error">Wrong username or password</p>';
		}
	}
	if(isset($message)) { echo $message; }?>
<form action="" method="post">
  <label>Uživatelské Jméno: </label><input type="text" name="username" value=""/>
  <label>Heslo: </label><input type="password" name="password" value=""/><
  <input type="submit" name="submit" value="Přihlásit"/><
</form>
<?php include('../part_footer.php'); ?>
