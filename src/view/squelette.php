<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?php echo $this->title ?></title>
	<meta charset="UTF-8">
</head>
<body>
	<?php echo $this->feedback ?>
	<ul>
	<?php
	foreach ($this->menu as $text => $link) {
		echo "<li><a href=\"$link\">$text</a></li>";
	}
	?>
	</ul>
	<h1><?php echo $this->title ?></h1>
	<?php echo $this->content ?>
</body>
</html>
