<?php

use Dompdf\Dompdf;

function generatePdf($html, $filename = 'document')
{
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($filename . ".pdf", ["Attachment" => 1]);
}
