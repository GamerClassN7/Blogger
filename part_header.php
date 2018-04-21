<?php include($_SERVER['DOCUMENT_ROOT'] . '/config.php');?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo databas::setting('titulek') ?></title>
    <meta charset="UTF-8">
      <link rel="shortcut icon" type="image/png" href="<?php echo pathFile('image/favicon.ico'); ?>"/>
      <link rel="stylesheet" href="<?php echo pathFile('style/normalize.css'); ?>">
      <link rel="stylesheet" href="<?php echo pathFile('style/normal-style.css'); ?>">
      <link rel="stylesheet" href="<?php echo pathFile('style/mobile-style.css'); ?>">
      <script src="<?php echo pathFile('js/js.js'); ?>"></script>
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <header>
      <div class="logo">
				<a href="/index.php">
					<img src="<?php echo pathFile('image/logo.png'); ?>">
				</a>
			</div>
        <div class="logo-text">
          <h1><?php echo databas::setting('title'); ?></h1>
          <?php echo databas::setting('desc'); ?>
        </div>
				<div class="menu">
				<?php include($_SERVER["DOCUMENT_ROOT"].'/menu.php'); ?>
        <?php if($user->isLogged()){ ?>
          <?php include(pathFile('admin/menu.php')); ?>
        <?php } ?>
			</div>
    </header>
    <article>
