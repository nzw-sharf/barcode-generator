<?php
require_once('tcpdf/tcpdf.php'); // Include TCPDF library

if (isset($_POST['number_sequence'])) {
    $errors = [];
    $number_sequence = trim($_POST['number_sequence']);

    // Validate number sequence (you can customize this)
    $lines = explode("\n", $number_sequence);
    
    

    if (empty($errors)) {
        
        $numbers = $lines;
        
        $max_per_page = 60;
       // TCPDF setup
       $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
       $pdf->setPrintHeader(false);
       $pdf->setPrintFooter(false);
    //    $pdf->SetMargins(10, 10, 10); // Adjust margins if needed
      //// $pdf->setCellPadding(2);
    //    $pdf->setAutoPageBreak(false); // Adjust cell padding if needed
       // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
   // QR code settings (adjust as needed)
       $qr_code_size = 40; // QR code size in mm
       // Calculate maximum rows based on QR codes per page
       $pdf->setFontSize(26);
       $pdf->AddPage();
       
       $i = 0;
       $x = 5; // Starting X-coordinate
       $y = 5; // Starting Y-coordinate
       $current_row = 1;

        foreach ($numbers as $number) {

                $pdf->write1DBarcode((string)$number, 'C128', $x, $y, $qr_code_size, 14, 0.3, array('position'=>'S', 'border'=>true, 'padding'=>1, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>false, 'font'=>'helvetica', 'fontsize'=>7, 'stretchtext'=>4), 'N');
                $pdf->Text($x+41, $y+2, (string)$number);
                $pdf->Ln();

            $i++;
            $x += $qr_code_size + 63; // Adjust spacing between QR codes

            // Check if reached end of row and adjust y coordinate for next row
            if ($i % 2 === 0) {
                $y += 21; // Adjust spacing between rows
                $x = 5; // Reset X-coordinate for next row
                $current_row++;
            }

            // Check if reached maximum rows and add a new page
            if ($current_row > 13) {
                $pdf->AddPage();
                $i = 0;
                $x = 5;
                $y = 5;
                $current_row = 1;
            }
         }
        //  $pdf->writeHTML($html, false);
        //  $pdf->lastPage();
        $pdf->Output(__DIR__ .'/'.'output.pdf', 'I');
        // $pdf->Output('qr_codes.pdf', 'I'); // Output the PDF to the browser
    } else {
        echo "Errors occurred during file upload:<br>";
}

}