<?php
class Partenaire
{
	public $id;
	public $idArticle;
	public $nom;
	public $logo;
	public $site;
	public $descFr;
	public $descEn;
	
	public function __construct($id, $idArticle, $nom, $logo, $site, $descFr, $descEn)
	{
		$this->id = $id;
		$this->idArticle = $idArticle;
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
	
	public function getIdArticle()
	{
		return $this->idArticle;
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
	private function getDesc()
    {
        if($_SESSION['langue'] == 'EN')
        {
            return $this->descEn;
        }
        else
        {
            return $this->descFr;
        }
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

?>