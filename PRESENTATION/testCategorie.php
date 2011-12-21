<?php
include_once '../BD/CategorieBD.php';
include_once 'MENU/Menu.php';

	$categoryBD = new CategorieBD();

	//echo getMenu($categoryBD,'parent','child');
	foreach ($categoryBD->getFilArianneWithCategorie(17) as $arianne)
	{
		print_r($arianne);
		echo "</br></br></br></br>";
		
	}



?>