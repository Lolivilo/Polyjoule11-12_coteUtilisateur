<?php
include_once '../BD/ArticleBD.php';


	$ArticleBD = new ArticleBD();

	$ArticleBD->getArticleWithId(21);
	
	
	print_r($ArticleBD->getArticlesWithCategory(1));
	
		




?>