<?php

include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader);
spl_autoload_register(function ($class_name) {
        include $class_name . '.php';
    });
    
    session_start();  // elle sert a mettre notre login avant d'entrer sur la page client sinon elle nous ramene à la page login.php
    
    if( !isset( $_SESSION['gestiondecommerce'])){
        header('location:login.php');
        exit;
    }
           

    if(isset($_GET['nomClient'])) {       //une autre maniere de coder $nomClient=isset($_GET['nomClient'])? $_GET['nomClient']:"";

        $nomClient = $_GET['nomClient'];          
       } else{

       $nomClient="";
       }



    $bddCommande= new BddCommande();
    
echo $twig-> render('CommandesPages/commandes.html.twig', [ 
    'commandes'=>$bddCommande ->read(),
    'commandes'=>$bddCommande ->SearchCommande($nomClient)
    

]);
