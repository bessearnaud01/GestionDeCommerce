<?php // Include the main TCPDF library (search for installation path).


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

    
$bddFacture = new BddFactures();
 
$facture =  $bddFacture ->read();
   


class MYPDF extends TCPDF {

    public function Header(){

        $this->Cell(0,10,'La listes des Factures',0,false,'C');
 
     }


    // Colored table
    public function ColoredTable($header,$facture) {
        // Colors, line width and bold font
      
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        // set margins
     
        $this->SetFont('', 'B');
        // Header
        $w = array(20, 20, 25, 26, 20, 40, 40);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        







    
        // Data
        $fill = 0;
        foreach($facture as $row) {
            $this->Cell($w[0],6, $row-> getIdFacture(), 'LR', 0, 'L', $fill);
            $this->Cell($w[1],6, $row-> getNomClient(), 'LR', 0, 'L', $fill);
            $this->Cell($w[2],6, $row-> getLibelle(), 'LR', 0, 'L', $fill);
            $this->Cell($w[3],6, $row-> getPrixUnitaire(), 'LR', 0, 'R', $fill);
            $this->Cell($w[4],6, $row-> getQuantite(), 'LR', 0, 'R', $fill);
            $this->Cell($w[5],6, $row-> getMontantDu() , 'LR', 0, 'R', $fill);
            $this->Cell($w[6],6, $row-> getDate(), 'LR', 0, 'R', $fill);
            $this->Ln();

            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}







// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->StartTransform();          
$pdf->Rotate(90);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Besse Arnaud');
$pdf->SetTitle('');
$pdf->SetSubject('TCPDF Tutorial');

$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();


// column titles
$header = array('N°Fctre', 'N°Clt','Libellé','Prx','Qtité','Mtt','Date');

// data loading
//$clients = $pdf->LoadData('data/table_data_demo.txt');
$facture = $bddFacture ->read();

// print colored table
$pdf->ColoredTable($header, $facture);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('example_01', 'I');

//============================================================+
// END OF FILE
//============================================================+
