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
        
    if(isset($_GET['nomFournisseur'])) {       //une autre maniere de coder $nom=isset($_GET['nom'])? $_GET['nom']:"";

        $nomFournisseur = $_GET['nomFournisseur'];          
        } else{

        $nomFournisseur="";
        }

    
        $bddPaiementFournisseur  = new BddPaiementFournisseur();

echo $twig->render('PagepaieFournisseurs/paieFournisseurs.html.twig', [  
    'PaieFournisseurs'=>$bddPaiementFournisseur->read(),
   'PaieFournisseurs'=>$bddPaiementFournisseur->SearchFournisseur($nomFournisseur)     
]);
