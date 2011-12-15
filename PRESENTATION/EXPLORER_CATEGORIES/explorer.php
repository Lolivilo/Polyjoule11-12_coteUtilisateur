<?php
require_once '../BD/CategorieBD.php';
require_once '../BD/ArticleBD.php';

$article = NULL;
$category = NULL;


if(	(isset($_GET['article']))
{// Si l'article est renseignŽ dans l'url, on recherche les catŽgories parentes 



}
elseif(isset($_GET['categorie']))
{// Sinon si une catŽgorie est passŽ en paramtre, on utilise la catŽgorie, puis on liste les sous catŽgories de cette dernire, puis les articles pour chaque catŽgorie

}




$articleID = NULL;
$article = NULL;
$article = new ArticleBD('localhost', 'polyjoule', 'polyjoule', 'azerty');
$category = new CategorieBD('localhost', 'polyjoule', 'polyjoule', 'azerty');

$html.="<h2>





?>