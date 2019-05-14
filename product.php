<?php
require 'connect.php';  // link to connect page



if(isset($_GET['del_id'])){    // cheking eixstance of del_id
	$delete = 'DELETE FROM products WHERE product_id= :del_id';  // delete query of table products
	$stmt = $pdo->prepare($delete);   // perpared above query
	$stmt->execute($_GET);  // excuted
}

$query = $pdo->query("SELECT * FROM products");    // select data from table products

if(isset($_POST['Addproducts'])) {          // testing for Addproducts taken AS $_POST
	header('location:addproducts.php');
	
}


ob_start();  //buffer is used to

?>



		<main>
			<form action="" method="POST">           <!--  from to add products -->
				<h1>PRODUCTS</h1>
				<input type="submit" name="Addproducts" value="ADD PRODUCTS"/>
				
				</form>
			<table>
				<tr>
					<th>products</th>
				</tr>
				
				<?php foreach( $query as $row){ ?>               <!--  to set result as row -->
					<tr>
					<td><?=$row['product_name']?> </td>
					<td><a href ="#" onClick ="javascript:if(confirm('Are you sure ?')){               
						document.location ='product.php?del_id=<?=$row['product_id']?>';}">DELETE
						</a>
						<!-- confirm box for delete and edit -->
					</td>
					<td><a href ="#" onClick = "javascript:if(confirm('Are you sure ?')){
						document.location='addproducts.php?editt_id=<?=$row['product_id']?>';} "> EDIT
					</a>

					</td>




				</tr> 
				<?php } ?>   <!--  end foreachloop -->
				

			</table>
		

</main>

<?php
  $main=ob_get_clean();
require 'template.php';
?>