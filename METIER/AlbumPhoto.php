<?php
class LivreDOr
{
	private $id;
	private $nom;
	private $date;
	
	public function __construct($id, $nom, $date)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->date = $date;
	}
	
///// Getters /////
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
}