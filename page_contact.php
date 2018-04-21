<?php include('part_header.php');

if (isset($_POST['name']) && $_POST['name'] != "") {
	if (mailer($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])){
		$message = "Ůspěšně odeláno :)";
	}
}?>

<div class="contact container">
  <h1>Kontakt</h1>
  <form action="" class="contact_form" method="POST" accept-charset="UTF-8">
    <input type="text" placeholder="Jméno a příjmení" id="name" name="name">
    <input type="email" placeholder="Emailová adresa" id="email" name="email" required>
    <input type="text" placeholder="Předmět zprávy" id="subject" name="subject" required>
    <textarea type="text" placeholder="Obsah zprávy" id="message" name="message" required></textarea>
    <input class="submit" type="submit" value="Odeslat zprávu" id="submit" name="submit">
  </form>
	<div class="clear"></div>
</div>
<?php if (isset($message)) echo $message; ?>

<?php include('part_footer.php'); ?>
