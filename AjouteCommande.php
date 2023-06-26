
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
        
    if( isset($_POST['idProduit']) && isset($_POST['nomClient']) && isset($_POST['nomProduit']) && isset($_POST['prixUnitaire']) && isset($_POST['quantite'])   && isset($_POST['date'])) {    
        $idProduit  = $_POST['idProduit'];
        $nomClient = $_POST['nomClient'];
        $nomProduit = $_POST['nomProduit']; 
        $prixUnitaire = $_POST['prixUnitaire'];  
        $quantite = $_POST['quantite'];  
        $date = $_POST['date']; 
       
        $bddCommmande = new BddCommande();
        $bddCommmande->insert($idProduit,$nomClient,$nomProduit,$prixUnitaire,$quantite,$date);
        header('location:commandes.php');
}else{
       echo $twig-> render('CommandesPages/AjouteCommande.html.twig');

}
    


    
        
    
 







