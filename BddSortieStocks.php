
<?php



class BddSortieStocks{
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
     
        // Cette fonction permet de lire le contenu de la table st$stocksSortie
        public function read(){
 
            $sql  = " SELECT * FROM stocksSorties";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddstocksSorties = $req ->fetchAll();                                      
            $stockesSorties = []; // On mets une table pour pouvoir lire l'ensemble des commamdes de notre table
                foreach(  $bddstocksSorties as $stockesSortie){
                    $stockesSorties[]  = new SortieStock(
                     
                                                    $stockesSortie['idStocke'],
                                                    $stockesSortie['idClient'],
                                                    $stockesSortie['libelle'],
                                                    $stockesSortie['prixUnitaire'],
                                                    $stockesSortie['quantite'], 
                                                     $stockesSortie['date']
                                                    
                                                );
                       }
            return  $stockesSorties;
            
            }

           
    
                       // Cette fonction nous sert à modifier les champs des rentrées de stockes
     public function update($sortieStock){
        $sql  = " UPDATE stocksSorties SET idClient=:idClient,libelle=:libelle,prixUnitaire=:prixUnitaire,quantite=:quantite,date =:date where idStocke=:idStocke";
        $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
        $req->execute([
                    ':idStocke'=>$sortieStock->getIdStocke(),
                    ':idClient'=>$sortieStock->getIdClient(),
                    ':libelle'=>$sortieStock->getLibelle(),
                    ':prixUnitaire'=>$sortieStock->getPrixUnitaire(),
                    ':quantite'=>$sortieStock->getQuantite(),
                    ':date'=>$sortieStock->getDate()
                           
            ]);


         
        }

                 
        public function Search($idStocke){
               
            $sql = "SELECT *FROM stocksSorties where idStocke=:idStocke"; 
            $req =$this->connexion->prepare($sql); 
            $req->execute([
                ':idStocke'=>$idStocke
            ]);
            $bddStockesSorties = $req ->fetchAll();
            foreach($bddStockesSorties as $stockesSortie){
                    $stockes = new SortieStock(
                                                $stockesSortie['idStocke'],
                                                $stockesSortie['idClient'],
                                                $stockesSortie['libelle'],
                                                $stockesSortie['prixUnitaire'],
                                                $stockesSortie['quantite'],
                                                $stockesSortie['date']
                        
                                             
                                                    
                                         );
                }
           return $stockes;

        }




        public function delete($idStocke){
            $sql  = "DELETE FROM stocksSorties where idStocke =:idStocke ";
            $req =$this->connexion->prepare($sql); 
        
            // elle se connecte à ma base de données
            $req->execute([
    
                ':idStocke'=> $idStocke
               
                ]);

        }



        
        public function SearchStocke($libelle){
            $sql ="SELECT *FROM stocksSorties where libelle like '%$libelle%' ";  
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddSortieStocks= $req ->fetchAll();
            $StockesSorties = [];
                foreach( $bddSortieStocks as $stocke){
                    $StockesSorties[]  =  new  SortieStock(       
                                                            $stocke['idStocke'],  
                                                            $stocke['idClient'],
                                                            $stocke['libelle'],
                                                            $stocke['quantite'],
                                                            $stocke['prixUnitaire'],
                                                            $stocke['date']
                                            );
        }
            
        return $StockesSorties;
        }        






                 
        public function insert($idClient,$libelle,$quantite,$prixUnitaire,$date){
            $sql  = " INSERT INTO stocksSorties  (idClient,libelle,prixUnitaire,quantite,date) VALUES (:idClient,:libelle,:prixUnitaire,:quantite,:date)";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
           
            ':idClient'=>$idClient,
            ':libelle'=>$libelle,
            ':prixUnitaire'=>$prixUnitaire,
            ':quantite'=>$quantite,
            ':date'=>$date
            
            ]);
        }

        
    public function countStocksSorties(){
        $sql  = " SELECT COUNT(*) FROM stocksSorties ";
        $req =$this->connexion->query($sql); 
        $stocksSortie = $req ->fetchColumn();
        return $stocksSortie;
        
        }


        




        }        


