
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

    
    if(isset($_POST['idFamille']) && isset($_POST['nomProduit'])  && isset($_POST['marque']) && isset($_POST['pa'])  && isset($_FILES['image']['name'])) {    
   
    $idFamille = $_POST['idFamille'];
    $nomProduit = $_POST['nomProduit'];
    $marque   = $_POST['marque'];  
    $pa = $_POST['pa'];  
    $date = new DateTime('NOW');
    $image= $date->format('Y-m-H').$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],'photos/'.$image);
           

    $bddProduit = new BddProduit();
    $bddProduit->insert($idFamille,$nomProduit,$marque,$pa,$image);
    header('location:produits.php');
}else{
    echo $twig-> render('pagesProduits/AjouteProduit.html.twig');

}
    


    
        
    
 







