<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <title>MVC - PHP</title>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
        <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
    </head>
    <body class="wrapper">
        <header>
						<div class="session-bar">
            <?= $_SESSION['userlastname']." ".$_SESSION['userfirstname'] ?>
						</div>
						<div class="banner">
								<div id="banner-img">
								<img src="./img/banner_cr.png" alt="Banner">
								</div>
								<p>Szoftver leltár katalógus</p>
						</div>
        </header>
        <nav>
            <?php echo Menu::getMenu($viewData['selectedItems']); ?>
        </nav>
        <section>
            <?php if($viewData['render']) include($viewData['render']); ?>
        </section>
        <footer>&copy; Szoftver Leltár program <?= date("Y") ?></footer>
    </body>
</html>
