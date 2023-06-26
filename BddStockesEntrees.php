
<?php



class BddStockesEntrees{
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
     
        // Cette fonction permet de lire le contenu de la table st$stockesEntree
        public function read(){
 
            $sql  = " SELECT * FROM stockesEntrees";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddStockesEntree = $req ->fetchAll();                                      
            $StockesEntrees = []; // On mets une table pour pouvoir lire l'ensemble des commamdes de notre table
                foreach(  $bddStockesEntree as $stockesEntree){
                    $StockesEntrees[]  = new stockeEntre(
                     
                                                    $stockesEntree['idStocke'],
                                                    $stockesEntree['idFournisseur'],
                                                    $stockesEntree['libelle'],
                                                    $stockesEntree['quantite'],
                                                    $stockesEntree['prixUnitaire'],
                                                    $stockesEntree['date']
                                                    
                                                );
                       }
            return  $StockesEntrees;
            
            }

           
                 // Cette fonction nous sert à modifier les champs des rentrées de stockes
     public function update($stockeEntre){
        $sql  = " UPDATE stockesEntrees SET idFournisseur=:idFournisseur,libelle=:libelle,prixUnitaire=:prixUnitaire,quantite=:quantite,date =:date where idStocke=:idStocke";
        $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
        $req->execute([
                    ':idStocke'=>$stockeEntre->getIdStocke(),
                    ':idFournisseur'=>$stockeEntre->getIdFournisseur(),
                    ':libelle'=>$stockeEntre->getLibelle(),
                    ':prixUnitaire'=>$stockeEntre->getPrixUnitaire(),
                    ':quantite'=>$stockeEntre->getQuantite(),
                    ':date'=>$stockeEntre->getDate()
                           
            ]);


         
        }

                 
        public function Search($idStocke){
               
            $sql = "SELECT *FROM stockesEntrees where idStocke=:idStocke"; 
            $req =$this->connexion->prepare($sql); 
            $req->execute([
                ':idStocke'=>$idStocke
            ]);
            $bddStockesEntree = $req ->fetchAll();
            foreach($bddStockesEntree as $stockesEntree){
                    $stocke = new stockeEntre(
                                                $stockesEntree['idStocke'],
                                                $stockesEntree['idFournisseur'],
                                                $stockesEntree['libelle'],
                                                $stockesEntree['quantite'],
                                                $stockesEntree['prixUnitaire'],
                                                $stockesEntree['date']
                        
                                             
                                                    
                                         );
                }
           return $stocke;

        }





            public function SearchStocke($libelle){
                $sql ="SELECT *FROM stockesEntrees where libelle like '%$libelle%' ";  
                $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
                $req->execute();
                $bddStockesEntree = $req ->fetchAll();
                $StockesEntrees = [];
                    foreach( $bddStockesEntree as $stocke){
                        $StockesEntrees[]  =  new stockeEntre(       
                                                                $stocke['idStocke'],  
                                                                $stocke['idFournisseur'],
                                                                $stocke['libelle'],
                                                                $stocke['quantite'],
                                                                $stocke['prixUnitaire'],
                                                                $stocke['date']
                                                );
            }
                
            return $StockesEntrees;
            }        



                 
         public function insert($idFournisseur,$libelle,$quantite,$prixUnitaire,$date){
            $sql  = " INSERT INTO stockesEntrees  (idFournisseur,libelle,quantite,prixUnitaire,date) VALUES (:idFournisseur,:libelle,:quantite,:prixUnitaire,:date)";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
           
            ':idFournisseur'=>$idFournisseur,
            ':libelle'=>$libelle,
            ':quantite'=>$quantite,
            ':prixUnitaire'=>$prixUnitaire,
            ':date'=>$date
            
            ]);
        }


        public function delete($idStocke){
            $sql  = "DELETE FROM stockesEntrees where idStocke =:idStocke ";
            $req =$this->connexion->prepare($sql); 
        
            // elle se connecte à ma base de données
            $req->execute([
    
                ':idStocke'=> $idStocke
               
                ]);

        }


              
    public function countStocksEntrees(){
        $sql  = " SELECT COUNT(*) FROM stockesEntrees  ";
        $req =$this->connexion->query($sql); 
        $stockesEntrees = $req ->fetchColumn();
        return $stockesEntrees;
        
        }
















        }        


