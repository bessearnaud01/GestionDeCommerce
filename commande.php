<?php
class commande implements \JsonSerializable
{
    private $idCommande;
    private $nomProduit;
    private $idProduit;
    private $nomClient;
    private $prixUnitaire;
    private $quantite;
    private $date;
   

    public function __construct($idCommande,$idProduit,$nomProduit,$nomClient,$prixUnitaire,$quantite,$date) {
        
        $this->idCommande=$idCommande;
         $this->nomProduit=$nomProduit;
        $this->idProduit=$idProduit;
        $this->nomClient=$nomClient;
        $this->prixUnitaire=$prixUnitaire;
        $this->quantite=$quantite;
        $this->date=$date;
      
        

    }
   
    public function getIdCommande() {
        return $this->idCommande;

    }
     public function getNomProduit() {
        return $this->nomProduit;
    }
    public function getIdProduit() {
        return $this->idProduit;
    }
    public function getNomClient() {
        return $this->nomClient;
    }
   
    
    public function getPrixUnitaire() {
        return $this->prixUnitaire;
    }

    public function getQuantite() {
        return $this->quantite;
    }
     
    
 public function getMontantDu() {
   $montantDu = ($this->prixUnitaire*$this->quantite) + ($this->prixUnitaire*$this->quantite*7.7)/100;
   $resultat = number_format($montantDu, 2, ',', ' ');
   return $resultat;
}


   public function getDate() {
    return $this->date;
}


    public function setIdCommande($value) {
    $this->idCommande = $value;
    }
    public function setIdProduit($value) {
        $this->idProduit = $value;
    }
    public function setNomProduit($value) {
        $this->nomProduit = $value;
    }
    
    public function setNomClient($value) {
        $this->nomClient = $value;
    }

    public function setQuantite($value) {
        $this->quantite = $value;
    }

    public function setPrixUnitaire($value) {
        $this->prixUnitaire = $value;
    }
 

    public function setDate($value) {
        $this->date = $value;
    }
    
   
    public function jsonSerialize() {
        return [
            'idCommande' => $this->idCommande,
            'idProduit' => $this->idProduit,
             'nomProduit' => $this->nomProduit,
            'nomClient' => $this->nomClient,
            'quantite' => $this->quantite,
            'prixUnitaire' => $this->prixUnitaire,
            'montant' => $this->getMontantDu(),
            'date' => $this->date
            
           
        ];
    }


}