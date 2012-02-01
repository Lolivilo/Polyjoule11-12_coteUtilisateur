<?php
    include_once('../METIER/Langue.php');
    
    
    
    class LangueParser
    {  
        private $DomDoc ;
        
        // constructeur
        // permet de valuer les 4 premiers attributs de la classe
        public function __construct()
        {
            $this->DomDoc = new DomDocument();
            $this->DomDoc->load('../PRESENTATION/LANGUE/lang.xml');
        }  
        
        /** getWord()
         *  Renvoie un objet Langue contenant une trad en Fr et En
         *  @return Langue $word : une chaine contenant le mot dans les deux langues
         */
        public function getWord($name)
        {
           /* $root = $this->DomDoc->getElementsByTagName('lang')->item(0);
            //echo $root->nodeName;
            $words = $root->childNodes;
            //var_dump($words);
            foreach($words as $word)
            {
                print_r($word);
                $attr = $word->attributes;
                implode($attr);
                print_r($attrr); 
                echo "<br>";
                
                
                //echo "1".($word->nodeName);
                //var_dump($word->getAttribute('txt'));
                $attrTxt="tt";
                //$attrTxt = (($word->attributes)->getNamedItem('txt'))->nodeValue;
                if($attrTxt == $name)
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
            }*/
            return new Langue($name,"_Traduction_error","_Traduction_error"); // retourne une erreur
         }
    }
    
    
?>
