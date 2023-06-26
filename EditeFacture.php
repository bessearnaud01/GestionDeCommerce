
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
  

    
    $bddFactures= new BddFactures();

    
  

    if( isset($_POST['idFacture']) && isset($_POST['nomClient']) && isset($_POST['nomProduit']) && isset($_POST['libelle'])  && isset($_POST['prixUnitaire']) && isset($_POST['quantite'])  && isset($_POST['date'])) {    
      
        $idFacture  = $_POST['idFacture'];
         $nomProduit  = $_POST['nomProduit'];
        $nomClient  = $_POST['nomClient'];
        $libelle = $_POST['libelle'];  
        $prixUnitaire = $_POST['prixUnitaire']; 
        $quantite = $_POST['quantite'];  
        $date = $_POST['date']; 
       
 
        $facture = $bddFactures->Search($idFacture);   
        
        $facture->setNomClient($nomClient);
       $facture->setNomProduit($nomProduit);
        $facture->setlibelle($libelle);
        $facture->setQuantite($quantite);
        $facture->setPrixUnitaire($prixUnitaire);
        $facture->setDate($date);

        
        $bddFactures->update($facture);
        header('location:factures.php');

    }else{
       
        $facture = $bddFactures->Search($_GET['id']); // On recupere l'id dans l'url qui va nous servit de supprimer
        echo $twig-> render('PagesFactures/EditeFacture.html.twig', [  
            'facture'=>$facture // Elle la valeur que contient l'url que la variable $facture recupère
        
            ]);
        
        }
       
   
   
   
   
   
   
   
   
   
        
    
    





