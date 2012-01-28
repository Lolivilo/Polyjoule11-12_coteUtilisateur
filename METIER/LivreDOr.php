<?php 
class LivreDOr
{
	private $id;
	private $posteur;
	private $mail;
	private $date;
	private $message;
	
	public function __construct($id, $posteur, $mail, $date, $message)
	{
		$this->id = $id;
		$this->posteur = $posteur;
		$this->mail = $mail;
		$this->date = $date;
		$this->message = $message;
	}
	
///// Getters /////
	public function getId()
	{
		return $this->id;
	}
	
	public function getPosteur()
	{
		return $this->posteur;
	}
	
	public function getMail()
	{
		return $this->mail;
	}
	
	public function getDate()
	{
		return $this->date;
	}
	
	public function getMessage()
	{
		return $this->message;
	}
}
?>