<?php
class StockeEntre implements \JsonSerializable
{
    private $idStocke;
    private $idFournisseur;
    private $libelle;
    private $prixUnitaire;
    private $quantite;
    private $date;
   

    public function __construct($idStocke,$idFournisseur,$libelle,$prixUnitaire,$quantite,$date) {
        
        $this->idStocke=$idStocke;
        $this->idFournisseur=$idFournisseur;
        $this->libelle=$libelle;
        $this->prixUnitaire=$prixUnitaire;
        $this->quantite=$quantite;
        $this->date=$date;
      
        

    }
   
    public function getIdStocke() {
        return $this->idStocke;

    }

    public function getIdFournisseur() {
        return $this->idFournisseur;

    }

    
   public function getDate() {
    return $this->date;
   }


    public function getLibelle() {
        return $this->libelle;
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



    public function setIdStocke($value) {
    $this->idStocke = $value;
    }

    public function setIdFournisseur($value) {
        $this->idFournisseur = $value;
        }



    public function setlibelle($value) {
        $this->libelle = $value;
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
            'idStocke' => $this->idStocke,
            'idFournisseur' => $this->idFournisseur,
            'libelle' => $this->libelle,
            'quantite' => $this->quantite,
            'prixUnitaire' => $this->prixUnitaire,
            'montant' => $this->getMontantDu(),
            'date' => $this->date
            
           
        ];
    }


}