<?php


class Equipe
{
	private $id;
	private $annee;
	
	public function __construct($id, $annee)
	{
		$this->id = $id;
		$this->annee = $annee;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getAnnee()
	{
		return $this->annee;
	}
}


?>