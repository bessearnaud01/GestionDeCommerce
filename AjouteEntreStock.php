
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
        

    
    if( isset($_POST['idFournisseur']) && isset($_POST['libelle']) && isset($_POST['prixUnitaire']) && isset($_POST['quantite'])   && isset($_POST['date'])) {    
        $idFournisseur = $_POST['idFournisseur'];
        $libelle = $_POST['libelle']; 
        $prixUnitaire = $_POST['prixUnitaire'];  
        $quantite = $_POST['quantite'];  
        $date = $_POST['date']; 
       
        $bddStockesEntrees= new BddStockesEntrees ();

        $bddStockesEntrees->insert($idFournisseur,$libelle,$prixUnitaire,$quantite,$date);
       header('location:EntreesStockes.php');
}else{
       echo  $twig-> render('PagesEntrees/AjouteEntreStock.html.twig');
}
    


    
        
    
 







