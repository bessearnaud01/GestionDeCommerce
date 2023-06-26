<?php



class BddCommande{
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
     
        // Cette fonction permet de lire le contenu de la table commande
        public function read(){
 
            $sql  = " SELECT * FROM commandes";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddCommande = $req ->fetchAll();
            $commandes= []; // On mets une table pour pouvoir lire l'ensemble des commamdes de notre table
                foreach(  $bddCommande as $commande){
                    $commandes[]  = new commande(
                                                   
                                                    $commande['idCommande'],
                                                    $commande['idProduit'],
                                                    $commande['nomProduit'],
                                                    $commande['nomClient'],
                                                    $commande['quantite'],
                                                    $commande['prixUnitaire'],
                                                    $commande['date']
                                                    
                                                );
                       }
            return  $commandes;
            
            }

       
         // Cette fonction sert à inserer les données de la table des commandes
             
         public function insert($idProduit,$nomProduit,$nomClient,$quantite,$prixUnitaire,$date){
            $sql  = " INSERT INTO commandes  (idProduit,nomProduit,nomClient,quantite,prixUnitaire,date) VALUES (:idProduit,:nomProduit,:nomClient,:quantite,:prixUnitaire,:date)";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
           
            ':idProduit'=>$idProduit,
            ':nomProduit'=>$nomProduit,
            ':nomClient'=>$nomClient,
            ':quantite'=>$quantite,
            ':prixUnitaire'=>$prixUnitaire,
            ':date'=>$date
            
            ]);
        }


             
     // Cette fonction nous sert à modifier les champs commandes
     public function update($commande){
        $sql  = " UPDATE commandes SET idProduit=:idProduit,nomProduit=:nomProduit,nomClient=:nomClient,prixUnitaire=:prixUnitaire,quantite=:quantite,date =:date where idCommande=:idCommande";
        $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
        $req->execute([
                    ':idCommande'=>$commande->getIdCommande(),
                     ':nomProduit'=>$commande-> getNomProduit(),
                    ':idProduit'=>$commande-> getIdProduit(),
                    ':nomClient'=>$commande->getNomClient(),
                    ':prixUnitaire'=>$commande->getPrixUnitaire(),
                    ':quantite'=>$commande->getQuantite(),
                    ':date'=>$commande->getDate()
                           
            ]);


         
        }


        // Cette fonction me sert à rechercher l'id pour la mise é jour d'une commade
            
        public function Search($idCommande){
               
            $sql = "SELECT *FROM commandes where idCommande=:idCommande"; 
            $req =$this->connexion->prepare($sql); 
            $req->execute([
                ':idCommande'=>$idCommande
            ]);
            $bddCommande = $req ->fetchAll();
            foreach($bddCommande as $cmde){
                    $commande = new commande(
                                            $cmde['idCommande'],
                                            $cmde['idProduit'],
                                            $cmde['nomProduit'],
                                            $cmde['nomClient'],
                                            $cmde['quantite'],
                                            $cmde['prixUnitaire'],
                                            $cmde['date']
                                             
                                                    
                                         );
                }
           return $commande;

        }





        //Cette fonction nous sert à supprimer un client par rapport à son idClient
        public function delete($idCommande){
            $sql  = "DELETE FROM commandes where idCommande=:idCommande ";
            $req =$this->connexion->prepare($sql); 
            $req->execute([
                ':idCommande'=> $idCommande
               
                ]);
        }




        public function SearchCommande($nomClient){
            $sql ="SELECT *FROM commandes where nomClient like '%$nomClient%' ";  
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddCommande = $req ->fetchAll();
            $commandes = [];
                foreach($bddCommande as $cmde){
                                $commandes[]  = new commande(        
                                    $cmde['idCommande'],
                                    $cmde['idProduit'],
                                    $cmde['nomProduit'],
                                    $cmde['nomClient'],
                                    $cmde['prixUnitaire'],
                                    $cmde['quantite'],
                                    $cmde['date']                 
                                    
                                );
        }
            
        return $commandes;
        }        




        
        public function countCommande(){
            $sql  = " SELECT COUNT(*) FROM commandes ";
            $req =$this->connexion->query($sql); 
            $nombreCommandes = $req ->fetchColumn();
            return   $nombreCommandes;
            
            }







 }