<?php  session_start(); ?>   

<?php include '../config.php'; 
	
	if(isset($_POST['payment'])) 
	{	
		$acnt = $_POST['account_no'];
		$pin = $_POST['pin_no'];
		$strSQL = mysqli_query($mysqli ,"select * from Bank where account_no = '$acnt' and  pin_no ='$pin'");
                
                if($strSQL == TRUE ){
                    $Results = mysqli_fetch_array($strSQL);

						if(count($Results)>=1)
						{   echo "<script type='text/javascript'>alert('Bill Paid Successfully');</script>";
                        }
				}

				else
				{
					echo "<script type='text/javascript'>alert('Invalid Pin');</script>";
					       
				}

	}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel : Arif Store</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	 <!-- My CSS -->
    <link href="../style.css" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="sell.php">ARIF STORE</a>
            </div>
            <!-- Top Menu Items -->
                        <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION["user"]?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="sell.php"><i class="fa fa-fw fa-dashboard"></i> Sell</a>
                    </li>
					<li>
                        <a href="myprofile.php"><i class="fa fa-fw fa-dashboard"></i> My Profile</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

			<div id="page-wrapper">

				<div class="container-fluid">

				<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">
							   Cart <small></small>
							</h1>
							<ol class="breadcrumb">
								<li class="active">
									<i class="fa fa-dashboard"></i> Shopping Cart
								</li>
							</ol>
						</div>
					</div>
					
					
			 	<?php
				if(isset($_SESSION["cart_products"])) //check session var
				{
				?>			
					<div class="row checkout">
							<div class="cart-view-table-back">
							<form method="post" action="cart_update.php">
							<table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Quantity</th><th>Name</th><th>Price</th><th>Total</th><th>Remove</th></tr></thead>
							  <tbody>
								<?php

									$total = 0; //set initial total value
									$b = 0; //var for zebra stripe table 
									
									foreach ($_SESSION["cart_products"] as $cart_itm)
									{
										//set variables to use in content below
										$product_name = $cart_itm["product_name"];
										$product_qty = $cart_itm["product_qty"];
										$product_price = $cart_itm["product_price"];
										$product_code = $cart_itm["product_code"];

										$subtotal = ($product_price * $product_qty); //calculate Price x Qty
										
										echo '<tr>';
										echo '<td><input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
										echo '<td>'.$product_name.'</td>';
										echo '<td>'.$currency.$product_price.'</td>';
										echo '<td>'.$currency.$subtotal.'</td>';
										echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /></td>';
										echo '</tr>';
										$total = ($total + $subtotal); //add subtotal to total var
									}
									
									$grand_total = $total ; //grand total including shipping cost
									$_SESSION['vat'] = 0 ;
									foreach($taxes as $key => $value){ //list and calculate all taxes in array
											$tax_amount     = round($total * ($value / 100));
											$tax_item[$key] = $tax_amount;
											$_SESSION['vat'] = $_SESSION['vat'] + $tax_amount ;
											$grand_total    = $grand_total + $tax_amount;  //add tax val to grand total
									}
									
									$list_tax       = '';
									foreach($tax_item as $key => $value){ //List all taxes
										$list_tax .= $key. ' : '. $currency. sprintf("%01.2f", $value).'<br />';
									}
								
								?>
								<tr><td colspan="5"><span style="float:right;text-align: right;"><?php if(isset($_SESSION["cart_products"])) echo  $list_tax; ?>Amount Payable : <?php if(isset($_SESSION["cart_products"])) echo sprintf("%01.2f", $grand_total);?></span></td></tr>
								<tr><td colspan="5"><a href="sell.php" class="button">Add More Items</a><button type="submit">Update</button></td></tr>
								

							  </tbody>
							</table>
							<input type="hidden" name="return_url" value="<?php 
							$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
							echo $current_url; ?>" />
								
							</form>
							</div>
					</div>
					
					<div class="row finalize_payment"> 
						
						<div class="col-lg-12"> 
							<div class="payment"> 
								<form method="post" class="payment_form form-inline" >
									<div class="form-group"> 
									
									<input type="text"  class="form-control" id="email" placeholder="Credit Card" name="account_no" value="">
									
									<input type="text" class="form-control"  name="pin_no" placeholder="Pin No" value="">
									
									<input type="submit"  class="btn btn-default" name="payment" value="Credit Card Payment">
									</div>
								</form>
							</div>
						</div> 
					</div> 
						
					<div class="row finalize_order">
						
							<div class="col-lg-12"> 
								<div class="order">
									<form method="post" class="order_form"  >

										<input type="submit"  class="btn btn-success" name="order" value="Finalize Order">

									</form>
								</div> 
							</div>
						
					</div>
				</div>
									 
			</div>              
					
	</div>
	
	<?php
	}
		else{
			echo "<div class=\"alert alert-info\">";
			echo "<center><strong>Ops! </strong> Shopping Cart is Empty!!  Go to <a href=\"sell.php\">Sell Products</a></center>";
			echo "</div>";
		}
            if(isset($_POST["order"])){
				$employee_id = $_SESSION["user_id"] ;
                $purchase_sql = "insert into total_purchase (purchase_total,user_id) values ('$grand_total' ,'$employee_id') " ;
					$_SESSION["grand_total"] = $grand_total;     
					if ($mysqli->query($purchase_sql) === TRUE ) {
                        $last_id = mysqli_insert_id($mysqli);
                                        
                        foreach ($_SESSION["cart_products"] as $cart_itm)
                        {  
                            $code = $cart_itm["product_code"] ;
                            $q = $cart_itm["product_qty"] ;
                            
                            $findsql = "select products_available from products where product_code = '$code' " ;
                            $result = $mysqli->query($findsql);
                            $row = $result->fetch_assoc() ;
                            
                            $available = $row["products_available"];
                            echo  $available ;
                            
                            $sql = "insert into buying_table (purchase_id,product_code,product_quantity) values ('$last_id','$code','$q') " ;
                            $mysqli->query($sql);
                            
                            $updatesql = "update products set products_available='$available' - '$q' where product_code = '$code' " ;
                            $mysqli->query($updatesql);

                        } 
                        
					
                     echo "<script>window.location.pathname = 'arifstore/employee/pdf_generate.php' ;</script>"; 
                    } else {
                        echo "Error: " . $sql . "<br>" . $mysqli->error;
                    }
					
			}		
		?>
			
		
        <!-- /.container-fluid -->

        <!-- /#page-wrapper -->

    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../js/plugins/morris/raphael.min.js"></script>
    <script src="../js/plugins/morris/morris.min.js"></script>
    <script src="../js/plugins/morris/morris-data.js"></script>

</body>

</html>
