<?php
class Membre
{
	private $id;
	private $pseudo;
	private $idEquipe;
	private $nom;
	private $prenom;
	private $mdp;
	private $mail;
	private $departement;
	private $promotion;
	private $statut;
	private $photo;
	private $date;
	
	public function __construct($id,
								$pseudo,
								$idEquipe,
								$nom,
								$prenom,
								$mdp,
								$mail,
								$departement,
								$promotion,
								$statut,
								$photo,
								$date)
	{
		$this->id = $id;
		$this->pseudo = $pseudo;
		$this->idEquipe = $idEquipe;
		$this->nom = $nom;
		$this->prénom = $prenom;
		$this->mdp = $mdp;
		$this->mail = $mail;
		$this->departement = $departement;
		$this->promotion = $promotion;
		$this->statut = $statut;
		$this->photo = $photo;
		$this->date = $date;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getPseudo()
	{
		return $this->pseudo;
	}
	
	public function getIdEquipe()
	{
		return $this->idEquipe;
	}
	
	public function getNom()
	{
		return $this->nom;
	}
	
	public function getPrenom()
	{
		return $this->prenom;
	}
	
	public function getMdp()
	{
		return $this->mdp();
	}
	
	public function getMail()
	{
		return $this->mail;
	}
	
	public function getDepartement()
	{
		return $this->departement;
	}
	
	public function getPromotion()
	{
		return $this->promotion;
	}
	
	public function getStatut()
	{
		return $this->statut;
	}
	
	public function getPhoto()
	{
		return $this->photo;
	}
	
	public function getDate()
	{
		return $this->date;
	}
}
?>