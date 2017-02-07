<?php 

 // reference the Dompdf namespace
use Dompdf\Dompdf;

$file = 'http://localhost/klickit/public/listOrders';
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->set_option( 'isRemoteEnabled', true );
$dompdf->set_option( 'isPhpEnabled', true );
$dompdf->load_html_file($file);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('facture Klickit');
