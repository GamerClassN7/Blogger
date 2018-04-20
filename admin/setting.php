<?php include('../part_header.php');
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
<div class="container">
	<div class="admin-set">
		<h2>Main page setting</h2>
		<?php
		if ($user->isLogged()){
			if (POST_TEST('titulek')) databas::setting('titulek', $_POST['titulek']);


			if(isset($_POST['title'])){
				if(isset($_POST['contact']) && $_POST['contact'] == "checked"){
					databas::setting('contact', 'checked');
				} else {
					databas::setting('contact', '');
				}
				if(isset($_POST['about']) && $_POST['about'] == "checked"){
					databas::setting('about', 'checked');
				} else {
					databas::setting('about', '');
				}
				databas::setting('title', $_POST['title']);
				databas::setting('desc', $_POST['desc']);
				databas::setting('aut_title', $_POST['aut_title']);
				databas::setting('aut_text', $_POST['aut_text']);
				databas::setting('email', $_POST['email']);
				imageupload($_FILES['fileToUpload'], 'favicon.ico');
				imageupload($_FILES['fileToUpload2'], 'background.png');
				imageupload($_FILES['fileToUpload3'], 'logo.png');
			}
		}?>

		<form action='' method='post' enctype="multipart/form-data">
			<p>
				<label>titulek: </label><br />
				<input type='text' name='titulek' value='<?php echo databas::setting('titulek'); ?>'>
			</p>
			<p>
				<label>Nadpis: </label><br />
				<input type='text' name='title' value='<?php echo databas::setting('title'); ?>'>
			</p>
			<p>
				<label>Popis: </label><br />
				<textarea name='desc' cols='60' rows='10'><?php echo databas::setting('desc'); ?></textarea>
			</p>
			<p>
				<label>Nadpis Autora: </label><br />
				<input type='text' name='aut_title' value='<?php echo databas::setting('aut_title'); ?>'>
			</p>
			<p>
				<label>O autorovi: </label><br />
				<input type="checkbox" name="about" value="checked" <?php echo databas::setting('about'); ?>/>
			</p>
			<p>
				<label>Text O autora: </label><br />
				<textarea name='aut_text' cols='60' rows='10'><?php echo databas::setting('aut_text'); ?></textarea>
			</p>
			<p>
				<label>E-mail: </label><br />
				<input type='text' name='email' value='<?php echo databas::setting('email'); ?>'>
			</p>
			<p>
				<label>Email pro kontaktní formulář: </label><br />
				<input type="checkbox" name="contact" value="checked" <?php echo databas::setting('contact'); ?>/>
			</p>
			<p>Favikona: <br />
				<input type="file" name="fileToUpload" id="fileToUpload">
			</p>
			<p>Pozadi<br />
				<input type="file" name="fileToUpload2" id="fileToUpload2">
			</p>
			<p>Logo<br />
				<input type="file" name="fileToUpload3" id="fileToUpload3">
			</p>
			<input type='submit' name='submit' value='Uložit'>
		</form>
	</div>
</div>

<?php include('../part_footer.php'); ?>
