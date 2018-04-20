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
		<?php include('./menu.php'); ?>
		<p><a href="./">Blog Admin Index</a></p>
		<h2>Edit Post</h2>
		<?php
			//Odeslání příspěvku
			if(isset($_GET['id'])){
				try {
					$aql = $db->prepare('SELECT id, title, body, date FROM blog_post WHERE id = :id');
					$aql->execute(array(':id' => $_GET['id']));
					$row = $aql->fetch();
				} catch(PDOException $e) {
					echo 'Nelze zapsat do databáze!';
				}
			}
			//Kontrola zda byly problémy s odeláním ? pokud ano vypiš je
			if(isset($error)){
				foreach($error as $error){
					echo $e->getMessage();
				}
			}
			if(isset($_POST['submit'])){
				$_POST = array_map( 'stripslashes', $_POST );
				//Kontrola korespondujících hodnot
				extract($_POST);
				$id = $_POST['id'];
				$title = $_POST['title'];
				$desc = $_POST['desc'];
				$body = $_POST['body'];
				//Kontrola korespondujících hodnot
				if($id =='') : $id = $row['id'];
				if($title =='') : $title = $row['title'];
				if($desc =='') :	$desc = $row['desc'];
				if($body =='') : $body = $row['body'];
				if(!isset($error)){
					try {
						//Odešli QUERY a přejdi na index
						$stmt = $db->prepare('UPDATE blog_post SET `title` = :title, `body` = :body, `desc` = :desc WHERE id = :id') ;
						$stmt->execute(array(
							':title' => $title,
							':body' => $body,
							':desc' => $desc,
							':id' => $id
						));
						header('Location: index.php?action=updated');
					} catch(PDOException $e): echo $e->getMessage();
				}
			} ?>
			<form action='' method='post'>
				<input type='hidden' name='id' value='<?php echo $row['id'];?>'>
				<p><label>Nadpis: </label><br />
					<input type='text' name='title' value='<?php if(isset($error)){ echo $_POST['title'];}?>'></p>
					<p>
						<label>Popisek: </label><br />
						<textarea name='desc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['desc'];}?></textarea>
					</p>
					<p>
						<label>Obsah: </label><br />
						<textarea name='body' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['body'];}?></textarea>
					</p>
					<input type='submit' name='submit' value='Update'>
				</form>
			</div>
<?php include('../part_footer.php'); ?>
