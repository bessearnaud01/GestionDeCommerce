<?php


class BddFamille{
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
 
            $sql  = " SELECT * FROM familles";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddFamiles = $req ->fetchAll();
            $familles= []; // On mets une table pour pouvoir lire l'ensemble des familles de notre table
                foreach(  $bddFamiles as $famille){
                    $familles[]  = new famille(
                                                    $famille['idFamille'],
                                                    $famille['libelle']
                                                    
                                                );
                }
            
            return  $familles;
            
            }

        // cette fonction me permet des famille en fonction en fonction de leurs nom
        public function SearchFamille($libelle){
            $sql ="SELECT *FROM familles where libelle like '%$libelle%' ";  
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddFamiles = $req ->fetchAll();
            $familles = [];
                foreach($bddFamiles as $fmlle){
                    $familles[]  = new famille(                        
                                                $fmlle['idFamille'],
                                                $fmlle['libelle']
                                                );
                }
            
        return $familles;
        }    
        // Cette fonction sert à inserer les données del la famille dans la table familles
             
        public function insert($libelle){
            $sql  = " INSERT INTO familles (libelle) VALUES (:libelle)";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
            ':libelle'=>$libelle
            
            ]);
        }

           
             // Cette fonction nous sert à modifier les champs de la famille
             public function update($famille){
                $sql  = " UPDATE familles SET libelle =:libelle where idFamille=:idFamille";
                $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
                $req->execute([
                    ':idFamille'=> $famille->getIdFamille(),
                    ':libelle'=> $famille->getLibelle()
                   
                    ]);

                }


            /* Cette fonction Search met sert a recherché une famille en fonction de idFamille et me serait utile dans
             Dans la fonction update */
            public function Search($idFamille){
               
                $sql = "SELECT *FROM familles where idFamille=:idFamille"; 
                $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
                $req->execute([
                    ':idFamille'=>$idFamille
                ]);
                $bddFamille = $req ->fetchAll();
                foreach($bddFamille as $fmlle){
                        $famille = new famille( // on récupère l'ensemble des données d'une filière par rapport à son id
                                                        $fmlle['idFamille'],
                                                        $fmlle['libelle']
                                                        
                                                      );
                    }
                
               return $famille;

            }

            // Cette fonction nous sert é supprimer une filière par rapport à son id
            public function delete($idFamille){
                $sql  = "DELETE FROM familles where idFamille=:idFamille ";
                $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
                $req->execute([
        
                    ':idFamille'=> $idFamille
                   
                    ]);

            }



            // La fonction elle me permet de compter le nombre famille des produits
            public function countFamille(){
                $sql  = " SELECT COUNT(*) FROM familles ";
                $req =$this->connexion->query($sql); 
                $nombreFamille = $req ->fetchColumn();
                return  $nombreFamille;
                
                }




 }