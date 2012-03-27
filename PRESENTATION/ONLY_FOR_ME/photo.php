<?php
	$myTab = array();
	$path = "/Users/antoninbiret/PROJETS_POLYTECH/Polyjoule11-12_coteUtilisateur/PRESENTATION/ONLY_FOR_ME/PHOTOS";
	$imagePath = "http://localhost/PRESENTATION/ONLY_FOR_ME/PHOTOS";
	$d = dir($path);
	$cpt = 0;
	while ($entry = $d->read())
	{
		$arrayImage = array();
		if($entry != "." && $entry != ".." && $entry != ".DS_Store")
		{
			$filePath = $imagePath .'/'.$entry;
			$arrayImage['idPhoto'] = $cpt."";
			$arrayImage['urlPhoto'] = $filePath;
			array_push($myTab, $arrayImage);
			$cpt = $cpt+1;
		}
		
	}
	$d->close();

	$myTab = array('photos' => $myTab);
	echo json_encode($myTab);
	
	
?>