<?php

	function getMenu($CategorieBD,$classParent,$classChildren)
	{
		$html = "";
		$ParentsCategories = $CategorieBD->getSousCategories(NULL);// tableau d'objets categorie
		foreach ($ParentsCategories as $CatParent)// parcours des catégories parentes
		{
        	$HasChildren = FALSE;
            $idCatParent = $CatParent->getId();
            $html.= "<li><a href='".$CatParent->getUrl()."'>".$CatParent->getTitre()."</a>";
            $ChildrenCategories = $CategorieBD->getSousCategories($idCatParent);// tableau d'objets categorie
            
            if($CatParent->getIdTemplate() == 2)
            {
            	$HasChildren = TRUE;
            	$html .= "<ul>";
            	$tabAlb = getAllAlbums();
            	foreach($tabAlb as $alb)
            	{
            		$html .= "<li><a href='".$alb->getUrl()."'>".$alb->getNom()."</a></li>";
            	}
            }
            
            else if($ChildrenCategories != NULL)// Si la catégorie parente a des enfants
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
