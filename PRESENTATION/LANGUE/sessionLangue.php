<?php
	// Par dŽfaut, la langue est fixŽe en "FR"
	if(!isset($_SESSION['langue']))
	{
		$_SESSION['langue'] = 'FR';
	}
	
	// Si un choix est fait (envoi de l'information via un GET), on rŽcupre le langue sŽlectionnŽe
	if(isset($_POST['lang']))
	{
		if($_POST['lang'] == 'FR' || $_POST['lang'] == 'EN')
		{
			$_SESSION['langue'] = $_POST['lang'];	
		}
	}
?>	 