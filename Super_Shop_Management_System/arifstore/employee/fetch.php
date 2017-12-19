
<?php
//fetch.php
	include '../config.php'; 
	
	//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($mysqli, $_POST["query"]);
 $query = "
  SELECT * FROM products 
  WHERE product_name LIKE '%".$search."%'
 ";
}
else
{
 $query = "
  SELECT * FROM products where products_available > 0 ORDER BY product_name ASC 
 ";
}
$results = mysqli_query($mysqli, $query);


if(mysqli_num_rows($results) > 0){ 
$products_item = '<div class="panel-group">';
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	
	<form method="post" class="form-horizontal" >
	  
		<div class="panel panel-default">
		   
		   <div class="panel-heading">{$obj->product_name}</div>
		   <div class="panel-body">
				<b>Price :{$currency}{$obj->price}</b>
				<input  class="form-control"  type="text" size="2" maxlength="2" name="product_qty" value="1" />
			</div>
			<input type="hidden" name="product_code" value="{$obj->product_code}" />
			<input type="hidden" name="type" value="add" />
			<input type="hidden" name="available" value="{$obj->products_available}" />
			<input type="hidden" name="return_url" value="{$current_url}" />
			<div class="panel-footer"><button type="submit" class="class="btn btn-primary">Add</button></div>
			
		</div> 
		
	</form>
	
EOT;
}
$products_item .= '</div>';
echo $products_item;
}

else
{
 echo 'Data Not Found';
}

?>