<?php
include_once '../BD/CategorieBD.php';
include_once 'MENU/Menu.php';

	$categoryBD = new CategorieBD('localhost', 'polyjoule', 'polyjoule', 'azerty');

	echo getMenu($categoryBD,'parent','child');
		




?>