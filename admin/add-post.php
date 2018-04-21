<?php
include('../part_header.php');
if(!$user->isLogged()) header('Location: login.php'); ?>
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector: "textarea",
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		});
	</script>
	<div class="admin-posts container">
<<<<<<< HEAD
		<h1>Přidat příspěvek</h1>
=======
		<h2>Přidat příspěvek:</h2>
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
		<?php
		//Odeslání příspěvku
		if(isset($_POST['submit'])){
			$_POST = array_map( 'stripslashes', $_POST );
			extract($_POST);
			//Kontrola vyplnění formulářů
			if($title =='')  {$error[] = 'Vložte titulek!';}
			if($short =='')  {$error[] = 'Vložte Popisek';}
			if($body =='')  {$error[] = 'Vložte obsah !';}
			if(!isset($error)){
				try {
					//Odešli QUERY a přejdi na index
				  $sql = $db->prepare('INSERT INTO blog_post (`title`, `body`, `short`, `date`) VALUES (:title, :body, :short, :date)') ;
					$sql->execute(array(
						':title' => $title,
						':body' => $body,
						':short' => $short,
<<<<<<< HEAD
						':date' => date('j. F Y')
=======
						':date' => date('d/m/y H:i:s')
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
					));
					header('Location: index.php?action=added');
					exit;
				} catch(PDOException $e)  {echo $e->getMessage();}
			}
		}
		//Kontrola zda byly problémy s odeláním ? pokud ano vypiš je
		if(isset($error)){
			foreach($error as $error){
				echo '<p class="error">'.$error.'</p>';
			}
		} ?>
		<form action='' method='post'>
<<<<<<< HEAD
			<label>Název článku</label>
			<input type='text' name='title' value='<?php if(isset($error)){ echo $_POST['title'];}?>'></p>

			<label>Krátký popisek článku</label>
			<textarea name='short' cols='60' rows='2'><?php if(isset($error)){ echo $_POST['short'];}?></textarea>

			<label><h2>Obsah článku</h2></label>
			<textarea name='body' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['body'];}?></textarea>

=======
			<p><label>Název článku</label><br />
			<input type='text' name='title' value='<?php if(isset($error)){ echo $_POST['title'];}?>'></p>
			<p>
				<label>Krátký popisek článku</label><br />
				<textarea name='short' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['short'];}?></textarea>
			</p>
			<p>
				<label>Obsah článku</label><br />
				<textarea name='body' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['body'];}?></textarea>
			</p>
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
			<input type='submit' name='submit' value='Publikovat příspěvek'>
		</form>
		<div class="clear"></div>
	</div>
<?php include('../part_footer.php'); ?>
