
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
    
    
    
    $bddFamille= new BddFamille();
  

    if(isset($_POST['libelle']) && isset($_POST['idFamille'])){
        $idFamille= $_POST['idFamille']; 
        $libelle = $_POST['libelle'];  

        $famille = $bddFamille->Search($idFamille);
        $famille->setLibelle($libelle);
        
        $bddFamille ->update($famille);
        header('location:familles.php');
    }else{
        
        $famille = $bddFamille->Search($_GET['id']); // On recupere l'id dans l'url qui va nous servit de supprimer
        echo $twig->render('pagesFamilles/EditerFamille.html.twig', [ 
            'famille'=>$famille // Elle la valeur que contient l'url que la variable $filière recupère
        
            ]);
        
        }
   
   
   
   
   
   
   
   
   
   
        
    
    






