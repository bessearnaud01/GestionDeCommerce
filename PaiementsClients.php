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


    if(isset($_GET['nomClient'])) {      
        $nomClient = $_GET['nomClient'];          
        }else{
        $nomClient="";
        }


    $bddPaiementClient = new BddPaiementClient();
   

echo $twig-> render('PagesPaiementsClients/PaiementsClients.html.twig', [ 


    'PaiementsClients'=>$bddPaiementClient->read(),
    'PaiementsClients'=>$bddPaiementClient->SearchPaieClient($nomClient)
    
    
]);
