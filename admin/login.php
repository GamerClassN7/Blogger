<<<<<<< HEAD

<?php include('../part_header.php');?>
<div class="container">

<?php	if($user->isLogged()) header('Location: index.php');
=======
<?php include('../part_header.php');
	if($user->isLogged()) header('Location: index.php');
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		if($user->login($username, $password)){
			header('Location: index.php');
			exit;
		} else {
			$message = '<p class="error">Špatné uživatelské jméno nebo heslo</p>';
		}
	}
	if(isset($message)) echo $message;?>
	<form action="" method="post">
<<<<<<< HEAD
		<label>Uživatelské jméno: </label><input type="text" name="username" value=""/>
		<label>Heslo: </label><input type="password" name="password" value=""/>
		<input type="submit" name="submit" value="Přihlásit se"/>
		<div class="clear"></div>
	</form>
</div>
=======
		<label>Uživatelské Jméno: </label><input type="text" name="username" value=""/>
		<label>Heslo: </label><input type="password" name="password" value=""/>
		<input type="submit" name="submit" value="Přihlásit"/>
	</form>
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
<?php include('../part_footer.php'); ?>
