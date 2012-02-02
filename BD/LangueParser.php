<?php
    include_once('../METIER/Langue.php');
    
    
    
    class LangueParser
    {  
        private $DomDoc ;
        
        // constructeur
        // permet de valuer les 4 premiers attributs de la classe
        public function __construct()
        {
            $XmlFile = fopen('../PRESENTATION/LANGUE/lang.xml', 'r');
            $XmlFileText = fread($XmlFile, filesize('../PRESENTATION/LANGUE/lang.xml'));
            fclose($XmlFile);
            $XmlFileText = preg_replace("/>\s+</", "><", $XmlFileText);
            $this->DomDoc = new DomDocument();
            $this->DomDoc->loadXML($XmlFileText);
        }  
        
        /** getWord()
         *  Renvoie un objet Langue contenant une trad en Fr et En
         *  @return Langue $word : une chaine contenant le mot dans les deux langues
         */
        public function getWord($name)
        {
           $root = $this->DomDoc->getElementsByTagName('lang')->item(0);
            //echo $root->nodeName;
            $words = $root->childNodes;
            //var_dump($words);
            foreach($words as $word)
            {
                $attr = $word->getAttribute ("txt");
                if($attr == $name)
                {
                    $Fr_En_Node = $word->childNodes;
                    $FR = '';
                    $EN = '';
                    foreach($Fr_En_Node as $traductionNode)
                    {
                        if($traductionNode->nodeName == "fr")
                        {
                            $FR = $traductionNode->nodeValue;
                        }
                        elseif($traductionNode->nodeName == "en")
                        {
                            $EN = $traductionNode->nodeValue; 
                        }
                    }
                    
                    $myWord = new Langue($name,$FR,$EN);    
                    return $myWord;
                }
            }
            return new Langue($name,"_Traduction_error","_Traduction_error"); // retourne une erreur
         }
    }
    
    
?>
