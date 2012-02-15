<?php

$category = new CategorieBD();

$SuperParentcategoryID = NULL;
$SuperParentcategory = NULL;

$CategoryParenteID = 0;
$CategoryParente = NULL;

$SousCategories = NULL;

$html = NULL;
  
if(	(isset( $_GET['article'] ) ) )
{
	$CategoryParenteID = $category->getAsssociateCategoryIDForArticle($_GET['article']);	
}
elseif( isset( $_GET['cat'] ) )
{
	$CategoryParenteID = $_GET['cat'];
}
    
// On instancie la super cat使orie
$SuperParentcategory = $category->getCategorieWithId($SuperParentcategoryID);
// et la cat使orie parente de niveau sup屍ieur
$CategoryParente = $category->getCategorieWithId($CategoryParenteID);

//    print_r($CategoryParente);




//Recup屍ation des sous cat使ories de la cat使orie parente
$SousCategories = $category->getSousCategories($SuperParentcategoryID);

// DEBUT AFFICHAGE HTML

$html.="<ul id='menuPage'><li><h2>".$SuperParentcategory->getTitre()."</h2></li>";
foreach ($SousCategories as $_Categorie)
{
	$html.="<li";
	if($_Categorie->getID() == $CategoryParente->getID())
		$html.=" class='active'";
	$html.="><a href='".$_Categorie->getUrl()."'>".$_Categorie->getTitre()."</a>";
	$SousCategoriesN2 = NULL; // Cat使ories filles de la cat使orie du tour de boucle du foreach
	// Si la cat使orie en cours � des filles
	if($SousCategoriesN2 = $category->getSousCategories($_Categorie->getId()))
	{
		$html.="<ul>";
		foreach ($SousCategoriesN2 as $CategorieN2)
		{
			$html.="<li";
			if($CategorieN2->getID() == $CategoryParente->getID())
				$html.=" class='active'";
			$html.= "><a href='".$CategorieN2->getUrl()."'>".$CategorieN2->getTitre()."</a>";
            
            $SousCategoriesN3 = NULL; // Cat使ories filles de la cat使orie du tour de boucle du foreach
            // Si la cat使orie en cours � des filles (Niveau 3 _MAX)
            if($SousCategoriesN3 = $category->getSousCategories($CategorieN2->getId()))
            {
                $html.="<ul>";
                foreach ($SousCategoriesN3 as $CategorieN3)
                {
                    $html.="<li";
                    if($CategorieN3->getID() == $CategoryParente->getID())
                        $html.=" class='active'";
                    $html.= "><a href='".$CategorieN3->getUrl()."'>".$CategorieN3->getTitre()."</a>";
                    
                }
                $html.="</ul>";
            }
            $html.="</li>";
		}
		$html.="</ul>";
	}
	$html.="</li>";
	
	
	
}
$html.="</ul>";




echo $html;





?>
