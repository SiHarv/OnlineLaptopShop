<?php
require '../../vendor/autoload.php'; // Ensure you have Dompdf installed via Composer

use Dompdf\Dompdf;
use Dompdf\Options;

$data = json_decode(file_get_contents('php://input'), true);

$html = '<h1>All Orders</h1>';
$html .= '<table border="1" style="width:100%; border-collapse: collapse;">';
foreach ($data['data'] as $row) {
    $html .= '<tr>';
    foreach ($row as $cell) {
        $html .= '<td style="padding: 8px;">' . htmlspecialchars($cell) . '</td>';
    }
    $html .= '</tr>';
}
$html .= '</table>';

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

$output = $dompdf->output();
$filePath = '../../uploads/orders.pdf';
file_put_contents($filePath, $output);

// Serve the file directly
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="orders.pdf"');
echo $output;
?>