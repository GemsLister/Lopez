<?php
require_once __DIR__ . '../../vendor/autoload.php';

$mpdf = new \mpdf\mpdf();
$mpdf->WriteHTML('<h1>Hello from mPDF!</h1>');
$mpdf->Output();
?>