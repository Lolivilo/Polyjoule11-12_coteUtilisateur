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