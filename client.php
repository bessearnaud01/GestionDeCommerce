<?php
class client implements \JsonSerializable
{
    
    private $idClient;
    private $sexe;
    private $nom;
    private  $prenom;
    private $telephone;
    private  $email;
    private $adresse;
    
    public function __construct($idClient,$sexe,$nom ,$prenom,$telephone,$email,$adresse) {
        $this->idClient = $idClient;
        $this->sexe = $sexe;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->adresse= $adresse;
        
       
    }
   
    public function getIdClient() {
        return $this->idClient;

    }
    public function getSexe() {
        return $this->sexe;
    }
    
    public function getNom() {
        return $this->nom;
    }
    public function getPrenom() {
        return $this->prenom;
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

    public function setIdClient($value) {
        $this->idClient = $value;
    }

    public function setSexe($value) {
        $this->sexe = $value;
    }
    public function setNom($value) {
        $this->nom = $value;
    }
    
    public function setPrenom($value) {
        $this->prenom=$value;
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
    
    
    
    public function jsonSerialize() {
        return [
            'idClient' => $this->idClient,
            'sexe' => $this->sexe,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'adresse' => $this->adresse
            
            
        ];
    }
  

    
}