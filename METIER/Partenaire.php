<?php
class Partenaire
{
	public $id;
	public $nom;
	public $logo;
	public $site;
	public $descFr;
	public $descEn;
	
	public function __construct($id, $nom, $logo, $site, $descFr, $descEn)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->logo = $logo;
		$this->site = $site;
		$this->descFr = $descFr;
		$this->descEn = $descEn;
	}
	
///// Getters /////
	private function getId()
	{
		return $this->id;
	}
	
	private function getNom()
	{
		return $this->nom;
	}
	
	private function getLogo()
	{
		return $this->logo;
	}
	
	private function getSite()
	{
		return $this->site;
	}
	
	private function getDescFr()
	{
		return $this->descFr;
	}
	
	private function getDescEn()
	{
		return $this->descEn;
	}

}