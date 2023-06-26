<?php
class Facture implements \JsonSerializable
{
    private $idFacture;
    private $nomClient;
    private $nomProduit;
    private $libelle;
    private $prixUnitaire;
    private $quantite;
    private $date;
   

    public function __construct($idFacture,$nomClient,$nomProduit,$libelle,$prixUnitaire,$quantite,$date) {
        
        $this->idFacture=$idFacture;
         $this->nomProduit=$nomProduit;
        $this->nomClient=$nomClient;
        $this->libelle=$libelle;
        $this->prixUnitaire=$prixUnitaire;
        $this->quantite=$quantite;
        $this->date=$date;
      
        

    }
   
    public function getIdFacture() {
        return $this->idFacture;

    }

    public function getNomClient() {
        return $this->nomClient;

    }

    public function getNomProduit() {
        return $this->nomProduit;

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
   
  
 public function getMontantSansTVA() {
   $montantDu = ($this->prixUnitaire*$this->quantite);
    $resultat = number_format($montantDu, 2, ',', ' ');
    return $resultat;
    
}


 public function getMontantDu() {
   $montantDu = ($this->prixUnitaire*$this->quantite) + ($this->prixUnitaire*$this->quantite*7.7)/100;
    $resultat = number_format($montantDu, 2, ',', ' ');
    return $resultat;
    
}

   
function getTVA() {
   $ValueTVA = ($this->prixUnitaire*$this->quantite*7.7)/100;
    $resultat = number_format($ValueTVA, 2, ',', ' ');
     return $resultat;
}

    public function setIdFacture($value) {
    $this->idFacture = $value;
    }

    public function setNomClient($value) {
        $this->nomClient = $value;
        }

    public function setNomProduit($value) {
        $this->nomProduit = $value;
        }

    public function setLibelle($value) {
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
            'idFacture' => $this->idFacture,
            'nomClient' => $this->nomClient,
            'nomProduit' => $this->nomProduit,
            'libelle' => $this->libelle,
            'quantite' => $this->quantite,
            'prixUnitaire' => $this->prixUnitaire,
            'montant' => $this->getMontantDu(),
            'date' => $this->date
            
           
        ];
    }


}