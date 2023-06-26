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
        if(isset($_GET['libelle'])) {       //$nomf=isset($_GET['nomf'])? $_GET['nomf']:"";

        $libelle = $_GET['libelle'];          
        } else{

        $libelle="";
        }


    
    
$bddFamille= new BddFamille();
echo $twig-> render('pagesfamilles/familles.html.twig', [  
'familles'=> $bddFamille ->read(),  
'familles'=> $bddFamille ->SearchFamille($libelle)



]);
