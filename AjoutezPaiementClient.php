
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
     


    if(isset($_POST['nomClient'])  && isset($_POST['montant'])   && isset($_POST['montantRester']) && isset($_POST['statut'])  && isset($_POST['date'])) {    
   
       
        $nomClient  = $_POST['nomClient'];  
       
        $montant = $_POST['montant'];  
        $montantRester = $_POST['montantRester']; 
        $statut = $_POST['statut'];  
        $date = $_POST['date']; 


        $bddPaiementClient = new BddPaiementClient();
        $bddPaiementClient->insert($nomClient,$montant,$montantRester,$statut ,$date);
        header('location:PaiementsClients.php');


    }else{
        echo $twig->render('PagesPaiementsClients/AjoutezPaiementClient.html.twig');
    
    }










   


    


    
        
    
 







