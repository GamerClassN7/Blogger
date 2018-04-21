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
		<h1>Nastavení blogu</h1>
		<?php
		if ($user->isLogged()){
			if (isset($_POST['submit'])) {
				if (POST_TEST('titulek')) databas::setting('titulek', $_POST['titulek']);
				if (POST_TEST('title')) databas::setting('title', $_POST['title']);
				if (POST_TEST('desc')) databas::setting('titudesclek', $_POST['desc']);
				if (POST_TEST('aut_title')) databas::setting('aut_title', $_POST['aut_title']);
				if (POST_TEST('aut_text')) databas::setting('aut_text', $_POST['aut_text']);
				if (POST_TEST('email')) databas::setting('email', $_POST['email']);

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

				if (isset($_FILES['fileToUpload'])){
					imageupload($_FILES['fileToUpload'], 'favicon.ico');
				}
				if (isset($_FILES['fileToUpload2'])){
					imageupload($_FILES['fileToUpload2'], 'background.png');
				}
				if (isset($_FILES['fileToUpload3'])){
					imageupload($_FILES['fileToUpload3'], 'logo.png');
				}
				if (isset($_FILES['fileToUpload4'])){
					imageupload($_FILES['fileToUpload4'], 'avatar.png');
				}
				echo '<div class="alert zeleny">Nastavení bylo uloženo.</div>';
			}

		}?>

		<form action='' method='post' enctype="multipart/form-data">
				<label>Titulek webové stránky</label>
				<input type='text' name='titulek' value='<?php echo databas::setting('titulek'); ?>'>

				<label>Nadpis webové stránky</label>
				<input type='text' name='title' value='<?php echo databas::setting('title'); ?>'>

				<label><h2>Popis webové stránky</h2></label>
				<input type='text' name='desc' value='<?php echo databas::setting('desc'); ?>'>

				<label>Povolit stránku o Autorovi: </label>
				<input type="checkbox" name="about" value="checked" <?php echo databas::setting('about'); ?>/>

				<h2>Avatar</h2>
				<input type="file" name="fileToUpload4" id="fileToUpload4">

				<label><h2>Nadpis autora webové stránky</h2></label>
				<input type='text' name='aut_title' value='<?php echo databas::setting('aut_title'); ?>'>

				<label><h2>Popis o autorovi</h2></label>
				<textarea name='aut_text' cols='60' rows='10'><?php echo databas::setting('aut_text'); ?></textarea>

				<label><h2>Povolit kontaktní formulář: </h2></label>
				<input type="checkbox" name="contact" value="checked" <?php echo databas::setting('contact'); ?>/>

				<label><h2>e-mailová adresa</h2></label>
				<input type='text' name='email' value='<?php echo databas::setting('email'); ?>'>

				<h2>Favicon</h2>
				<input type="file" name="fileToUpload" id="fileToUpload">
				<h2>Pozadi</h2>
				<input type="file" name="fileToUpload2" id="fileToUpload2">
				<h2>Logo</h2>
				<input type="file" name="fileToUpload3" id="fileToUpload3">
				<input type='submit' name='submit' value='Uložit nastavení'>
		</form>
		<div class="clear"></div>
	</div>
</div>

<?php include('../part_footer.php'); ?>
