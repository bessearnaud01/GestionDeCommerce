<?php


class BddFactures{
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
     
        // Cette fonction permet de lire le contenu de la table factures
        public function read(){
 
            $sql  = " SELECT * FROM factures";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddFactures = $req ->fetchAll();
            $factures= []; // On mets une table pour pouvoir lire l'ensemble des factures de notre table
                foreach(  $bddFactures as $facture){
                    $factures[]  = new facture(
                                                    
                                                         
                                        $facture['idFacture'],  
                                        $facture['nomClient'],
                                        $facture['nomProduit'],
                                        $facture['libelle'],
                                        $facture['quantite'],
                                        $facture['prixUnitaire'],
                                        $facture['date']
                        );
                                                
                }
            
            return $factures;
            
            }


                         // Cette fonction nous sert à modifier les champs de la factures
     public function update($facture){
                    $sql  = " UPDATE factures SET nomClient=:nomClient,nomProduit=:nomProduit,libelle=:libelle,prixUnitaire=:prixUnitaire,quantite=:quantite,date =:date where idFacture=:idFacture";
                    $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
                    $req->execute([
                                ':idFacture'=>$facture->getIdFacture(),
                                ':nomClient'=>$facture->getNomClient(),
                                ':nomProduit'=>$facture->getNomProduit(),
                                ':libelle'=>$facture->getLibelle(),
                                ':prixUnitaire'=>$facture->getPrixUnitaire(),
                                ':quantite'=>$facture->getQuantite(),
                                ':date'=>$facture->getDate()
                                       
                        ]);
            
            
                     
                    }



                              
        public function Search($idFacture){
               
                    $sql = "SELECT *FROM factures where idFacture=:idFacture"; 
                    $req =$this->connexion->prepare($sql); 
                    $req->execute([
                        ':idFacture'=>$idFacture
                    ]);
                    $bddFactures = $req ->fetchAll();
        
                    foreach($bddFactures as $fcture){
                            $facture = new Facture(
                                                        $fcture['idFacture'],
                                                        $fcture['nomClient'],
                                                        $fcture['nomProduit'],
                                                        $fcture['libelle'],
                                                        $fcture['quantite'],
                                                        $fcture['prixUnitaire'],
                                                        $fcture['date']
                                
                                                     
                                                            
                                                 );
                        }
                   return $facture;       
                }


                        
         public function insert($nomClient, $nomProduit,$libelle,$quantite,$prixUnitaire,$date){
            $sql  = " INSERT INTO  factures (nomClient,nomProduit,libelle,quantite,prixUnitaire,date) VALUES (:nomClient,:nomProduit,:libelle,:quantite,:prixUnitaire,:date)";
            $req =$this->connexion->prepare($sql);
            // elle se connecte à ma base de données
            $req->execute([
           
            ':nomClient'=>$nomClient,
            ':nomProduit'=>$nomProduit,
            ':libelle'=>$libelle,
            ':quantite'=>$quantite,
            ':prixUnitaire'=>$prixUnitaire,
            ':date'=>$date
            
            ]);
        }

        
        public function delete($idFacture){
            $sql  = "DELETE FROM factures where idFacture=:idFacture";
            $req =$this->connexion->prepare($sql); 
        
            // elle se connecte à ma base de données
            $req->execute([
    
                ':idFacture'=> $idFacture
               
                ]);

        }
   
        public function SearchFacture($libelle){
            $sql ="SELECT *FROM factures where libelle like '%$libelle%' ";  
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddFacture = $req ->fetchAll();
            $factures = [];
                foreach( $bddFacture as $fcture){
                    $factures[]  =  new Facture(       
                                                            $fcture['idFacture'],  
                                                            $fcture['nomClient'],
                                                            $fcture['nomProduit'],
                                                            $fcture['libelle'],
                                                            $fcture['quantite'],
                                                            $fcture['prixUnitaire'],
                                                            $fcture['date']
                                            );
        }
            
        return $factures;
        }        
            

 }