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
        if(isset($_GET['libelle'])) {       

        $libelle = $_GET['libelle'];          
        } else{

        $libelle="";
        }


    
    
$bddFactures= new BddFactures();
echo $twig-> render('PagesFactures/Factures.html.twig', [  
'factures'=> $bddFactures->read() ,
'factures'=>$bddFactures->SearchFacture($libelle)

]);
