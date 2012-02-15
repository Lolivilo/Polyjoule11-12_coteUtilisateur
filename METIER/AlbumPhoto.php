<?php
class AlbumPhoto
{
	private $id;
	private $nom;
	private $date;
    private $photos = array();
	
	public function __construct($id, $nom, $date)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->date = $date;
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
    
    public function addPhoto($photo)
	{
		array_push($this->photos,$photo);
	}
}
?>