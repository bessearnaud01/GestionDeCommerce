
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
        
if(isset($_POST['libelle'])) {       
    $libelle = $_POST['libelle'];         
    $bddFamille = new BddFamille();
    $bddFamille ->insert($libelle);

    header('location:familles.php');
}else{
    echo $twig-> render('pagesfamilles/AjouteFamille.html.twig');

}
    


    
        
    
 







