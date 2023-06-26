<?php


class BddClient{
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
     
        // Cette fonction permet de lire le contenu de la table du client
        public function read(){
 
            $sql  = " SELECT * FROM clients";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddClients = $req ->fetchAll();
            $clients= []; // On mets une table pour pouvoir lire l'ensemble des clients de notre table
                foreach(  $bddClients as $client){
                    
                    $clients[]  = new client(
                                                    $client['idClient'],
                                                    $client['sexe'],
                                                    $client['nom'],
                                                    $client['prenom'],
                                                    $client['telephone'],
                                                    $client['email'],
                                                    $client['adresse']
                                                    
                                                );
                }
            
            return$clients;
            
            }

       
        
         
     // Cette fonction nous sert à modifier les champs du client
     public function update($client){
        $sql  = "UPDATE clients SET sexe=:sexe,nom=:nom,prenom=:prenom,telephone=:telephone,email=:email,adresse=:adresse where idClient=:idClient";
        $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
        $req->execute([
            ':idClient'=>$client->getIdClient(),
            ':sexe'=>$client->getSexe(),
            ':nom'=>$client->getNom(),
            ':prenom'=>$client->getPrenom(),
            ':telephone'=>$client->getTelephone(),
            ':email'=>$client->getEmail(),
            ':adresse'=>$client->getAdresse()

            
            ]);
    
                
        }

 /* Cette fonction Search met sert a recherche du client en fonction de idClient et me serait utile dans
 Dans la fonction update */

            
             public function Search($idClient){
               
                $sql = "SELECT *FROM clients where idClient=:idClient"; 
                $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
                $req->execute([
                    ':idClient'=>$idClient
                ]);
                $bddClient = $req ->fetchAll();
                foreach($bddClient as $clt){
                        $client = new client(  $clt['idClient'],
                                                $clt['sexe'],
                                                $clt['nom'],
                                                $clt['prenom'],
                                                $clt['telephone'],
                                                $clt['email'],
                                                $clt['adresse']   
                                                        
                                             );
                    }
               return $client;

            }

            
 // Cette fonction nous sert à supprimer un client par rapport à son idClient
 public function delete($idClient){
    $sql  = "DELETE FROM clients WHERE idClient=:idClient";
    $req =$this->connexion->prepare($sql); 
    $req->execute([
        ':idClient'=> $idClient
       
        ]);
       // print_r($req->errorInfo());
}


       


             
        // Cette fonction sert à inserer les données de la table clients 
             
        public function insert($sexe,$nom ,$prenom,$telephone,$email,$adresse){
            $sql  = " INSERT INTO clients (sexe,nom,prenom,telephone,email,adresse) VALUES (:sexe,:nom,:prenom,:telephone,:email,:adresse)";
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute([
                
                ':sexe'=>$sexe,
                ':nom'=>$nom,
                ':prenom'=>$prenom,
                ':telephone'=>$telephone,
                ':email'=>$email,
                ':adresse'=>$adresse
            ]);
        }



        public function SearchClient($nom){
            $sql ="SELECT *FROM clients where nom like '%$nom%' ";  
            $req =$this->connexion->prepare($sql); // elle se connecte à ma base de données
            $req->execute();
            $bddClient = $req ->fetchAll();
            $clients = [];
                foreach($bddClient as $clt){
                                $clients[]  = new client(        
                                            $clt['idClient'],
                                            $clt['sexe'],
                                            $clt['nom'],
                                            $clt['prenom'],
                                            $clt['telephone'],
                                            $clt['email'],
                                            $clt['adresse']                 
                                    
                                );
        }
            
        return $clients;
        }        


   // Elle compte le nombre de clients
             
        public function countClient(){
            $sql  = " SELECT COUNT(*) FROM clients ";
            $req =$this->connexion->query($sql); 
            $nombreClient = $req ->fetchColumn();
            return  $nombreClient;
            
            }





 }





