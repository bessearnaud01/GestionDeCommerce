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
        
        $idFamille = $_GET['id'];
        $bddFamille = new BddFamille();
        $bddFamille ->delete($idFamille);
        header('location:familles.php');

    