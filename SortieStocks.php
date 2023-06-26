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

    
        $bddSortieStocks = new BddSortieStocks();

echo $twig-> render('PagesSorties/SortieStocks.html.twig', [  
    'StockesSorties'=>$bddSortieStocks->read(),
    'StockesSorties'=>$bddSortieStocks->SearchStocke($libelle)
]);
