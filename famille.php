<?php
  
class famille implements \JsonSerializable
{
    private $idFamille;
    private $libelle;
   

    public function __construct($idFamille,$libelle) {
        $this->idFamille = $idFamille;
        $this->libelle = $libelle;
       
    }
   
    public function getIdFamille() {
        return $this->idFamille;
    }
   
    public function getLibelle() {
        return $this->libelle;
    }
   
    
    public function setIdFamille($value) {
        $this->idFamille = $value;

    }
    public function setLibelle($value) {
        $this->libelle = $value;

    }


    
        public function jsonSerialize() {
            return [
                'idFamille' => $this->idFamille,
                'libelle' => $this->libelle
                
                
            ];
        }
    }



