<?php
class Partenaire
{
	public $id;
	public $nom;
	public $logo;
	public $site;
	public $descFr;
	public $descAn;
	
	public function __construct($id, $nom, $logo, $site, $descFr, $descAn)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->logo = $logo;
		$this->site = $site;
		$this->descFr = $descFr;
		$this->descAn = $descAn;
	}
}