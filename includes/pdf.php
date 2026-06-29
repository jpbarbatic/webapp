<?php

function generar_pdf($datos, $plantilla)
{
    require(__DIR__ . '/../vendor/autoload.php');
    /*
    \define('K_PATH_FONTS', \realpath(__DIR__ . '/../vendor/tecnickcom/tc-lib-pdf-font/target/fonts'));

    $pdf = new \Com\Tecnick\Pdf\Tcpdf();

    $bfont = $pdf->font->insert($pdf->pon, 'helvetica', '', 12);

    $page = $pdf->addPage();

    $pdf->page->addContent($bfont['out']);*/
    $mpdf = new \Mpdf\Mpdf();

    extract($datos);
    ob_start();
    include $plantilla;
    $html = ob_get_contents();
    ob_end_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output('listado.pdf', 'D');
    /*
    $pdf->addHTMLCell(
        html: $html,
        posx: 15,   // mm from left page edge
        posy: 20,   // mm from top page edge
        width: 180,  // mm wide (0 = to right margin)
    );

    $rawpdf = $pdf->getOutPDFString();

    $pdf->renderPDF($rawpdf);*/
}

function generar_pdf_db($db, $sql, $params, $orden, $orden_dir, $plantilla)
{
    require(__DIR__ . '/../vendor/autoload.php');
    /*
    \define('K_PATH_FONTS', \realpath(__DIR__ . '/../vendor/tecnickcom/tc-lib-pdf-font/target/fonts'));

    $pdf = new \Com\Tecnick\Pdf\Tcpdf();

    $bfont = $pdf->font->insert($pdf->pon, 'helvetica', '', 12);

    $page = $pdf->addPage();

    $pdf->page->addContent($bfont['out']);*/


    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'debug'  => true,
        'logDir' => '/tmp/mpdf_logs'
    ]);

    //$mpdf->SetHTMLFooter('<div style="text-align: center; font-family: Helvetica; font-size: 9pt;">
    //Página {PAGENO} de {NB}</div>');
    ob_start();
    include $plantilla;
    $html = ob_get_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    $mpdf->cleanup();
    unset($mpdf);
    /*
    $pdf->addHTMLCell(
        html: $html,
        posx: 15,   // mm from left page edge
        posy: 20,   // mm from top page edge
        width: 180,  // mm wide (0 = to right margin)
    );

    $rawpdf = $pdf->getOutPDFString();

    $pdf->renderPDF($rawpdf);*/
}
