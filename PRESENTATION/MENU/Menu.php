<?php
	function getMenu($CategorieBD,$classParent,$classChildren)
	{
		$html = "";
		$ParentsCategories = $CategorieBD->getSousCategories(NULL);// tableau d'objets categorie
		foreach ($ParentsCategories as $CatParent)// parcours des catégories parentes
		{
			$HasChildren = FALSE;
			$idCatParent = $CatParent->getId();
			$html.= "<li class='".$classParent."'>".$CatParent->getTitreFR();
			$ChildrenCategories = $CategorieBD->getSousCategories($idCatParent);// tableau d'objets categorie
			if($ChildrenCategories != NULL)// Si la catégorie parente a des enfants
			{
				$HasChildren = TRUE;
				$html.= "<ul class='".$classChildren."'>";
			}
			foreach ($ChildrenCategories as $SousCat)// parcours des catgories de second niveau
			{
				$html.= "<li class='".$classChildren."'>".$SousCat->getTitreFR()."</li>";
				
			}
			if($HasChildren){
				$html.= "</ul>";
			}
			$html.= "</li>";
		}

		return $html;
	}   


?>
