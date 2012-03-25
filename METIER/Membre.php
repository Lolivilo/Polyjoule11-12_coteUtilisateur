<?php
class Membre
{
	private $id;
	private $pseudo;
	private $idEquipe;
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
}
?>