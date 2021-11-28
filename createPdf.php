<?php
 require_once('tcpdf/tcpdf.php');
 require_once('models/prize.php');
 require_once('connection.php');
 $result = PrizeQuery::getPrizes($_GET['hit']);
        $html ='
        <html>
            <head>
            <style>
			table {border-collapse: collapse;}
            th{padding: 2px;}
			td {border: 1px solid black;}
		</style>
            </head>
            <body>
               <table><tr><th>Év</th><th>Hét</th><th>Számok</th><th>Nyeremény</th></tr>';
        foreach($result as $prize){
            $html.='<tr><td>'. $prize->year.'</td><td> '.$prize->week.'</td><td> '.implode(',',$prize->nums).'</td><td> '.$prize->value.' Ft</td></tr>';
       }

       $html.='</table></body></html>';

        
 // create new PDF document
 $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
 // set document information
 $pdf->SetCreator(PDF_CREATOR);
 $pdf->SetAuthor('Web-programozás II');
 $pdf->SetTitle('Nyeremények');
 //$pdf->SetSubject('Web-programozás II - 3. Labor - TCPDF');
 //$pdf->SetKeywords('TCPDF, PDF, Web-programozás II, Labor3');
 $pdf->SetHeaderData("lotto.jpg", 25, $_GET['hit']."-találatos nyeremények listája", "Web-programozás II\n2. beadandó\n6. feladat\n".date('Y.m.d',time()));
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
 $pdf->SetFont('helvetica', '', 10);
 $pdf->AddPage();

 
 $pdf->writeHTML($html, true, false, true, false, '');
 
 // ---------------------------------------------------------
 
 //Close and output PDF document
 $pdf->Output('proba1.pdf', 'I');
 
     



?>