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
        
    if(isset($_GET['libelle'])) {       //une autre maniere de coder $nom=isset($_GET['nom'])? $_GET['nom']:"";

        $libelle = $_GET['libelle'];          
        } else{

        $libelle="";
        }

    
    $bddStockesEntrees= new BddStockesEntrees();
    

echo $twig-> render('PagesEntrees/EntreesStockes.html.twig', [  
    'StockesEntrees'=>$bddStockesEntrees ->read(),
    'StockesEntrees'=>$bddStockesEntrees -> SearchStocke($libelle)

]);
