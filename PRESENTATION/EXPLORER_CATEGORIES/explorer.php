<?php

$category = new CategorieBD();

$SuperParentcategoryID = NULL;
$SuperParentcategory = NULL;

$CategoryParenteID = NULL;
$CategoryParente = NULL;

$SousCategories = NULL;

$html = NULL;


/*
 *  RECUPERATION DE LA SUPER CATEGORIE
 *  +
 * 	RECUPERATION DE LA CATEGORIE DU NIVEAU SUPERRIEUR POUR UN ARTICLE. DONNE LA CATEGORIE DU $_GET SI LA CATEGORIE EST PASSEE EN PARAMETRE
 *
 */
if(	(isset( $_GET['article'] ) ) )
{// Si l'article est renseignŽ dans l'url, on recherche les catŽgories parentes 
	$SuperParentcategoryID = $category->getSuperParentCategoryOfArticle($_GET['article']);
	$CategoryParenteID = $category->getAsssociateCategoryIDForArticle($_GET['article']);
}
elseif( isset( $_GET['categorie'] ) )
{// Sinon si une catŽgorie est passŽ en paramtre, on utilise la catŽgorie, puis on liste les sous catŽgories de cette dernire, puis les articles pour chaque catŽgorie
	$SuperParentcategoryID = $category->getSuperParentCategoryOfCategory($_GET['categorie']);
	$CategoryParenteID = $_GET['categorie'];
}
// On instancie la super catŽgorie
$SuperParentcategory = $category->getCategorieWithId($SuperParentcategoryID);
// et la catŽgorie parente de niveau supŽrieur
$CategoryParente = $category->getCategorieWithId($CategoryParenteID);
echo $CategoryParente->getId();



//RecupŽration des sous catŽgories de la catŽgorie parente
$SousCategories = $category->getSousCategories($SuperParentcategoryID);

// DEBUT AFFICHAGE HTML

$html.="<h2>".$SuperParentcategory->getTitreFR()."</h2><ul>";
foreach ($SousCategories as $_Categorie)
{
	$html.="<li class='ExpN1";
	if($_Categorie->getID() == $CategoryParente->getID())
		$html.=" selected";
	$html.="'>".$_Categorie->getTitreFR();
	$SousCategoriesN2 = NULL; // CatŽgories filles de la catŽgorie du tour de boucle du foreach
	// Si la catŽgorie en cours ˆ des filles
	if($SousCategoriesN2 = $category->getSousCategories($_Categorie->getId()))
	{
		$html.="<ul>";
		foreach ($SousCategoriesN2 as $CategorieN2)
		{
			$html.="<li class='ExpN2";
			if($CategorieN2->getID() == $CategoryParente->getID())
				$html.=" selected";
			$html.= "'>".$CategorieN2->getTitreFR()."</li>";
		}
		$html.="</ul>";
	}
	$html.="</li>";
	
	
	
}
$html.="</ul>";




echo $html;





?>