<?php


include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader);
spl_autoload_register(function ($class_name) {
        include $class_name . '.php';
    });
        
              
        session_start();  
        
        if( !isset( $_SESSION['gestiondecommerce'])){
                header('location:login.php');
                exit;
        }     
        if(isset($_GET['nom'])) {       //une autre maniere de coder $nom=isset($_GET['nom'])? $_GET['nom']:"";

        $nom = $_GET['nom'];          
        } else{

        $nom="";
        }



    
$bddClient= new BddClient();
echo $twig-> render('pagesClients/clients.html.twig', [  
'clients'=> $bddClient ->read(), 
'clients'=> $bddClient ->SearchClient($nom)



]);
