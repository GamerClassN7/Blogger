<?php include('part_header.php'); ?>

<div class="bloger container">
  <img src="<?php echo pathFile('image/avatar.png'); ?>" alt="Avatar" class="avatar">
  <h1><?php echo databas::setting('aut_title'); ?></h1>
  <p><?php echo databas::setting('aut_text'); ?></p>
</div>

<?php include('part_footer.php'); ?>
