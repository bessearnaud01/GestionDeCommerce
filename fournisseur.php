<?php
class fournisseur implements \JsonSerializable
{
    
    private $idFournisseur;
    private $idProduit;
    private $entreprise; 
    private $telephone;
    private  $email;
    private $adresse;
    
    public function __construct($idFournisseur,$idProduit,$entreprise,$telephone,$email,$adresse) {
        $this->idFournisseur = $idFournisseur;
        $this->idProduit = $idProduit;
        $this->entreprise = $entreprise;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->adresse= $adresse;
        
       
    }
   
    public function getIdFournisseur() {
        return $this->idFournisseur;

    }
    public function getIdProduit() {
        return $this->idProduit;
    }
    
    public function getEntreprise() {
        return $this->entreprise;
    }
   

    public function getTelephone() {
        return $this->telephone;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getAdresse() {
        return $this->adresse;
    }

    public function setIdFournisseur($value) {
        $this->idFournisseur = $value;
    }

    public function setIdProduit($value) {
        $this->idProduit = $value;
    }
    public function setEntreprise($value) {
        $this->entreprise = $value;
    }
    
    public function setTelephone($value) {
        $this->telephone=$value;
    }


   
    public function setEmail($value) {
        $this->email = $value;

    }
    public function setAdresse($value) {
        $this->adresse = $value;

    }
    
    
    public function jsonSerialize() { // Elle sert a recupere la table fournisseur en javascript on met à l'en tête de la classe implements \JsonSerializable
        return [
           
            'idFournisseur'=>$this->idFournisseur,
           'idProduit'=> $this->idProduit,
           'entreprise'=>$this->entreprise,
           'telephone'=>$this->telephone,
           'email'=>$this->email,
           'adresse'=>$this->adresse
           
            
        ];
    }
  

    
}