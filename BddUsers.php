<?php

/*cette classe represente notre classe users, elle sert à la connexion de notre base 
de données et aux fonctions qui vont servit d'effectuer certaines tâches à notre table users*/
class BddUsers{
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
     
   // cette fonction sert à tester si le émail saisit dans formulaire d'inscription a ete deja utlisé
        public function email_taken($email){
            $e = array('email' => $email);
            $sql = 'SELECT * FROM users WHERE email = :email';// on cherche à comparer si l émail saisir par l'utlisateur est deja utilisé 
            $req = $this->connexion->prepare($sql);
            $req->execute($e);
            $free = $req->rowCount($sql); // Elle permet de compter le nombre émail  de la même variable utilisé dans notre table users

            return $free;
        }
            // cette fonction a pour rôle d'inserer les données des utilisateurs 
        public function register($name,$job, $email, $password){   

            $r = array(
                'name'=>$name,
                'job'=>$job,
                'email'=>$email,
                'password'=>password_hash($password, PASSWORD_DEFAULT),
            );
            $sql = "INSERT INTO users(name,job,email,password) VALUES(:name,:job,:email,:password)";
            $req = $this->connexion->prepare($sql);
            $req->execute($r);
            
        }

 
           public function user_exist($email,$password){   

            $sql = "SELECT * FROM users WHERE email=:email";
            $req =$this->connexion->prepare($sql); 
            $req->execute([
                ':email'=>$email,
                
            ]);
           $bddUser = $req ->fetch(); // fetch elle lit que un tableau 
           $motdepasse = $bddUser['password'];
           // print_r($bddUser);
            if (password_verify($password,$motdepasse)) {
               return true;
            } else {
             return false;
             //  print_r($bddUser);
            }
            
          


 
           
         
    }

};

 
      
    
 

