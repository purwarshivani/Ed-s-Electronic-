
<?php

require 'connect.php';


if (isset($_POST['cat'])) {  // when cat is POST it will re-direct categories.php
	header('location:categories.php');
}

if (isset($_POST['product'])) {    // when product is POST it will re-direct product.php
	header('location:product.php');

}
if (isset($_POST['review'])) {    // when review is POST it will re-direct review.php
	header('location:review.php');
}


if (isset($_POST['manage'])) {  // / when manage is POST it will re-direct userist.php
	header('location:userlist.php');
}


if(isset($_POST['feature_id'])){  // testing for feature id
	$post = "UPDATE products SET feature_status = '1' WHERE feature_id = :product_id ";  // upadate query to update products 
	$featured=$pdo->prepare($post);
	$feature->bindValue(':feature_id' ,$_GET['feature_id']);

	if($featured ==0)
		 {
			$featured = $pdo->prepare("UPDATE products SET feature_status = '1' WHERE product_id =:product_id "); // update query  
		}
		$feature->execute();
	}

if (isset($_POST['status'])) {
	header('location:status.php');
}


	

$run= $pdo->query("SELECT * FROM products WHERE feature_status = 0;");  // select query for table products where status is 0


ob_start();
?>

    
		<main>
			<h1>Welcome to Ed\'s Electronics</h1>

			<p>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</p>
					<!-- form where every button are included -->
				<form action="" method="POST">
					<fieldset>
					<input type="submit" name="cat" value="Category">


					</form>

					<form action="" method="POST">
					<input type="submit" name="product" value="product">


					</form>

					<form action= "" method ="POST">
					<input type = "submit" name= "review" value="review">

					</form>


					<form action= "" method ="POST">
					<input type = "submit" name= "manage" value="manageuser">

					</form>
			<hr />
			<form action="" method="POST">
				
	</form>
	<form action="main.php" method="POST">
		
			<input type = "submit" name= "status" value="status">
		
	</form>

</fieldset>
		</main>

	<?php
	$main = ob_get_clean();
	require 'template.php';
	?>
	