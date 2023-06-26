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

    $send = 0;

    if (isset($_GET['send'])){
        
        $send = $_GET['send'];
      
    }





              
echo $twig-> render('pagesMails/SendMails.html.twig', [  
    
    'send'=>$send
]);
