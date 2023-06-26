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
 
$facture = $bddFactures->Search($_GET['id']);
$pdf = new  TCPDF (PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->AddPage();
    
   
// set default form properties

$pdf->Image(__DIR__.'/photos/imageEcole.jpg',0,-10,210,40);
$pdf->Ln(40);
$pdf->SetFont('helvetica', 'BI', 18);
$pdf->Cell(0, 5, 'Facture', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('helvetica', '', 12);
$pdf->Ln(20);


$pdf->Cell(250,5, 'N°Facture   : '.$facture->getIdFacture() );

$pdf->SetFillColor(0, 255, 0);

$pdf->Ln(10);




// nom du Client
$pdf->Cell(250, 5, 'Nom du client : ' .$facture->getNomClient() );
$pdf->Ln(10);


$pdf->Cell(250,5, 'Nom du produit   : '.$facture->getNomProduit(),0,0,'',true );
$pdf->SetFillColor(135, 206, 235);
$pdf->Ln(10);



$pdf->Cell(250,5, 'Libellé   : '.$facture->getLibelle(),0,0,'',true );
$pdf->Ln(10);







$pdf->Cell(45,5, 'Prix Unitaire  :'.' CHF '.$facture->getPrixUnitaire() );
$pdf->Ln(10);




$pdf->Cell(45,5, 'Quantité :  ' .$facture->getQuantite() );
$pdf->Ln(10);


$pdf->Cell(45,5, 'Le prix à payer sans TVA :'.' CHF '.$facture->getMontantSansTVA() );
$pdf->Ln(10);


$pdf->Cell(45,5, 'TVA :'.' CHF '.$facture->getTVA() );
$pdf->Ln(10);



$pdf->Cell(45,5, 'Prix à payer avec le TVA :'.' CHF '.$facture->getMontantDu() );
$pdf->Ln(10);



$pdf->Output('Facture.pdf', 'I');
