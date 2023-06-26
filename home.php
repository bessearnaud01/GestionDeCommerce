<?php

include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader);
spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});



session_start();

	if(!isset($_SESSION['gestiondecommerce']))
	{
        header("Location:login.php");
       
    }else{
     

      $bddFamille = new BddFamille();
      $bddCommande = new BddCommande();
      $bddProduit = new BddProduit();
      $bddClient  = new BddClient();
      $bddFournisseur  = new BddFournisseur();
      $bddStockesSorties= new BddSortieStocks();
      $bddStockesEntrees= new BddStockesEntrees();
      $bddPaieClient   = new BddPaiementClient();
     $bddPaieFournisseur = new BddPaiementFournisseur();
     

      echo $twig-> render('pages/home.html.twig',[

        'nombreFamille'=>$bddFamille->countFamille(),
        'nombreCommande'=>$bddCommande->countCommande(),
        'nombreProduit'=>$bddProduit->countProduit(),
        'nombreClient'=> $bddClient->countClient(),
        'nombreFournisseur'=>$bddFournisseur->countFournisseur(),
        'stocksSortie'=>$bddStockesSorties->countStocksSorties(),
        'stockesEntrees'=>$bddStockesEntrees->countStocksEntrees(),
        'nombrePaieClient'=> $bddPaieClient->countPaieClient() ,
        'nombrePaieFournisseur'=>$bddPaieFournisseur->countPaieFournisseur()    
      ]);  
    }
    


