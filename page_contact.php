<?php include('part_header.php');

if (isset($_POST['name']) && $_POST['name'] != "") {
	if (mailer($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])){
		$message = "Ůspěšně odeláno :)";
	}
}?>

<div class="contact container">
  <h1>Kontakt</h1>
  <form action="" class="contact_form" method="POST" accept-charset="UTF-8">
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 060c6c233b69c3275e8987c8a9fbf0dbf6b3962a
    <input type="text" placeholder="Jméno a příjmení" id="name" name="name">
    <input type="email" placeholder="Emailová adresa" id="email" name="email" required>
    <input type="text" placeholder="Předmět zprávy" id="subject" name="subject" required>
    <textarea type="text" placeholder="Obsah zprávy" id="message" name="message" required></textarea>
    <input class="submit" type="submit" value="Odeslat zprávu" id="submit" name="submit">
  </form>
	<div class="clear"></div>
<<<<<<< HEAD
=======
=======
    <input type="text" placeholder="Jméno" id="name" name="name"><br>
    <input type="email" placeholder="" id="email" name="email" required><br>
    <input type="text" placeholder="Předmět..." id="subject" name="subject" required><br>
    <textarea type="text" placeholder="Zpráva..." id="message" name="message" required></textarea><br>
    <input class="submit" type="submit" text="Odeslat" id="submit" name="submit">
  </form>
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
>>>>>>> 060c6c233b69c3275e8987c8a9fbf0dbf6b3962a
</div>
<?php if (isset($message)) echo $message; ?>

<?php include('part_footer.php'); ?>