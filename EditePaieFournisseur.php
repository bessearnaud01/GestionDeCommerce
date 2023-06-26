
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


        $bddPaiementFournisseur= new BddPaiementFournisseur();
        
    //print_r($_POST);

    if(isset($_POST['idPaieFournisseur']) && isset($_POST['nomFournisseur']) && isset($_POST['montant']) && isset($_POST['montantRester'])  && isset($_POST['statut'])   && isset($_POST['date'])) {    
   
       $idPaieFournisseur   = $_POST['idPaieFournisseur']; 
       $nomFournisseur  = $_POST['nomFournisseur'];  
       $montant = $_POST['montant'];
       $montantRester = $_POST['montantRester'];
       $statut = $_POST['statut'];    
       $date = $_POST['date']; 
            
       $paieFournisseur =   $bddPaiementFournisseur->Search($idPaieFournisseur); 
        $paieFournisseur->setNomFournisseur($nomFournisseur);
        $paieFournisseur->setMontant($montant);
        $paieFournisseur->setMontantRester($montantRester);
        $paieFournisseur->setStatut($statut);
        $paieFournisseur->setDate($date);


        $bddPaiementFournisseur->update($paieFournisseur);
       
        header('location:paieFournisseurs.php');

    }else{
        
         $paieFournisseur =    $bddPaiementFournisseur ->Search($_GET['id']); // On recupere l'id dans l'url qui va nous servit de supprimer
        echo $twig-> render('PagepaieFournisseurs/EditePaieFournisseur.html.twig',[
            'paieFournisseur'=> $paieFournisseur
            ]);
        
        }
       
   
        

   
   
        
   
   
   
   
   
        
    
    





