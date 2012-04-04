<?php 
    require_once 'LangueParser.php';
    class Langue
    {
        private $name; // attr XML
        private $fr;
        private $en;
                
        public function __construct($name,$fr,$en){
            $this->name = $name; 
            $this->fr = $fr;
            $this->en = $en;
        }

        public function getTraduction()
        {
            if($_SESSION['langue'] == 'EN')
            {
                return $this->en;
            }
            else
            {
                return $this->fr;
            }

            
        }  
    }
    
?>