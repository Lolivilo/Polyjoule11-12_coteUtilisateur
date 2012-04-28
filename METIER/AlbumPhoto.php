<?php
require_once('../BD/acces_albumPhoto.php');

class AlbumPhoto
{
	private $id;
	private $nom;
	private $date;
    private $descFr;
    private $descEn;
    private $photos = array();
	
	public function __construct($id, $nom, $date, $descFr, $descEn)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->date = $date;
        $this->descFr = $descFr;
        $this->descEn = $descEn;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getNom()
	{
		return $this->nom;
	}
	
	public function getdate()
	{
		return $this->date;
	}
	public function getFormatedDate()
    {	
        return date('d', strtotime($this->date))." ".$this->getStringMonth(strtotime($this->date))." ".date('Y', strtotime($this->date));
    }
    
    private function getStringMonth($date)
    {
    	$stringDay = "";
    	if($_SESSION['langue'] == 'EN')
    	{
    		$stringDay = date("F",$date);
    	}
    	else
    	{
    		switch(intval(date("m",$date)))
    		{
    			case 1:
    				$stringDay = "Janvier";
    				break;
    			case 2:
    				$stringDay = "F&eacute;vrier";
    				break;
    			case 3:
    				$stringDay = "Mars";
    				break;
    			case 4:
    				$stringDay = "Avril";
    				break;
    			case 5:
    				$stringDay = "Mai";
    				break;
    			case 6:
    				$stringDay = "Juin";
    				break;
    			case 7:
    				$stringDay = "Juillet";
    				break;
    			case 8:
    				$stringDay = "Ao&ucirc;t";
    				break;
    			case 9:
    				$stringDay = "Septembre";
    				break;
    			case 10:
    				$stringDay = "Octobre";
    				break;
    			case 11:
    				$stringDay = "Novembre";
    				break;
    			case 12:
    				$stringDay = "D&eacute;cembre";
    				break;
    		}
    	}
    	return $stringDay;
    }

    public function getPhotos()
    {
        return $this->photos;
    }
    
    public function getFirstPhoto()
    {
    	try
    	{
    		return getFirstPhotoById($this->id);
    	}
    	catch(RequestException $e)
    	{
    		echo( $e->getMessage() );
    	}
    }
    
    public function getNbPhotos()
    {
    	try
    	{
    		return getNbPhotosById($this->id);
    	}
    	catch(RequestException $e)
    	{
    		echo( $e->getMessage() );
    	}
    }
    
    public function getDesc()
    {
        if( (isset($_SESSION['langue'])) && ($_SESSION['langue'] == 'FR') )
        {
            return $this->descFr;
        }
        else if( (isset($_SESSION['langue'])) && ($_SESSION['langue'] == 'FR') )
        {
            return $this->descEn;
        }
        else
        {
            // LEVEE  EXCEPTION
        }
    }
    
    public function getUrl()
    {
    	return("albumslideshow-".$this->id);
    }
    
    public function addPhoto($photo)
	{
		array_push($this->photos,$photo);
	}
}
?>