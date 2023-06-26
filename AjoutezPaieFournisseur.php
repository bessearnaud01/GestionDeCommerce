
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
     


    if(isset($_POST['nomFournisseur']) && isset($_POST['montant']) && isset($_POST['montantRester']) && isset($_POST['statut']) && isset($_POST['date'])) {    
   
       
        $nomFournisseur  = $_POST['nomFournisseur'];  
        $montant = $_POST['montant']; 
        $montantRester = $_POST['montantRester']; 
        $statut = $_POST['statut']; 
        $date = $_POST['date']; 


        $bddPaiementFournissseur = new BddPaiementFournisseur();
        $bddPaiementFournissseur->insert($nomFournisseur,$montant,$montantRester,$statut ,$date);
        header('location:paieFournisseurs.php');


    }else{
        echo $twig->render('PagePaieFournisseurs/AjoutezPaieFournisseur.html.twig');
    
    }










   


    


    
        
    
 








