<?php


class BddPaiementClient{
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
      
        // Cette fonction permet de lire le contenu de la table paiementClients 
        public function read(){
 
            $sql  = " SELECT * FROM paiementsClients";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddPaiementClient = $req ->fetchAll();
             $PaiementsClients = []; 
                foreach($bddPaiementClient as $PaiementClient){
                    $PaiementsClients[]  = new PaiementClient(

                       
                                                                $PaiementClient['idPaieClient'],
                                                                $PaiementClient['nomClient'],
                                                                $PaiementClient['montant'],
                                                                $PaiementClient['montantRester'],
                                                                $PaiementClient['statut'],
                                                                $PaiementClient['date']
                                                   
                            
                                                            );
                }
                        
            return $PaiementsClients;
            
            }

    // Cette fonction sert à inserer les données de la table paieCleints
             
    public function insert($nomClient,$montant,$montantRester,$statut,$date){
        $sql  = " INSERT INTO paiementsClients(nomClient,montant,montantRester,statut,date) VALUES (:nomClient,:montant,:montantRester,:statut,:date)";
        $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
        $req->execute([
        ':nomClient'=>$nomClient,
        ':montant'=>$montant,
        ':montantRester'=>$montantRester,
        ':statut'=>$statut,
        ':date'=>$date
        
        ]);
    }


   
     // Cette fonction nous sert à modifier les champs du paieCleint
     public function update($paieClient){
        $sql  = " UPDATE paiementsClients SET nomClient =:nomClient,montant =:montant,montantRester =:montantRester,statut=:statut,date=:date where idPaieClient=:idPaieClient";
        $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
        $req->execute([
           
            ':idPaieClient'=>$paieClient->getIdPaieClient(),
            ':nomClient'=>$paieClient->getNomClient(),
            ':montant'=>$paieClient->getMontant(),
            ':montantRester'=>$paieClient->getMontantRester(),
            ':statut'=>$paieClient->getStatut(),
            ':date'=>$paieClient->getDate()
            
            ]);

        }
                 

        public function Search($idPaieClient){
               
            $sql = "SELECT *FROM  paiementsClients where idPaieClient =:idPaieClient"; 
            $req =$this->connexion->prepare($sql); 
            $req->execute([
                ':idPaieClient'=>$idPaieClient
            ]);
            $bddPaiementClient = $req ->fetchAll();
            foreach($bddPaiementClient as $PaiementClient){
                   $paieClient = new PaiementClient(
                                                $PaiementClient['idPaieClient'],
                                                $PaiementClient['nomClient'],
                                                $PaiementClient['montant'],
                                                $PaiementClient['montantRester'],
                                                $PaiementClient['statut'],
                                                $PaiementClient['date']
                                             
                                                    
                                         );
                }
           return $paieClient  ;

        }





        public function delete($idPaieClient){
            $sql  = "DELETE FROM paiementsClients where idPaieClient=:idPaieClient";
            $req =$this->connexion->prepare($sql); 
        
            $req->execute([
    
                ':idPaieClient'=> $idPaieClient
               
                ]);

        }
   





        public function SearchPaieClient($nomClient){
            $sql ="SELECT *FROM paiementsClients where nomClient like '%$nomClient%' ";  
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddPaiementClient = $req ->fetchAll();
            $PaiementsClients = [];
                  foreach($bddPaiementClient as $PaiementClient){
                    $PaiementsClients[]  =  new  PaiementClient(    
                                                            $PaiementClient['idPaieClient'],
                                                            $PaiementClient['nomClient'],
                                                            $PaiementClient['montant'],
                                                            $PaiementClient['montantRester'],
                                                            $PaiementClient['statut'],
                                                            $PaiementClient['date']
                                                        
                            
                                            );
        }
            
        return $PaiementsClients;
        }        







            
            // La fonction elle me permet de compter le nombre famille des produits
            public function countPaieClient(){
                $sql  = " SELECT COUNT(*) FROM paiementsClients  ";
                $req =$this->connexion->query($sql); 
                $nombrePaieClient = $req ->fetchColumn();
                return $nombrePaieClient;
                
                }





        }        
















        


