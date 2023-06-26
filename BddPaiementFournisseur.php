<?php


class BddPaiementFournisseur{
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
 
            $sql  = " SELECT * FROM  paiementsfournisseurs ";
           
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddPaiementFournisseur= $req ->fetchAll();
            $PaieFournisseurs = []; 
                foreach($bddPaiementFournisseur as $PaieFournisseur){
                    $PaieFournisseurs []  = new paieFournisseur(

                     
                                                                $PaieFournisseur['idPaieFournisseur'],
                                                                $PaieFournisseur['nomFournisseur'],
                                                                $PaieFournisseur['montant'],
                                                                $PaieFournisseur['montantRester'],
                                                                $PaieFournisseur['statut'],
                                                                $PaieFournisseur['date']
                                                   
                            
                                                            );
                }
                        
            return $PaieFournisseurs;
            
            }


                           
    public function insert($nomFournisseur,$montant,$montantRester,$statut,$date){
        $sql  = " INSERT INTO paiementsfournisseurs (nomFournisseur,montant,montantRester,statut,date) VALUES (:nomFournisseur,:montant,:montantRester,:statut,:date)";
        $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
        $req->execute([
        ':nomFournisseur'=>$nomFournisseur,
        ':montant'=>$montant,
        ':montantRester'=>$montantRester,
        ':statut'=>$statut,
        ':date'=>$date
        
        ]);
    }



          
          public function delete($idPaieFournisseur){
            $sql  = "DELETE FROM paiementsfournisseurs where idPaieFournisseur=:idPaieFournisseur ";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
    
                ':idPaieFournisseur'=>$idPaieFournisseur
               
                ]);

        }



        
     // Cette fonction nous sert à modifier les champs du paieCleint
     public function update($paieFournisseur){
        $sql  = " UPDATE paiementsfournisseurs SET nomFournisseur =:nomFournisseur,montant =:montant,montantRester =:montantRester,statut=:statut,date=:date where idPaieFournisseur=:idPaieFournisseur";
        $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
        $req->execute([
           
            ':idPaieFournisseur'=>$paieFournisseur->getIdPaieFournisseur(),
            ':nomFournisseur'=>$paieFournisseur->getNomFournisseur(),
            ':montant'=>$paieFournisseur->getMontant(),
            ':montantRester'=>$paieFournisseur->getMontantRester(),
            ':statut'=>$paieFournisseur->getStatut(),
            ':date'=>$paieFournisseur->getDate()
            
            ]);

        }
                 

        

       public function Search($idPaieFournisseur){
               
            $sql = "SELECT *FROM  paiementsfournisseurs where idPaieFournisseur =:idPaieFournisseur"; 
            $req =$this->connexion->prepare($sql); 
            $req->execute([
                ':idPaieFournisseur'=>$idPaieFournisseur
            ]);
            $bddPaiementFournisseur = $req ->fetchAll();
            foreach( $bddPaiementFournisseur as $PaiementFournisseur){
                $paieFournisseur = new paieFournisseur(
                                                    $PaiementFournisseur['idPaieFournisseur'],
                                                    $PaiementFournisseur['nomFournisseur'],
                                                    $PaiementFournisseur['montant'],
                                                    $PaiementFournisseur['montantRester'],
                                                    $PaiementFournisseur['statut'],
                                                    $PaiementFournisseur['date']
                                    

                                             
                                                    
                                         );
                }
           return   $paieFournisseur  ;

        }





        public function SearchFournisseur($nomFournisseur){
            $sql ="SELECT *FROM paiementsfournisseurs where nomFournisseur like '%$nomFournisseur%' ";  
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
           
            $bddPaiementFournisseur= $req ->fetchAll();
            $PaieFournisseurs = []; 
            foreach( $bddPaiementFournisseur as $PaiementFournisseur){
                    $PaieFournisseurs[]  =  new  paieFournisseur(
                                                                $PaiementFournisseur['idPaieFournisseur'],
                                                                $PaiementFournisseur['nomFournisseur'],
                                                                $PaiementFournisseur['montant'],
                                                                $PaiementFournisseur['montantRester'],
                                                                $PaiementFournisseur['statut'],
                                                                $PaiementFournisseur['date']
        
                                                );
        }
            
        return $PaieFournisseurs;
        }        


        
            
            // La fonction elle me permet de compter le nombre de paie de fournisseurs
            public function countPaieFournisseur(){
                $sql  = " SELECT COUNT(*) FROM paiementsfournisseurs  ";
                $req =$this->connexion->query($sql); 
                $nombrePaieFournisseur = $req ->fetchColumn();
                return $nombrePaieFournisseur;
                
                }









        }        
















        


