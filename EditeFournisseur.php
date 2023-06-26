
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


    $bddFournisseur= new BddFournisseur();
    
        
if( isset($_POST['idFournisseur']) && isset($_POST['idProduit']) && isset($_POST['entreprise'])  && isset($_POST['telephone']) && isset($_POST['email']) && isset($_POST['adresse'])) {    
       
       
        $idFournisseur  = $_POST['idFournisseur'];
        $idProduit  = $_POST['idProduit'];
        $entreprise = $_POST['entreprise'];   
        $telephone = $_POST['telephone']; 
        $email = $_POST['email'];
        $adresse = $_POST['adresse']; 
         
        
        $fournisseur = $bddFournisseur->Search($idFournisseur);       
        $fournisseur->setIdProduit($idProduit);
        $fournisseur->setEntreprise($entreprise);
        $fournisseur->setTelephone($telephone);
        $fournisseur->setEmail($email);
        $fournisseur->setAdresse($adresse);
      

        $bddFournisseur->update($fournisseur);
        
        header('location:fournisseurs.php');

    }else{
        // Si j'ai rien posté elle m'affiche que le fichier Editer.fournisseur.html.twig
        $fournisseur= $bddFournisseur->Search($_GET['id']); // On recupere l'id dans l'url qui va nous servit de supprimer
        echo $twig->render('pagesFournisseurs/EditeFournisseur.html.twig', [ 
            'fournisseur'=>$fournisseur // Elle la valeur que contient l'url que la variable $filière recupère
        
            ]);
        
        }
   
   
   
   
   
   
   
   
   
   
        
    
    






