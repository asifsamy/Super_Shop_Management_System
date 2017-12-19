<?php  session_start(); ?>   

<?php include '../config.php'; ?>

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
                    <li class="active">
                        <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="forms.php"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
					<li>
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

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
				
				<div class="row">
                    <div class="col-lg-12">
						 <?php
						  $getselect = $mysqli->query("SELECT product_name FROM products where products_available=0");
                          while( $product=mysqli_fetch_assoc($getselect) ) {
						  ?>
                          <div class="alert alert-danger alert-dismissable">
						  
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>ALERT! </strong> <?php echo $product["product_name"];?> is unavailable!
						  
						  </div>
						  <?php
						  }
						  ?>
						
                    </div>
                </div>
				
				
                <?php

					$todaysql = "SELECT sum(purchase_total) as total FROM total_purchase WHERE Day(purchase_date) = Day(curdate()) ; ";
								
					$monthsql = "SELECT sum(purchase_total) as total FROM total_purchase WHERE MONTH(purchase_date) = MONTH(curdate()) ; ";
								
					$yearsql = "SELECT sum(purchase_total) as total FROM total_purchase WHERE YEAR(purchase_date) = YEAR(curdate()) ; ";
										
					$todayresult = $mysqli->query($todaysql) ;
					$monthresult = $mysqli->query($monthsql) ;
					$yearresult = $mysqli->query($yearsql) ;
					
					$d = 0 ; 	
					$m = 0 ; 	
					$y = 0 ; 	
										 
					if($row = $todayresult->fetch_assoc()){
						if($row['total']==true)
							$d = $row['total'] ;
						else
							$d = 0 ;
											  
						if($row = $monthresult->fetch_assoc())
							if($row['total'])
								$m = $row['total'] ;
							else
								$m = 0 ;
																			
						if($row = $yearresult->fetch_assoc())
							if($row['total'])
								$y = $row['total'] ;
							else
								$y = 0 ;
					
					$count = 0 ;	
					$product_count_query = "SELECT count(id) as c FROM products ";

					$product_count_result = $mysqli->query($product_count_query) ;

					if($row = $product_count_result->fetch_assoc()){
						if($row['c'])
							$count = $row['c'] ;
						else
							$count = 0 ;
					}		

				?>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $d ;?> tk</div>
                                        <div>Today's Income</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                       
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $m ;?> tk</div>
                                        <div>Month's Income</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $y ;?> tk</div>
                                        <div>Year's Income</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                       
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $count ;?></div>
                                        <div>Total Products</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
				
				<?php
					}
				?>
                <!-- /.row -->
				<div class="row bar_chart">
                    <div class="col-lg-12">
					<h3>Sell of This Year (March-August)</h3>
						<div id="chart">
						  <ul id="numbers">
							<li><span>100%</span></li>
							<li><span>90%</span></li>
							<li><span>80%</span></li>
							<li><span>70%</span></li>
							<li><span>60%</span></li>
							<li><span>50%</span></li>
							<li><span>40%</span></li>
							<li><span>30%</span></li>
							<li><span>20%</span></li>
							<li><span>10%</span></li>
							<li><span>0%</span></li>
						  </ul>
						  <ul id="bars">
							<?php
								$i = 2 ;
								$tk = array(0,0,0,0,0,0,0,0,0);

								$yearsql = "SELECT sum(purchase_total) as total FROM total_purchase WHERE YEAR(purchase_date) = YEAR(curdate()) ; ";
								
								$year = $mysqli->query($yearsql) ;
								
									if($row = $year->fetch_assoc())
										if($row['total'])
											$y = $row['total'] ;
										
								while($i<=9){
									$monthsql = "SELECT sum(purchase_total) as total FROM total_purchase WHERE MONTH(purchase_date) = '$i' ; ";
									$res = $mysqli->query($monthsql) ;
									
									if($row = $res->fetch_assoc())
										if($row['total'])
											$tk[$i] = floor(($row['total']/$y)*100) ;
								
									$i++;
									
								}
							
							echo "<li><div data-percentage=\"$tk[3]\" class=\"bar\"></div><span>March</span></li>";
							
							echo "<li><div data-percentage=\"tk[4]\" class=\"bar\"></div><span>April</span></li>";
							
							echo "<li><div data-percentage=\"$tk[5]\" class=\"bar\"></div><span>May</span></li>";
							echo "<li><div data-percentage=\"$tk[6]\" class=\"bar\"></div><span>June</span></li>";
							echo "<li><div data-percentage=\"$tk[7]\" class=\"bar\"></div><span>July</span></li>";
							echo "<li><div data-percentage=\"$tk[8]\" class=\"bar\"></div><span>August</span></li>";
							?>
						  </ul>
						</div>
					</div>
				</div>
				
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Purchase Table</h2>
                        <div class="table-responsive purchase">
                            
							<?php 
								
								$sql = "SELECT * FROM  total_purchase" ;
								$result = $mysqli->query($sql);
								
								echo  "<table class=\"table table-bordered table-hover\">" ;  
								echo  "<thead><tr><th>Purchase Id</th><th>Purchase Date</th><th>Purchase Total</th><th>Purchase Taken By</th></tr></thead><tbody>" ;  
								while($row = mysqli_fetch_assoc($result)){
									 echo "<tr>";
									 echo "<td>".$row["purchase_id"]."</td>";
									 echo "<td>".$row["purchase_date"]."</td>";
									 echo "<td>".$row["purchase_total"]."</td>";
										
							?>  
								<form method="get" action="user_profile.php">
									 
									<td> <input type="submit" name="id_update" value="<?php echo $row['user_id']; ?>" /></td>
									 
								</form>
								</tr>
								
							<?php
									}
							?>
							
							  </tbody>
                            </table>
                            	
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h2>Products</h2>
                        <div class="table-responsive">
						<?php 
                        
							$sql = "SELECT * FROM  products" ;
							$result = $mysqli->query($sql);
							
							echo  "<table class=\"table table-bordered table-hover table-striped\">" ;  
							echo  "<thead><tr><th>Id</th><th>Code</th><th>Name</th><th>Price</th><th>Available</th><th>Supplier</th></tr></thead><tbody>" ;  
							while($row = mysqli_fetch_assoc($result)){
								 echo "<tr>";
								 echo "<td>".$row["id"]."</td>";
								 echo "<td>".$row["product_code"]."</td>";
								 echo "<td>".$row["product_name"]."</td>";
								 echo "<td>".$row["price"]."</td>";
								 if($row["products_available"]==0)    
									echo "<td style=\"background-color:red;color:white\" >".$row["products_available"]."</td>";
								 else
									 echo "<td>".$row["products_available"]."</td>";
								 
								 if($row["products_supplier"]=="")    
									 echo "<td>Not Available</td>";
								 else
									 echo "<td>".$row["products_supplier"]."</td>";
								 
								 echo "</tr>";
							}
						   
						
						?>
						
							</tbody>
							</table>
							
						</div>
                    </div>
                </div>
				
				 <div class="row">
                    <div class="col-lg-12">
					
						<h2>Users</h2>
                        <div class="table-responsive">
						<?php 
                        
						  $var = 0 ;	
                          $getselect = $mysqli->query("SELECT * FROM users");
                          echo "<table class=\"table table-bordered table-hover table-striped\" ><thead><tr><th>No</th><th>ID</th><th>Name</th><th>Type</th><th>Password</th><th>Address</th></tr></thead><tbody>"; 		
                            while( $product=mysqli_fetch_assoc($getselect) ) {
							   $var++;
						?>
						
							<tr>
								<td><?php echo $var ; ?></td>				
                                <form method="get" action="user_profile.php">
									 
									<td> <input type="submit" name="id_update" value="<?php echo $product['user_id']; ?>" /></td>
									 
								</form>
                                <td><?php echo $product['user_name']; ?></td>
                                <td><?php echo $product['user_type']; ?></td>
                         		<td><?php echo $product['user_pass']; ?></td>
								<td><?php echo $product['user_address']; ?></td>
							
							</tr>
						<?php		
							
							}
						   
						?>
						
							</tbody>
							</table>
							
						</div>
                    </div>
                </div>
            <!-- /.container-fluid -->

			</div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <script src="../js/script.js"></script>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-36251023-1']);
	  _gaq.push(['_setDomainName', 'jqueryscript.net']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</body>

</html>
