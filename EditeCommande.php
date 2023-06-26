
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
    $bddCommande= new BddCommande();

    if( isset($_POST['idCommande']) && isset($_POST['idProduit']) && isset($_POST['nomClient'])  && isset($_POST['nomProduit'])  && isset($_POST['prixUnitaire']) && isset($_POST['quantite'])  && isset($_POST['date'])) {    
      
      
        $idCommande  = $_POST['idCommande'];
        $idProduit  = $_POST['idProduit'];
        $nomClient = $_POST['nomClient']; 
        $nomProduit = $_POST['nomProduit'];  
        $prixUnitaire = $_POST['prixUnitaire']; 
        $quantite = $_POST['quantite'];  
        $date = $_POST['date']; 
       

        $commande = $bddCommande->Search($idCommande);       
        $commande->setIdProduit($idProduit);
        $commande->setNomClient($nomClient);
        $commande->setNomProduit($nomProduit);
        $commande->setQuantite($quantite);
        $commande->setPrixUnitaire($prixUnitaire);
        $commande->setDate($date);


        $bddCommande->update($commande);
        header('location:commandes.php');

    }else{
        // Si j'ai rien posté elle m'affiche que le fichier Editer.client.html.twig
        $commande = $bddCommande->Search($_GET['id']); // On recupere l'id dans l'url qui va nous servit de supprimer
        echo $twig-> render('CommandesPages/EditeCommande.html.twig',[
            'commande'=>$commande // Elle la valeur que contient l'url que la variable $filière recupère
        
            ]);
        
        }
       
   
   
   
   
   
   
   
   
   
        
    
    





