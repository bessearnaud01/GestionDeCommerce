<?php

include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader);

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});



$db = new BddUsers;

$error_user_not_found=""; 

if(isset($_POST['submit'])){
    // htmlspecialchars elle permet de sécurise le contenu de notre variable
    $email = htmlspecialchars(trim($_POST['email'])); //  trim enleve les espaces ou caractere debut et de fin de notre variable
    $password =sha1(htmlspecialchars(trim($_POST['password']))) ; // elle masque notre mot de passe 
    
   // si la fonction est égale user_exist == 1 alors l'utilisateur existe sinon elle n'existe pas
    if($db->user_exist($email,$password)==1){  
      session_start();
      $_SESSION['gestiondecommerce']= $email; //lorsque l'utilisateur existe la session recupere l'email dans l'url
      header("location: home.php");
    }else{
      $error_user_not_found = "L'adresse email ou le mot de passe est incorrecte...."; 
      
    }
}



echo $twig-> render('pages/login.html.twig',[
    'error_user_not_found'=> $error_user_not_found

] );



?>