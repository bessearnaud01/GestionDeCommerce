
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


    $bddClient= new BddClient();

    if( isset($_POST['idClient']) && isset($_POST['sexe']) && isset($_POST['nom']) &&  isset($_POST['prenom'])  && isset($_POST['telephone'])  && isset($_POST['email']) && isset($_POST['adresse'])) {    
         
        $idClient= $_POST['idClient']; 
        $sexe = $_POST['sexe']; 
        $nom   = $_POST['nom'];  
        $prenom = $_POST['prenom']; 
        $telephone = $_POST['telephone'];  
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
         

        $client = $bddClient->Search($idClient);       
        $client->setSexe($sexe);
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setTelephone($telephone);
        $client->setEmail($email);
        $client->setAdresse($adresse);

        $bddClient->update($client);
        
        header('location:clients.php');

    }else{
        // Si j'ai rien posté elle m'affiche que le fichier Editer.client.html.twig
        $client = $bddClient->Search($_GET['id']); // On recupere l'id dans l'url qui va nous servit de supprimer
        echo $twig->render('pagesClients/EditerClient.html.twig', [ 
            'client'=>$client // Elle la valeur que contient l'url que la variable $filière recupère
        
            ]);
        
        }
   
   
   
   
   
   
   
   
   
   
        
    
    






