<?php
	// Par d�faut, la langue est fix�e en "FR"
	if(!isset($_SESSION['langue']))
	{
		$_SESSION['langue'] = 'FR';
	}
	
	// Si un choix est fait (envoi de l'information via un GET), on r�cup�re le langue s�lectionn�e
	if(isset($_GET['lang']))
	{
		if($_GET['lang'] == 'FR' || $_GET['lang'] == 'EN')
		{
			$_SESSION['langue'] = $_GET['lang'];	
		}
	}
?>	 