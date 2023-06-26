<?php
class PaiementClient implements \JsonSerializable
 
{
    private $idPaieClient;
    private $nomClient;
    private $montant;
    private $montantRester;
    private $statut;
    private $date;
   

    public function __construct($idPaieClient,$nomClient,$montant,$montantRester,$statut,$date) {
        
        $this->idPaieClient=$idPaieClient;
        $this->nomClient=$nomClient;
        $this->montant=$montant;

        $this->montantRester=$montantRester;
        $this->statut=$statut;
        $this->date=$date;
      

    }


    
    public function getIdPaieClient() {
        return $this->idPaieClient;

    }


    public function getNomClient() {
        return $this->nomClient;
    }
   
   

    public function getMontant() {
        return $this->montant;
    }

    public function getMontantRester() {
        return $this->montantRester;
    }

    public function getStatut() {
        return $this->statut;
    }
   

    
   public function getDate() {
    return $this->date;
   }


     
    


    public function setIdPaieClient($value) {
    $this->idPaieClient = $value;
    }


      
        public function setNomClient($value) {  
        $this->nomClient = $value; 
    }
    
    public function setMontant($value) {
        $this->montant = $value;
    }
    public function setMontantRester($value) {
        $this->montantRester = $value;
    }
 

    
    public function setStatut($value) {
        $this->statut= $value;
    }




    public function setDate($value) {
        $this->date = $value;
    }
    
   
    public function jsonSerialize() {
        return [
            'idPaieClient'=> $this->idPaieClient,
            'nomClient'=> $this->nomClient,
            'montant' => $this->montant,
            'montantRester'=>$this->montantRester,
            'statut'=>$this->statut,
            'date'=> $this->date
            
           
        ];
    }


}