
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
        
    if( isset($_POST['idProduit']) && isset($_POST['entreprise'])  && isset($_POST['telephone']) && isset($_POST['email']) && isset($_POST['adresse'])) {    
        $idProduit  = $_POST['idProduit'];
        $entreprise = $_POST['entreprise'];   
        $telephone = $_POST['telephone']; 
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];  
        
        $bddFournisseur = new BddFournisseur();
        $bddFournisseur->insert($idProduit,$entreprise,$telephone,$email,$adresse);
       header('location:fournisseurs.php');
}else{
       echo $twig-> render('pagesFournisseurs/AjouteFournisseur.html.twig');

}
    






