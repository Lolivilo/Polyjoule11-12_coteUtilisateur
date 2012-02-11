<?php
	session_start();
	require_once('../BD/CategorieBD.php');
    $categorieCourante = NULL;
    if(isset($_GET['cat']) && $_GET['cat'] != '')
    {
        $categorieCourante = new CategorieBD();
        $categorieCourante = $categorieCourante->getCategorieWithId($_GET['cat']);
    }
    if($categorieCourante == NULL)
    {
        header('Location: index.php?erreur=NO_CAT_ID');
    }
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
    <head>  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
        <title>Polyjoule</title>  
        <link rel="stylesheet" type="text/css" href="Style/index.css" />
        <script  type="text/javascript" src="JavaScript/jquery.js"></script>
        <script  type="text/javascript" src="JavaScript/menu.js"></script>
        <script  type="text/javascript" src="JavaScript/dropDown.js"></script>
    </head>
    <body>
		<?php 
			include('header.php');
		?>
		<div id="ariane">
			<a href="index.html">Notre Association</a> > <a href="index.html">Notre aaa</a> > <a href="index.html">Nzevgzg</a>
		</div>
		<?php
    		include('explorer/explorer.php');
    	?>
        <div id="corps" class="colonne2">
            <div id="colonneGauche">
                <div class="listeArticle">
                    <img src="Style/image/photo.png" />
                    <div class="description">
                        <h3>TItre article</h3>
                        <div class="italic">date</div>
                        <p>Description bla bla bla zegzeg ze gzeg zeg zeg zeg zeg zeg zesds sdvds vsd vds<br />zegz gzegg ezge</p>

                    </div>
                    <a href="index.html">Lire la suite ...</a>
                    <div class="clear"></div>
                </div>
                <!-- AUTRES ARTICLES/....
            </div>
            <div id="colonneDroite">
                <ul id="calendrier">
                    <li><a href="index.html" class="active">Janvier</a></li>	
                    <li><a href="index.html">Fevrier</a></li>	
                    <li><a href="index.html">Mars</a></li>
                    <li><a href="index.html">Avril</a></li>
                </ul>
                <form id="sondage">
                    <h3>Le sondage</h3>
                    <p> la question est ici. Du genre Seriez vous pret à ... bla bla bla ?</p>
                    <div><input type="checkbox"><label>Oui</label></div>
                    <div><input type="checkbox"><label>Non</label></div>
                    <div><input type="checkbox"><label>Peut etre</label></div>
                    <input type="submit" value="Envoyer">
                    <a href="index.html">Voir les résultats</a>
                </form>
            </div>
            <div id="footerCorps">
            </div>
        </div>
        <?php
                include_once('footer.php');
            ?>
    </body>
</html>