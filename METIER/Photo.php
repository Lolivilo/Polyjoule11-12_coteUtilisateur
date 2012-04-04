<?php
    class Photo
    {  
        private $id;
        private $id_album;
        private $titreFR;
        private $titreEN;
        private $lien;
        private $date;
        private $descFr;
        private $descEn;
        
        public function __construct($idPhoto, $idAlbum, $titreFR, $titreEN, $lien, $date, $descFr, $descEn   )
        {
            $this->id = $idPhoto;
            $this->id_album = $idAlbum;
            $this->titreFR = $titreFR;
            $this->titreEN = $titreEN;
            $this->lien = $lien;
            $this->date = $date;
            $this->descFr = $descFr;
            $this->descEn = $descEn;
            
        }
        
        public function getId()
        {
            return Bd::securityHTML($this->id) ;
        }
        
        public function getIdAlbum()
        {
            return Bd::securityHTML($this->id_album) ;
        }
        
        public function getTitre()
        {
            if($_SESSION['langue'] == 'EN')
            {
                return $this->titreEN;
            }
            else
            {
                return $this->titreFR;
            }
            
        }
        
        public function getTitreFR()
        {
            return Bd::securityHTML($this->titreFR) ;
        }

        
        public function getTitreEN()
        {
            return Bd::securityHTML($this->titreEN) ;
        }

        
        public function getLien()
        {
            return $this->lien ;
        }
        
        public function getThumbnail()
        {
        	/*$urlComplette = $this->lien;
        	$urlThumbnail = "";
        	$posExt = strrpos($urlComplette, ".");
        	for ($i = 0; $i < $posExt; $i++) {
    			$urlThumbnail .= $urlComplette[$i];
			}
			$urlThumbnail .= "_";
			*/
        	return $this->getLien(); //."_".jpg
        }

        
        public function getDate()
        {
            return Bd::securityHTML($this->date) ;
        }
        
        public function getDesc()
        {
            if( (isset($_SESSION['langue'])) && ($_SESSION['langue'] == 'FR') )
            {
               return Bd::securityHTML($this->descFr);
            }
            else if( (isset($_SESSION['langue'])) && ($_SESSION['langue'] == 'EN') )
            {
                return Bd::securityHTML($this->descEn);
            }
        }

        
}
    ?>