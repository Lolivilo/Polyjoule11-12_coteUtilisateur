<?php 
	require_once('../BD/acces_rubrique.php');
	require_once('MENU/Menu.php');
    require_once('../METIER/LangueParser.php');
	include_once('LANGUE/sessionLangue.php');
    require_once('../BD/acces_albumPhoto.php');
    require_once('../METIER/FonctionsMetier/pagination.php');
    
    
    $parserLangue = new LangueParser();
?>

<div id="header">
<h1><a href=<?php echo("'index.php'"); ?>><img src="Style/image/logoPolyjoule.png" alt="Polyjoule"/></a></h1>
<div id="barre">
<a href=""><?php echo $parserLangue->getWord("contact")->getTraduction(); ?></a>


<span class="lang">
	<?php
		if($_SERVER['QUERY_STRING'] == NULL)
		{
			$link = "'".$_SERVER['PHP_SELF']."?lang=";
		}
		else
		{
			$link = "'".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."&lang=";
		}
	?>
	<a href=<?php echo($link."FR'");?> class="active">FR</a> | <a href=<?php echo($link."EN'");?>>EN</a>
</span>
<form method="get" action="search.php">
	<label for="search"><?php echo($parserLangue->getWord("search")->getTraduction());?></p></label>
	<input type="text" id="search" name="w">
	<input type="submit" value="ok">
</form>
<iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/pages/Polyjoule/121213844627305"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>
</div>		
<div class="clear"></div>
</div>
<ul id="menuHeader">
    <?php
        $menu = new CategorieBD();
    	echo getMenu($menu,'limenu','child');
    ?>
</ul>
