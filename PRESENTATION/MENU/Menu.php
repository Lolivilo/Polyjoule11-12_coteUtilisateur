<?php

	function getMenu($CategorieBD,$classParent,$classChildren)
	{
		$html = "";
		$ParentsCategories = $CategorieBD->getSousCategories(NULL);// tableau d'objets categorie


		foreach ($ParentsCategories as $CatParent)// parcours des cat�gories parentes
		{
        	$HasChildren = FALSE;
            $idCatParent = $CatParent->getId();
            $html.= "<li><a href='".$CatParent->getUrl()."'>".$CatParent->getTitre()."</a>";
            $ChildrenCategories = $CategorieBD->getSousCategories($idCatParent);// tableau d'objets categorie
            
            if($CatParent->getIdTemplate() == 2)	// Si c'est la rubrique d'albums, on affiche tous les albums en tant que sous rubrique
            {
            	$HasChildren = TRUE;
            	$html .= "<ul>";
            	try
            	{
            		$tabAlb = getAllAlbums();
            	}
            	catch(RequestException $e)
            	{
            		echo( $e->getMessage() );
            	}
            	foreach($tabAlb as $alb)
            	{
            		$html .= "<li><a href='".$alb->getUrl()."'>".$alb->getNom()."</a></li>";
            	}
            }
            
            else if($CatParent->getIdTemplate() == 6)	// Si c'est les partenaires, on les affiche en tant que sous rubriques
            {
            	$HasChildren = TRUE;
            	$html .= "<ul>";
            	try
            	{
            		$tabPart = getTousPartners();
            	}
            	catch(RequestException $e)
            	{
            		echo( $e->getMessage() );
            	}
            	foreach($tabPart as $part)
            	{
            		$html .= "<li><a href='".$part->getUrl()."'>".$part->getNom()."</a></li>";
            	}
            }
            
            else if($ChildrenCategories != NULL)// Si la cat�gorie parente a des enfants
            {
                $HasChildren = TRUE;
                $html.= "<ul>";
            }
            
            
            foreach ($ChildrenCategories as $SousCat)// parcours des catgories de second niveau
            {
            	$html.= "<li><a href='".$SousCat->getUrl()."'>".$SousCat->getTitre()."</a></li>"; 
            }
            if($HasChildren)
            {
                $html.= "</ul>";
            }
            $html.= "</li>";
        }
        return $html;
    }

	
	


?>
