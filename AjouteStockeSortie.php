
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
        print_r($_POST);
   
    
    if( isset($_POST['idClient']) && isset($_POST['libelle']) && isset($_POST['prixUnitaire']) && isset($_POST['quantite'])   && isset($_POST['date'])) {    
        $idClient = $_POST['idClient'];
        $libelle = $_POST['libelle']; 
        $prixUnitaire = $_POST['prixUnitaire'];  
        $quantite = $_POST['quantite'];  
        $date = $_POST['date']; 
       
        $bddSortieStocks = new BddSortieStocks ();

        $bddSortieStocks->insert($idClient,$libelle,$prixUnitaire,$quantite,$date);
       header('location:SortieStocks.php');
}else{
       echo  $twig-> render('PagesSorties/AjouteStockSortie.html.twig');
}
    


    
        
    
 







