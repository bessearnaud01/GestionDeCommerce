
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
        

    if( isset($_POST['nomClient']) && isset($_POST['libelle']) && isset($_POST['nomProduit']) && isset($_POST['prixUnitaire']) && isset($_POST['quantite'])   && isset($_POST['date'])) {    
                  
                    $nomClient = $_POST['nomClient'];
                     $nomProduit = $_POST['nomProduit']; 
                    $libelle = $_POST['libelle']; 
                    $prixUnitaire = $_POST['prixUnitaire'];  
                    $quantite = $_POST['quantite'];  
                    $date = $_POST['date']; 
                   
                    $bddFacture= new BddFactures ();
            
                    $bddFacture->insert($nomClient,$nomProduit,$libelle,$prixUnitaire,$quantite,$date);
                    header('location:Factures.php');
            }else{
                    echo $twig-> render('PagesFactures/AjouteFacture.html.twig');
            }
                
            
            
                

    
        
    
 







