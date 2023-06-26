
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
        
    if( isset($_POST['sexe']) && isset($_POST['nom'])  && isset($_POST['prenom'])  && isset($_POST['telephone']) && isset($_POST['email']) && isset($_POST['adresse'])) {    
        $sexe  = $_POST['sexe'];
        $nom = $_POST['nom'];  
        $prenom = $_POST['prenom'];  
        $telephone = $_POST['telephone']; 
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];  
     
        $bddClient = new BddClient();
        $bddClient->insert($sexe,$nom,$prenom,$telephone,$email,$adresse);
        header('location:clients.php');
}else{
       echo $twig-> render('pagesClients/AjouterClient.html.twig');

}
    


    
        
    
 







