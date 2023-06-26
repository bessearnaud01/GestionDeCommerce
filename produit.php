<?php
class produit  implements \JsonSerializable
{
    
    private $idProduit ;
    private $idFamille;
    private $nomProduit;
    private $marque;
    private  $pa;
    private $image;
    
    public function __construct( $idProduit,$idFamille,$nomProduit,$marque,$pa,$image) {
        $this->idProduit = $idProduit;
        $this->idFamille = $idFamille;
         $this->nomProduit = $nomProduit;
        $this->marque = $marque;
        $this->pa = $pa;
        $this->image = $image;
       
    }
   
    public function getIdProduit() {
        return $this->idProduit;

    }
    public function getIdFamille() {
        return $this->idFamille;
    }
    public function getNomProduit() {
        return $this->nomProduit;
    }
    
    public function getMarque() {
        return $this->marque;
    }
    public function getPa() {
        return $this->pa;
    }
     
     
    public function getImage() {
        return $this->image;
    }

    public function setIdProduit($value) {
        $this->idProduit = $value;
    }
    public function setIdFamille($value) {
        $this->idFamille = $value;
    }
    
    public function setNomProduit($value) {
        $this->nomProduit=$value;
    }
    public function setMarque($value) {
        $this->marque = $value;
    }
   
    public function setPa($value) {
        $this->pa=$value;
    }
   
    public function setImage($value) {
        $this->image = $value;

    }
    
    
    public function jsonSerialize() { // Elle sert a recupere la table fournisseur en javascript on met à l'en tête de la classe implements \JsonSerializable
        return [
           
            
           'idProduit'=> $this->idProduit,
           'idFamille'=>$this->idFamille,
           'nomProduit'=>$this->nomProduit,
           'marque'=>$this->marque,
           'pa'=>$this->pa,
           'image'=>$this->image
          
           
            
        ];
    }
  

    
}