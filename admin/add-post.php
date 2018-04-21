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
		<h1>Přidat příspěvek</h1>
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
						':date' => date('j. F Y')
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
			<label>Název článku</label>
			<input type='text' name='title' value='<?php if(isset($error)){ echo $_POST['title'];}?>'></p>

			<label>Krátký popisek článku</label>
			<textarea name='short' cols='60' rows='2'><?php if(isset($error)){ echo $_POST['short'];}?></textarea>

			<label><h2>Obsah článku</h2></label>
			<textarea name='body' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['body'];}?></textarea>

			<input type='submit' name='submit' value='Publikovat příspěvek'>
		</form>
		<div class="clear"></div>
	</div>
<?php include('../part_footer.php'); ?>
