<?php
require_once '../../BD/CategorieBD.php';
//require_once '../../BD/ArticleBD.php';

$article = NULL;
$category = NULL;
$html = NULL;

if(	(isset( $_GET['article'] ) ) )
{// Si l'article est renseigné dans l'url, on recherche les catégories parentes 
	
	$categoryBD = new CategorieBD();
	print_r($categoryBD->getSuperParentCategoryOfArticle($_GET['article']));


}
elseif( isset( $_GET['categorie'] ) )
{// Sinon si une catégorie est passé en paramètre, on utilise la catégorie, puis on liste les sous catégories de cette dernière, puis les articles pour chaque catégorie

}




$articleID = NULL;
$article = NULL;
/*$article = new ArticleBD();
$category = new CategorieBD();*/

$html.="<h2>";





?>