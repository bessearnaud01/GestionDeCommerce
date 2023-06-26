<?php


class BddProduit{
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
     
        // Cette fonction permet de lire le contenu de la table familles
        public function read(){
 
            $sql  = " SELECT * FROM produits";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddProduits = $req ->fetchAll();
            $produits= []; // On mets une table pour pouvoir lire l'ensemble des familles de notre table
                foreach(  $bddProduits as $produit){
                    $produits[]  = new produit(
                                                    $produit['idProduit'],
                                                    $produit['idFamille'],
                                                    $produit['nomProduit'],
                                                    $produit['marque'],
                                                    $produit['pa'],
                                                    $produit['image']
                                                    
                                                );
                }
            
            return  $produits;
            
            }

       
        // Cette fonction sert à inserer les données de la table produits
             
        public function insert($idFamille,$nomProduit,$marque,$pa,$image){
            $sql  = " INSERT INTO produits (idFamille,nomProduit,marque,pa,image) VALUES (:idFamille,:nomProduit,:marque,:pa,:image)";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
            ':idFamille'=>$idFamille,
            ':nomProduit'=>$nomProduit,
            ':marque'=>$marque,
            ':pa'=>$pa,
            ':image'=>$image
            
            ]);
        }

         // Cette fonction nous sert é supprimer une filière par rapport à son id
         public function delete($idProduit){
            $sql  = "DELETE FROM produits where idProduit=:idProduit ";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
    
                ':idProduit'=> $idProduit
               
                ]);

        }
     // Cette fonction nous sert à modifier les champs du produit
     public function update($produit){
        $sql  = " UPDATE produits SET idFamille=:idFamille,nomProduit=:nomProduit,marque =:marque,pa =:pa,image=:image where idProduit=:idProduit";
        $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
    
        $req->execute([
            ':idProduit'=>$produit->getIdProduit(),
            ':idFamille'=>$produit->getIdFamille(),
            ':nomProduit'=>$produit->getNomProduit(),
            ':marque'=>$produit->getMarque(),
            ':pa'=>$produit->getPa(),
            ':image'=>$produit->getImage()
             
            ]);

        }

          /* Cette fonction Search met sert a recherché un produit en fonction de idProduit et me serait utile dans
             Dans la fonction update */


          /* Cette fonction Search met sert a recherché une famille en fonction de idFamille et me serait utile dans
             Dans la fonction update */
             public function Search($idProduit){
               
                $sql = "SELECT *FROM produits where idProduit=:idProduit"; 
                $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
                $req->execute([
                    ':idProduit'=>$idProduit
                ]);
                $bddProduit = $req ->fetchAll();
                foreach($bddProduit as $prdt){
                        $produit = new produit( // on récupère l'ensemble des données d'une filière par rapport à son id
                                                        $prdt['idProduit'],
                                                        $prdt['idFamille'],
                                                        $prdt['nomProduit'],
                                                        $prdt['marque'],
                                                        $prdt['pa'],
                                                        $prdt['image']
                                                        
                                                      );
                    }
               return $produit;

            }


      // cette fonction me permet de rechercher le produit en fonction de sa marque
      public function SearchProduit($marque){
        $sql ="SELECT *FROM produits where marque like '%$marque%' ";  
        $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
        $req->execute();
        $bddProduit = $req ->fetchAll();
        $produits = [];
            foreach($bddProduit as $prdt){
                $produits[]  = new produit(                        
                                            $prdt['idProduit'],
                                            $prdt['idFamille'],
                                            $prdt['nomProduit'],
                                            $prdt['marque'],
                                            $prdt['pa'],
                                            $prdt['image']
                                            );
            }
        
    return $produits;
    }        


    public function countProduit(){
        $sql  = " SELECT COUNT(*) FROM produits ";
        $req =$this->connexion->query($sql); 
        $nombreProduit = $req ->fetchColumn();
        return $nombreProduit;
        
        }



 }