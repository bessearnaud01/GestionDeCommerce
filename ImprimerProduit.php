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

    
$bddProduit = new BddProduit();
 
$produit = $bddProduit ->read();



class MYPDF extends TCPDF {



    public function Header(){

        $this->Cell(0,10,'La listes des Produits',0,false,'C');
 
     }

   

    // Colored table
    public function ColoredTable($header,$produit) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        // set margins
     
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 35, 35, 35, 35);
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
        foreach($produit as $row) {
            $this->Cell($w[0],6, $row->getIdProduit(), 'LR', 0, 'L', $fill);
            $this->Cell($w[1],6, $row-> getNomProduit(), 'LR', 0, 'L', $fill);
            $this->Cell($w[1],6, $row-> getMarque(), 'LR', 0, 'L', $fill);
            $this->Cell($w[1],6, $row-> getPa(), 'LR', 0, 'R', $fill);
            $this->Cell($w[1],6, $row-> getImage(), 'LR', 0, 'R', $fill);
            $this->Ln();

            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}







// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);




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
$header = array('N°produit', 'Nom','Marque','Prix','Image');

// data loading
//$clients = $pdf->LoadData('data/table_data_demo.txt');
$produit = $bddProduit ->read();

// print colored table
$pdf->ColoredTable($header, $produit);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('example_01', 'I');

//============================================================+
// END OF FILE
//============================================================+
