<?php
require_once('tcpdf/tcpdf.php');

class Muveletek_Pdf_Model
{
    public function pdf_data() {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=szoftver', 'root', '',
            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

            $sql = "SELECT id, hely, tipus FROM gep";
            $sth = $dbh->query($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            echo "Hiba: " . $e->getMessage();
        }

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Web-programozás II');
        $pdf->SetTitle('Szoftver leltár');
        $pdf->SetSubject('2. beadandó');
        $pdf->SetKeywords('TCPDF, PDF, Web-programozás II, 2. beadandó');

        $pdf->SetHeaderData("nje.png", 25, "Helységek és IP címek listája", "Web-programozás II\n2. beadandó\n".date('Y.m.d',time()));

        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('helvetica', '', 10);

        $pdf->AddPage();


        $html  = '
<html>
	<head>
		<style>
			table {border-collapse: collapse;}
			th {font-weight: border: 1px solid red; text-align: center;}
			td {border: 1px solid grey;}
		</style>
	</head>
	<body>
		<h1 style="text-align: center; color: black;">Sámítógépek listája</h1>
		<table>
			<tr style="background-color: red; color: white;">
			<th style="width: 5%;">&nbsp;<br>&nbsp;<br>&nbsp;</th>
			<th style="width: 20%;">&nbsp;<br>Hely</th>
			<th style="width: 20%;">&nbsp;<br>Tipus</th>
			</tr>
';
        $i=1;
        foreach($rows as $row) {
            if($i)
                $html .= '
			<tr style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 255);">
		';
            else
                $html .= '
			<tr style="background-color: rgb(0, 0, 255); color: rgb(255, 255, 255);">
		';
            $j=0;
            foreach($row as $cell) {
                if($j==0)
                    $html .= '
				<td style="text-align: right; width: 5%;">
			';
                else if($j < 4)
                    $html .= '
				<td style="text-align: left; width: 20%;">
			';
                else if($j == 4)
                    $html .= '
				<td style="text-align: left; width: 35%;">
			';
                $html .= $cell;
                $html .= '
				</td>
		';
                $j++;
            }
            $html .= '
			</tr>
	';
            $i = !$i;
        }
        $html .= '
		</table>
	<body>
</html>';

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('web2zh', 'I');
    }
}