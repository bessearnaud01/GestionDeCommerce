<?php


class BddFournisseur{
    public $connexion;
   
    public function __construct() {
        
            $opt = parse_ini_file('config.ini',true);
        
            $engine = $opt['database']['engine'];
            $host = $opt['database']['host'];
            $base = $opt['database'] ['dbname'];
            $user = $opt['credentials']['user'];
            $pass = $opt['credentials']['pass'];
        
            $url="$engine:dbname=$base;host=$host";
        
            $this->connexion = new PDO ($url, $user, $pass);
                
            }
     
        // Cette fonction permet de lire le contenu de la table du fournisseur
        public function read(){
 
            $sql  = " SELECT * FROM fournisseurs";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddfournisseur = $req ->fetchAll();
            $fournisseurs= []; // On mets une table pour pouvoir lire l'ensemble des fournisseurs de notre table
                foreach(  $bddfournisseur as $fournisseur){
                    $fournisseurs[]  = new fournisseur(
                                                    $fournisseur['idFournisseur'],
                                                    $fournisseur['idProduit'],
                                                    $fournisseur['entreprise'],
                                                    $fournisseur['telephone'],
                                                    $fournisseur['email'],
                                                    $fournisseur['adresse']
                                                    
                                                );
                }
            
            return  $fournisseurs;
            
            }

             // Cette fonction sert à inserer les données de la table fournisseurs 
             
        public function insert($idProduit,$entreprise,$telephone,$email,$adresse){
            $sql  = " INSERT INTO fournisseurs (idProduit,entreprise,telephone,email,adresse) VALUES (:idProduit,:entreprise,:telephone,:email,:adresse)";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
                
                ':idProduit'=>$idProduit,
                ':entreprise'=>$entreprise,
                ':telephone'=>$telephone,
                ':email'=>$email,
                ':adresse'=>$adresse
            ]);
        }

        public function update($fournisseur){
            $sql  = " UPDATE fournisseurs SET idProduit=:idProduit,entreprise=:entreprise,telephone=:telephone,email=:email,adresse =:adresse where idFournisseur=:idFournisseur";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
                        ':idFournisseur'=>$fournisseur->getIdFournisseur(),
                        ':idProduit'=>$fournisseur-> getIdProduit(),
                        ':entreprise'=>$fournisseur->getEntreprise(),
                        ':telephone'=>$fournisseur->getTelephone(),
                        ':email'=>$fournisseur->getEmail(),
                        ':adresse'=>$fournisseur->getAdresse()
                               
                ]);
    
    
             
            }
    
    


                            
                    /* Cette fonction Search met sert a recherche du client en fonction de idClient et me serait utile dans
                    Dans la fonction update */


                  
                    public function Search($idFournisseur){
                       
                        $sql = "SELECT *FROM fournisseurs where idFournisseur=:idFournisseur"; 
                        $req =$this->connexion->prepare($sql);
                        $req->execute([
                            ':idFournisseur'=>$idFournisseur
                        ]);
                        $bddFournisseur = $req ->fetchAll();
                        foreach($bddFournisseur as $fr){
                                $fournisseur = new fournisseur( // on récupère l'ensemble des données d'une filière par rapport à son id
                                                            $fr['idFournisseur'],
                                                            $fr['idProduit'],
                                                            $fr['entreprise'],
                                                            $fr['telephone'],
                                                            $fr['email'],
                                                            $fr['adresse']
                                                                
                                                              );
                            }
                           

                       return $fournisseur;
        
                    }




                
        public function SearchFournisseur($entreprise){
            $sql ="SELECT *FROM fournisseurs where entreprise like '%$entreprise%' ";  
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddFournisseur = $req ->fetchAll();
            $fournisseurs = [];
                foreach($bddFournisseur as $fr){
                                $fournisseurs[]  = new fournisseur( // on récupère l'ensemble des données d'une filière par rapport à son id
                                                $fr['idFournisseur'],
                                                $fr['idProduit'],
                                                $fr['entreprise'],
                                                $fr['telephone'],
                                                $fr['email'],
                                                $fr['adresse']
                                        
                                      );
        }
            
        return $fournisseurs;
    }




          // Cette fonction nous sert é supprimer une filière par rapport à son id
          public function delete($idFournisseur){
            $sql  = "DELETE FROM fournisseurs where idFournisseur=:idFournisseur ";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
    
                ':idFournisseur'=>$idFournisseur
               
                ]);

        }

               
        public function countFournisseur(){
            $sql  = " SELECT COUNT(*) FROM fournisseurs ";
            $req =$this->connexion->query($sql); 
            $nombreFournisseur = $req ->fetchColumn();
            return  $nombreFournisseur;
            
            }

















        }        
















        


