<?php 
	session_start();
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
        <div id="diapoAcceuil">
            <img src="image/photo3.png">
            <div id="newsAcceuil">
                <h2>A la une</h2>
                <div class="news">
                    <h3> 20-02-2012 Titre actu</h3>
                        <p>Description egez gze gz egz eg zeg ze ggze </p>
                        <a href="index.html">Lire la suite</a>
                </div>
                <div class="news">
                    <h3> 20-02-2012 Titre actu</h3>
                    <p>Description egez gze gz egz eg zeg ze ggze </p>
                    <a href="index.html">Lire la suite</a>
                </div>
                <div class="news">
                    <h3> 20-02-2012 Titre actu</h3>
                    <p>Description egez gze gz egz eg zeg ze ggze </p>
                    <a href="index.html">Lire la suite</a>
                </div>
            </div>
            <div class="clear"></div>
        </div>

        <ul id="menuAccueil">
            <li><a href=""><img src="Style/image/photo2.png"><span>efzegzegez</span></a></li>
            <li><a href=""><img src="Style/image/photo2.png"><span>efz ez eg zeg zeg</span></a></li>
            <li><a href=""><img src="Style/image/photo2.png"><span>efz eefb fbe berbe berrbz eg zeg ze ezgzegzge zeg</span></a></li>				
        </ul>
        <div id="footer">
            <img src="Style/image/a.png" /> <img src="Style/image/b.png" />

            <p>PolyJoule 2012 - Tous droits reservés</p>
        </div>
    </body>
</html>
