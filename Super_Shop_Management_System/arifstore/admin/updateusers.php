<?php  session_start(); ?>   

<?php include '../config.php'; 

	if(isset($_POST['submit']))
    {
       
        $user_name = $_POST['user_name'];
        $user_id = $_POST['user_id'];
        $user_pass = $_POST['user_pass'];
        $user_address = $_POST['user_address'];
        $user_type = $_POST['user_type'];
		
		$sql = "INSERT INTO users (user_name , user_id , user_pass , user_address , user_type)
                  VALUES ('$user_name', '$user_id', '$user_pass', '$user_address', '$user_type');";
    
        if ($mysqli->query($sql) === TRUE ) {
           echo "<script>alert(\"User Added Successfully!!!\");</script>";
        }
        else{
            echo "<script>alert(\"Error in entering information!\");</script>";
        }

    }
	
	if(isset($_POST['submit2']))
    {
       
        $product_name = $_POST['product_name'];
        $product_code = $_POST['product_code'];
        $product_price = $_POST['product_price'];
        $products_available = $_POST['products_available'];
        $products_supplier = $_POST['products_supplier'];
        
        $sql = "INSERT INTO products (product_name, product_code , price,products_available,products_supplier)
                  VALUES ('$product_name', '$product_code', '$product_price', '$products_available', '$products_supplier');";
    
        if ($mysqli->query($sql) === TRUE ) {
           echo "<script>alert(\"Product Recorded Successfully!!!\");</script>";
        }
        else{
            echo "<script>alert(\"Error in entering information!\");</script>";
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
					<li class="active">
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
                            Update Users Information
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-edit"></i> Update Users Profile
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    
					<div class="col-lg-12">
					
					<?php
						  $var = 0 ;	
                          $getselect = $mysqli->query("SELECT * FROM users");
                          echo "<table class=\"table table-condensed\" ><tr><th>User ID</th><th>User Name</th><th>User Type</th><th>User Password</th><th>User Address</th><th>Update</th></tr>"; 		
                          while( $product=mysqli_fetch_assoc($getselect) ) {
							   $var++;
                    ?>
								<tr>
                                <form method="get" action="single_profile_update.php">
											 
                                            <td><?php echo $var. "  . " . $product['user_id']; ?></td>
                                            <td><?php echo $product['user_name']; ?></td>
                                            <td><?php echo $product['user_type']; ?></td>
                                            
											<td><?php echo $product['user_pass']; ?></td>
											<td><?php echo $product['user_address']; ?></td>
											
											<input type="hidden" name="id_update" value="<?php echo $product['user_id']; ?>" />
											<td><input type="submit" class="btn btn-primary" name="update" value="Update" /></td>
                                </form>
								<tr>
                
                    <?php } 
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