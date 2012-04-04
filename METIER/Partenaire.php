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
	public function getId()
	{
		return $this->id;
	}
	
	public function getIdArticle()
	{
		return $this->idArticle;
	}
	
	public function getNom()
	{
		return $this->nom;
	}
	
	public function getLogo()
	{
		return $this->logo;
	}
	
	public function getSite()
	{
		return $this->site;
	}
	public function getDesc()
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
	public function getDescFr()
	{
		return $this->descFr;
	}
	
	public function getDescEn()
	{
		return $this->descEn;
	}

}

?>