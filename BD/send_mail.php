<?php
  	require_once("BD.php");
    
    class EMail
    {  
        private $DestMail ;
        private $SrcMail;
        private $objet ;
        private $message;
        private $boundary;
        private $_header;   

        public function __construct($sMail, $obj, $mess)
        {

            $this->DestMail = "haprock@gmail.com";
            $this->SrcMail = NoHtml($sMail);
            $this->objet = NoHtml($obj);
            $this->message = NoHtml($mess); 
            $this->boundary= "-----=".md5(rand());
            $passage_ligne = "\n"; 
            $this->_header="From: \"".$sMail."\"<".$sMail.">".$passage_ligne;
			$this->_header.= "Reply-to: \"".$sMail."\" <".$sMail.">".$passage_ligne;
			$this->_header.= "MIME-Version: 1.0".$passage_ligne;
			$this->_header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"".$this->boundary."\"".$passage_ligne;          
        }


        public function sendMail() 
        {
			$passage_ligne = "\n";
			$message = $passage_ligne."--".$this->boundary.$passage_ligne;
			//=====Ajout du message au format texte.
			$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$this->message.$passage_ligne;
			//==========
			$message.= $passage_ligne."--".$this->boundary.$passage_ligne;
			//==========
			$message.= $passage_ligne."--".$this->boundary."--".$passage_ligne;
			$message.= $passage_ligne."--".$this->boundary."--".$passage_ligne;
			//==========
			$this->message = $message;
 
			//=====Envoi de l'e-mail.
			return mail($this->DestMail,$this->objet,$this->message,$this->_header);
        }
        

    }
    
    ?>