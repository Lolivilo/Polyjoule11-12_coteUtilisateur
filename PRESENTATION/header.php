<?php 
	require_once('../BD/CategorieBD.php');
	require_once('MENU/Menu.php');
    require_once('../BD/LangueParser.php');
	include_once('LANGUE/sessionLangue.php');
    require_once('../BD/AlbumPhotoBd.php');
    
    $parserLangue = new LangueParser();
    $allHeaders = getallheaders();
?>

<div id="header">
<?php echo(); ?>
<h1><a href=<?php echo("'http://".$allHeaders["Host"]."/PRESENTATION/index.php'"); ?>><img src="Style/image/logoPolyjoule.png" alt="Polyjoule"/></a></h1>
<div id="barre">
<a href=""><?php echo $parserLangue->getWord("contact")->getTraduction(); ?></a>


<span class="lang">
	<a href=<?php echo("'http://".$_SERVER['HTTP_HOST']."/PRESENTATION/index.php?lang=FR'");?> class="active">FR</a> | <a href=<?php echo("'http://".$_SERVER['HTTP_HOST']."/PRESENTATION/index.php?lang=EN'");?>>EN</a>
</span>
<form method="get" action="http://localhost:8888/PRESENTATION/search.php">
	<label for="search"><?php echo($parserLangue->getWord("search")->getTraduction());?></p></label>
	<input type="text" id="search" name="w">
	<input type="submit" value="ok">
</form>
</div>		
<div class="clear"></div>
</div>
<ul id="menuHeader">
    <?php
        $menu = new CategorieBD();
    	echo getMenu($menu,'limenu','child');
    ?>
</ul>
