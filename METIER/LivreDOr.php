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
	public function getFormatedDate()
    {	
        return date('d', strtotime($this->date))." ".$this->getStringMonth(strtotime($this->date))." ".date('Y', strtotime($this->date));
    }
    
    private function getStringMonth($date)
    {
    	$stringDay = "";
    	if($_SESSION['langue'] == 'EN')
    	{
    		$stringDay = date("F",$date);
    	}
    	else
    	{
    		switch(intval(date("m",$date)))
    		{
    			case 1:
    				$stringDay = "Janvier";
    				break;
    			case 2:
    				$stringDay = "F&eacute;vrier";
    				break;
    			case 3:
    				$stringDay = "Mars";
    				break;
    			case 4:
    				$stringDay = "Avril";
    				break;
    			case 5:
    				$stringDay = "Mai";
    				break;
    			case 6:
    				$stringDay = "Juin";
    				break;
    			case 7:
    				$stringDay = "Juillet";
    				break;
    			case 8:
    				$stringDay = "Ao&ucirc;t";
    				break;
    			case 9:
    				$stringDay = "Septembre";
    				break;
    			case 10:
    				$stringDay = "Octobre";
    				break;
    			case 11:
    				$stringDay = "Novembre";
    				break;
    			case 12:
    				$stringDay = "D&eacute;cembre";
    				break;
    		}
    	}
    	return $stringDay;
    }

	
	public function getMessage()
	{
		return $this->message;
	}
}
?>