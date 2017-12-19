<?php  session_start(); ?>
<?php require('../config.php'); ?>
<?php	
			require('fpdf.php');
			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(180,50,'',0,1,'C');
			$pdf->Image('../images/logo.jpg',85,45,30);
			$pdf->Cell(180,10,'Arif Store',0,1,'C');
			$pdf->Cell(180,10,'Merul Badda , Dhaka .',0,1,'C');
			
			$pdf->Cell(180,10,date("F j, Y, g:i a"),0,1,'C');
			$pdf->Cell(180,10,'Employee ID : ' . $_SESSION['user_id'] ,0,1,'C');
			$pdf->Cell(180,10,'		-------		',0,1,'C');
			$pdf->Ln();
			foreach ($_SESSION["cart_products"] as $cart_itm)
			{
				
			$product_name = $cart_itm["product_name"];
			$product_qty = $cart_itm["product_qty"];
			$product_price = $cart_itm["product_price"];
			$t = $product_qty * $product_price ;
			$pdf->Cell(180,10,$product_name . ' * ' . $product_qty . ' 	=  ' . $t ,0,1,'C');
			}
			$k = 0 ;
			
			$pdf->Cell(180,10,'*VAT & Tax									=  ' . $_SESSION["vat"] ,0,1,'C');
			$pdf->Cell(180,10,'------------------------------',0,1,'C');
			$pdf->Cell(180,10,'Grand Total 											=  ' . $_SESSION["grand_total"] ,0,1,'C');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(180,10,'Thanks For Shopping With Us!',0,1,'C');

			$pdf->Output();
			unset($_SESSION["cart_products"]);
			unset($_SESSION["grand_total"]);
			unset($_SESSION["vat"]);


?>
		