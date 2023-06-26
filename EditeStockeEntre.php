
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
   
    $bddStockesEntrees= new BddStockesEntrees ();

   

    if( isset($_POST['idStocke']) && isset($_POST['idFournisseur']) && isset($_POST['libelle'])  && isset($_POST['prixUnitaire']) && isset($_POST['quantite'])  && isset($_POST['date'])) {    
      
      
        $idStocke  = $_POST['idStocke'];
        $idFournisseur  = $_POST['idFournisseur'];
        $libelle = $_POST['libelle'];  
        $prixUnitaire = $_POST['prixUnitaire']; 
        $quantite = $_POST['quantite'];  
        $date = $_POST['date']; 
       

        $stocke=  $bddStockesEntrees->Search($idStocke); 
        $stocke->setIdFournisseur($idFournisseur);      
        $stocke->setLibelle($libelle);
        $stocke->setQuantite($quantite);
        $stocke->setPrixUnitaire($prixUnitaire);
        $stocke->setDate($date);


        $bddStockesEntrees->update($stocke);
        header('location:EntreesStockes.php');

    }else{
        // Si j'ai rien posté elle m'affiche que le fichier Editer.stockEntre.html.twig
        $stocke =  $bddStockesEntrees->Search($_GET['id']); // On recupere l'id dans l'url qui va nous servit de supprimer
        echo $twig-> render('PagesEntrees/EditeStockesEntrees.html.twig',[
            'stocke'=>$stocke
             // Elle la valeur que contient l'url que la variable $filière recupère
        
            ]);
        
        }
       
   
   
   
   
   
   
   
   
   
        
    
    





