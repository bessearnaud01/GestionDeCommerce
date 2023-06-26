<?php

include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader);
spl_autoload_register(function ($class_name) {
        include $class_name . '.php';
    });
    

    session_start();  // elle sert a mettre notre login avant d'entrer sur la page fournisseur sinon elle nous ramene à la page login.php
    
    if( !isset( $_SESSION['gestiondecommerce'])){
        header('location:login.php');
        exit;
    }

    if(isset($_GET['entreprise'])) {       //une autre maniere de coder $entreorise=isset($_GET['nomf'])? $_GET['nom']:"";

        $entreprise = $_GET['entreprise'];          
        } else{

        $entreprise="";
        }

        
    $bddFournisseur = new BddFournisseur();              
echo $twig-> render('pagesFournisseurs/fournisseurs.html.twig', [  
    'fournisseurs'=> $bddFournisseur->read(), 
    'fournisseurs'=> $bddFournisseur->SearchFournisseur($entreprise)
    
    
    
    
    
]);
