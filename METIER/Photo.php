<?php
    class photo
    {  
        private $id;
        
        public function __construct( $idPhoto )
        {
            $this->id = $idPhoto;
            
        }
        
        public function getId()
        {
            return $this->id ;
        }
        public function setId($id_)
        {
            $this->id = $id_;
        }
        
}
?>