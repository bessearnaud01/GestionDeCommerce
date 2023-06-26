
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
   
    $bddPaiementClient = new BddPaiementClient();
   
   

    if(isset($_POST['idPaieClient']) && isset($_POST['nomClient']) && isset($_POST['montant'])  && isset($_POST['montantRester']) && isset($_POST['statut']) && isset($_POST['date'])) {    
   
       $idPaieClient   = $_POST['idPaieClient']; 
       $nomClient  = $_POST['nomClient'];  
       $montant = $_POST['montant']; 
       $montantRester = $_POST['montantRester'];
       $statut = $_POST['statut'];    
       $date = $_POST['date']; 
            
        $paieClient = $bddPaiementClient->Search($idPaieClient); 
        
        $paieClient->setNomClient($nomClient);
        $paieClient->setMontant($montant);
        $paieClient->setMontantRester($montantRester);
        $paieClient->setStatut($statut);
        $paieClient->setDate($date);


        $bddPaiementClient->update($paieClient);
       
        header('location:PaiementsClients.php');

    }else{
        // Si j'ai rien posté elle m'affiche que le fichier Editer.paieClient.php
        $paieClient =   $bddPaiementClient ->Search($_GET['id']); // On recupere l'id dans l'url qui va nous servit de supprimer
        echo $twig-> render('PagesPaiementsClients/EditePaieClient.html.twig',[
            'paieClient'=>$paieClient
             // Elle la valeur que contient l'url que la variable $paie recupère
        
            ]);
        
        }
       
   
        

   
   
        
   
   
   
   
   
        
    
    





