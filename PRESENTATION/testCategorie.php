<?php
include_once '../BD/CategorieBD.php';
include_once 'MENU/Menu.php';

	$categoryBD = new CategorieBD();

	echo getMenu($categoryBD,'parent','child');
		




?>