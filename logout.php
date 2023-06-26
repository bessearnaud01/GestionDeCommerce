<?php


include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader);

      // Elle me permet deconnecte de l'appliction 
      session_start();
      $_SESSION= [];
      session_destroy();
      
      header("Location:index.php");
