<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }

    function head() {



    	$html = '';
				//$html .= '<h3>Level: '.$level.'</h3>'; 
				//$html .= '<h3>Semester: '.$semester.'</h3>';
				//$html .= '<h3>Course Code: '.$course_code.'</h3>';
				//$html .= '<h3>Credit Hour: '.$credit_hour.'</h3>';
			  	$html .= '<table border = "1">';
			  	$html .= '<thead>';
			  	$html .= '<tr>';
			  	$html .= '<th>ID</th>';
			  	$html .= '<th>Marks</th>';
			  	$html .= '</tr>';
			  	$html .= '</thead>';  

				/*for($i = 0; $i < count($id); $i++) {
					$html .= '<tr>';
			  		$html .= '<td>'.$id[$i].'</td>';
			  		$html .= '<td>'.$mark[$i].'</td>';
			  		$html .= '</tr>';
				} */
					$html .= '</table>'; 

					$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
					$pdf->SetTitle('My Title');
					$pdf->SetHeaderMargin(30);
					$pdf->SetTopMargin(20);
					$pdf->setFooterMargin(20);
					$pdf->SetAutoPageBreak(true);
					$pdf->SetAuthor('Author');
					$pdf->SetDisplayMode('real', 'default');
					$pdf->AddPage();
					$pdf->writeHTML($html, true, false, true, false, '');
					$pdf->Output("tcpdf/", 'F');
					$pdf->Output('new_pdf.pdf', 'I');
    }
}