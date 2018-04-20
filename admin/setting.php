<?php
include('../part_header.php');

if(!$user->isLogged()) header('Location: login.php');
?>
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
 if(isset($_POST['title'])){ 
    databas::setting('title', $_POST['title']);
    databas::setting('desc', $_POST['desc']);
    databas::setting('aut_title', $_POST['aut_title']);
    databas::setting('aut_text', $_POST['aut_text']);
    databas::setting('email', $_POST['email']);
    if($_POST['about'] == "on"){   
      databas::setting('about', 'checked');
    } else {
      databas::setting('about', '');
    }
     if($_POST['contact'] == "on"){   
      databas::setting('contact', 'checked');
    } else {
      databas::setting('contact', '');
    }
    imageupload($_FILES['fileToUpload'], 'img');
    imageupload($_FILES['fileToUpload2'], 'background');
    imageupload($_FILES['fileToUpload3'], 'logo');
  } 
	?>

	<form action='' method='post' enctype="multipart/form-data">
		<p><label>Title</label><br />
		<input type='text' name='title' value='<?php echo databas::setting('title'); ?>'></p>

		<p><label>Description</label><br />
		<textarea name='desc' cols='60' rows='10'><?php echo databas::setting('desc'); ?></textarea></p>

		<p><label>Autor Title</label><br />
		<input type='text' name='aut_title' value='<?php echo databas::setting('aut_title'); ?>'></p>

		<p><label>Autor Text</label><br />
		<textarea name='aut_text' cols='60' rows='10'><?php echo databas::setting('aut_text'); ?></textarea></p>

    <p><label>E-mail</label><br />
		<input type='text' name='email' value='<?php echo databas::setting('email'); ?>'></p>
    
    <p><label>About author</label><br />
    <input type="checkbox" name="about" <?php echo databas::setting('about'); ?>/></p>
    
    <p><label>Contact form</label><br />
    <input type="checkbox" name="contact" <?php echo databas::setting('contact'); ?>/></p>
    
    <p>header<br />
    <input type="file" name="fileToUpload" id="fileToUpload"></p>

    <p>Pozadi<br />
    <input type="file" name="fileToUpload2" id="fileToUpload2"></p>
    
    <p>logo<br />
    <input type="file" name="fileToUpload3" id="fileToUpload3"></p>
  
		<p><input type='submit' name='submit' value='submit'></p>

	</form>
</div>
</div>

<?php 
include('../part_footer.php'); ?>