<?php  session_start(); ?>   

<?php include '../config.php'; 

	$id_update = $_GET['id_update2'] ;
	
    if(isset($_POST['update']))
    {
        
					$id = $_POST['id'];
                    $product_name = $_POST['product_name'];
                    $product_code = $_POST['product_code'] ;
                    $price = $_POST['price'] ;
                    $products_available = $_POST['products_available'] ;
                    $products_supplier = $_POST['products_supplier'] ;
                    
					$sql = "UPDATE products SET product_name = '$product_name', id = '$id', 
                    product_code = '$product_code', price = '$price', products_available = '$products_available' , products_supplier = '$products_supplier' WHERE id = '$id_update'" ;

                    $result = $mysqli->query($sql);
					if($result) {
                        $msg = "<script> alert(\"Successfully Updated!!\")</script>";
                        echo $msg ;
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
                <a class="navbar-brand" href="dashboard.php">ARIF STORE</a> 
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
                        <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="forms.php"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
					<li >
                        <a href="updateusers.php"><i class="fa fa-fw fa-edit"></i> Update Users</a>
                    </li>
					<li>
                        <a href="updateproducts.php"><i class="fa fa-fw fa-edit"></i> Update Products</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Update Products Information
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-edit"></i> Update Products
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="row user_profile">
						<div class="col-lg-8">
							<br>
							<?php
							  
							  $id_update = $_GET["id_update2"];		
							  $getselect = $mysqli->query("SELECT * FROM products WHERE id = '$id_update'");
							  
							  $product=mysqli_fetch_assoc($getselect) ;
							?>
							<form class="form-horizontal" method="post">
							<div class="form-group">
							  <label class="control-label col-sm-2" for="email">ID</label>
							  <div class="col-sm-10">
								<input type="text" value="<?php echo $product['id']; ?>" class="form-control" id="email"  name="id">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="control-label col-sm-2" for="email">Code:</label>
							  <div class="col-sm-10">
								<input type="text" value="<?php echo $product['product_code']; ?>" class="form-control" id="email"  name="product_code">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="control-label col-sm-2" for="email">Name:</label>
							  <div class="col-sm-10">
								<input  value="<?php echo $product['product_name']; ?>" type="text" class="form-control" id=""  name="product_name">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="control-label col-sm-2" for="email">Price</label>
							  <div class="col-sm-10">
								<input value="<?php echo $product['price']; ?>" type="text" class="form-control" id="email"  name="price">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="control-label col-sm-2" for="email">Available</label>
							  <div class="col-sm-10">
								<input value="<?php echo $product['products_available']; ?>" type="text" class="form-control" id="email"  name="products_available">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="control-label col-sm-2" for="email">Supplier</label>
							  <div class="col-sm-10">
								<input value="<?php echo $product['products_supplier']; ?>" type="text" class="form-control" id="email"  name="products_supplier">
							  </div>
							</div>
							
							<div class="form-group">        
							  <div class="col-sm-offset-2 col-sm-10">
								<input type="submit" name="update" value="Submit" class="btn btn-default"/>
								<a href="updateproducts.php" class="btn btn-info">View Products </a>
							  </div>
							</div>
						  </form>
	  
					<?php 
                        echo "</div>";
                    ?>
					
				</div>
  

            <!-- /.container-fluid -->

				</div>
				
        <!-- /#page-wrapper -->

			</div>
			
		</div>
    <!-- /#wrapper -->
	<script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../js/plugins/morris/raphael.min.js"></script>
    <script src="../js/plugins/morris/morris.min.js"></script>
    <script src="../js/plugins/morris/morris-data.js"></script>

</body>

</html>