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
		<h1>Upravit příspěvek</h1>
		<?php $_POST = array_map( 'stripslashes', $_POST );
		extract($_POST);
		if(isset($_POST['submit'])){
			try {
				//Odešli QUERY a přejdi na index
				$stmt = $db->prepare('UPDATE blog_post SET `title` = :title, `body` = :body, `short` = :short WHERE id = :id') ;
				$stmt->execute(array(
					':title' => $_POST['title'],
					':body' => $_POST['body'],
					':short' => $_POST['short'],
					':id' => $_POST['id']
				));
				header('Location: index.php?action=updated');
			} catch(PDOException $e){
				echo $e->getMessage();
			}
		}
			//Odeslání příspěvku
			if(isset($_GET['id'])){
				try {
					$aql = $db->prepare('SELECT id, title, body, short FROM blog_post WHERE id = :id');
					$aql->execute(array(':id' => $_GET['id']));
					$row = $aql->fetch();
				} catch(PDOException $e) {
					echo 'Nelze zapsat do databáze!';
				}
			}
			$id = $row['id'];
			$title = $row['title'];
			$short = $row['short'];
			$body = $row['body'];
			?>
			<form action='' method='post'>
				<input type='hidden' name='id' value='<?php echo $id; ?>'>
				<label>Nadpis</label>
				<input type='text' name='title' value='<?php echo $title; ?>'>

				<label>Krátký popisek příspěvku</label>
				<textarea name='short' cols='60' rows='10'><?php echo $short; ?></textarea>

				<label><h2>Obsah příspěvku</h2></label>
				<textarea name='body' cols='60' rows='10'><?php echo $body; ?></textarea>

				<input type='submit' name='submit' value='Aktualizovat článek'>
				</form>
				<div class="clear"></div>
			</div>
<?php include('../part_footer.php'); ?>
