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
	<div class="admin-posts">
		<?php include('../admin/menu.php'); ?>
		<p><a href="./">Blog Admin Index</a></p>
		<h2>Přidat Příspěvek:</h2>
		<?php
		//Odeslání příspěvku
		if(isset($_POST['submit'])){
			$_POST = array_map( 'stripslashes', $_POST );
			extract($_POST);
			//Kontrola vyplnění formulářů
			if($title =='') : $error[] = 'Please enter the title.';
			if($desc =='') : $error[] = 'Please enter the description.';
			if($body =='') : $error[] = 'Please enter the content.';
			if(!isset($error)){
				try {
					//Odešli QUERY a přejdi na index
				  $sql = $db->prepare('INSERT INTO blog_post (`title`, `body`, `desc`, `date`) VALUES (:title, :body, :desc, :date)') ;
					$sql->execute(array(
						':title' => $title,
						':body' => $body,
						':desc' => $desc,
						':date' => date('d/m/y H:i:s')
					));
					header('Location: index.php?action=added');
					exit;
				} catch(PDOException $e) : echo $e->getMessage();
			}
		}
		//Kontrola zda byly problémy s odeláním ? pokud ano vypiš je
		if(isset($error)){
			foreach($error as $error){
				echo '<p class="error">'.$error.'</p>';
			}
		} ?>
		<form action='' method='post'>
			<p><label>Title</label><br />
			<input type='text' name='title' value='<?php if(isset($error)){ echo $_POST['title'];}?>'></p>
			<p>
				<label>Description</label><br />
				<textarea name='desc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['desc'];}?></textarea>
			</p>
			<p>
				<label>Content</label><br />
				<textarea name='body' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['body'];}?></textarea>
			</p>
			<input type='submit' name='submit' value='Submit'>
		</form>
	</div>
<?php include('../part_footer.php'); ?>
