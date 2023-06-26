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
        
         $idPaieFournisseur = $_GET['id'];
        $bddFournisseur= new BddPaiementFournisseur();
        $bddFournisseur->delete($idPaieFournisseur );
        header('location:paieFournisseurs.php');

    