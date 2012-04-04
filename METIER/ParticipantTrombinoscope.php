<?php
class ParticipantTrombinoscope
{
	private $id;
	private $nom;
	private $prenom;
	private $formationFR;
	private $formationEN;
	private $annee;
	private $photo;
	private $mail;
	private $role;
	
	public function __construct($id, $nom, $prenom, $formationFR, $formationEN, $annee, $photo, $mail, $role)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->formationFR = $formationFR;
		$this->formationEN = $formationEN;
		$this->annee = $annee;
		$this->photo = $photo;
		$this->mail = $mail;
		$this->role = $role;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getNom()
	{
		return $this->nom;
	}
	
	public function getPrenom()
	{
		return $this->prenom;
	}
	
	public function getFormation()
	{
		if(  (isset($_SESSION['langue'])) && ($_SESSION['langue'] == 'FR') )
		{
			return $this->formationFR;
		}
		else if( (isset($_SESSION['langue'])) && ($_SESSION['langue'] == 'EN') )
		{
			return $this->formationEN;
		}
		else
		{
			// A TRAITER !!!!!
		}
	}
	
	public function getAnnee()
	{
		return $this->annee;
	}
	
	public function getPhoto()
	{
		return $this->photo;
	}
	
	public function getMail()
	{
		return $this->mail;
	}
	
	public function getRole()
	{
		return $this->role;
	}
}

?>