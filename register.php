<?php

include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader);
spl_autoload_register(function ($class_name) {
        include $class_name . '.php';
    });


$db = new BddUsers;

$error = ""; 


         
if(isset($_POST['submit'])){
          $name = htmlspecialchars(trim($_POST['name'])); // htmlspecialchars elle permet de sécurise le contenu de notre variable
          $job = htmlspecialchars(trim($_POST['job']));
          $email = htmlspecialchars(trim($_POST['email'])); //  trim enleve les espaces ou caractere debut et de fin de notre variable
          $password =sha1(htmlspecialchars(trim($_POST['password']))); // elle masque notre mot de passe 
          $password_confirmation =sha1(htmlspecialchars(trim($_POST['password_confirmation'])));
          // on va tester si l'email est deja utilisé dans la table users  grâce à la fontion email_taken du fichier register.func.php
         // si elle est egal ou superieur alors est deja utilisé
          if($db->email_taken($email)==1){   
                    $error = "L'adresse email est déja utilisé.....";
         
            } elseif ($password != $password_confirmation) {
                    
                  $error = "Les deux mots de passes ne sont pas identiques.....";
         
        
            }else{

              $db->register($name,$job,$email,$password);  // cette fonction register se trouve dans connexion elle sert inserer les données dans notre table "users"

            $_SESSION['gestiondecommerce']= $email;
               header("Location:login.php");
            
          }
        }



        echo $twig-> render('pages/register.html.twig',[
          'error'=> $error
      
      ] );

