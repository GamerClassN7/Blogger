<div class='usermenu'>
	<a href='/index.php'>Příspěvky</a>
	<?php if (databas::setting('about')==='checked'):?>
		<a href="<?php echo pathFile('page_about.php'); ?>">O mně</a>
	<?php endif; ?>
	<?php if (databas::setting('contact')==='checked'):?>
		<a href="<?php echo pathFile('page_contact.php'); ?>">Kontakt</a>
	<?php endif; ?>
</div>
<div class='clear'></div>
