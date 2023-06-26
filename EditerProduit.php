
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


    $bddProduit= new BddProduit();




    if( isset($_POST['idProduit'])  && isset($_POST['idFamille']) && isset($_POST['nomProduit']) && isset($_POST['marque']) && isset($_POST['pa'])) {    
    
        $idProduit= $_POST['idProduit']; 
        $idFamille = $_POST['idFamille'];
        $nomProduit = $_POST['nomProduit']; 
        $marque   = $_POST['marque'];  
        $pa = $_POST['pa'];  

        $produit = $bddProduit->Search($idProduit);
        $produit->setIdFamille($idFamille);
        $produit->setNomProduit($nomProduit);
        $produit->setMarque($marque);
        $produit->setPa($pa);
       
        if(isset($_FILES['image']) && !$_FILES['image']['error'])  {
            $date = new DateTime('NOW');
            $image= $date->format('Y-m-H').$_FILES['image']['name'];
            $produit->setImage($image);
           move_uploaded_file($_FILES['image']['tmp_name'],'photos/'.$image);
           
       }


        $bddProduit->update($produit);

      
      header('location:produits.php');

    }else{
        // Si j'ai rien posté elle m'affiche que le fichier Editer.produit.html.twig
        $produit = $bddProduit->Search($_GET['id']); // On recupere l'id dans l'url qui va nous servit de supprimer
        echo $twig->render('pagesProduits/EditerProduit.html.twig', [ 
            'produit'=>$produit // Elle la valeur que contient l'url que la variable $filière recupère
        
            ]);
        
        }
   
   
   
   
   
   
   
   
   
   
        
    
    






