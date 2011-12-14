<?php
	session_start();
	if(!isset($_SESSION['langue']))
		$_SESSION['langue']='FR';
	
	if(isset($_GET['lang']))
	{
		if($_GET['lang'] == 'FR' || $_GET['lang'] == 'EN')
		{
			$_SESSION['langue'] = $_GET['lang'];	
		}
	}
		
?>	 