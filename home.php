<?php
require 'connect.php';

if (isset($_GET['cat_id'])) {  // testing for cat_id
	$result = "SELECT * FROM products WHERE cat_id = :cat_id";  // select query for products
	$stmt = $pdo->prepare($result);
	$stmt->bindValue(':cat_id', $_GET['cat_id']); // bindvalue of cat_id
	$stmt->execute($_GET);	
	$fetch['true']='ss';//create a array fetch to execute the product lists
	//where ss is a dummy value
}

$query = $pdo->query("SELECT * FROM products where feature_status=1");  // query to change status of product to make it fetaure products


?>
<?php ob_start(); ?>
		




		<main>
			<h1>Welcome to Ed's Electronics</h1>

			<p>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</p>
			<ul class="products">
			<?php if (isset($fetch['true'])){  //testing for boolen type
				foreach($stmt as $row){?>       <!-- will result set in row -->

				<a href="viewproduct.php?product_id=<?php echo $row['product_id'];?>">
				<li>

					<h3><?php echo $row['product_name'];?></h3>   <!-- / display product_name
 -->
					
					<img src="images/<?php echo $row['image_name']; ?>" height='200' width ='150'>;
					<p><?php echo $row['product_description'];?> </p>   <!-- fixed size of image
 -->

					<div class="price">£<?php echo $row['product_price'];?></div>    <!-- dislay price of product
				</li> -->
			</a>
			<?php }
			}else{?>
				<h1><a href="#">Featured Product</a></h1>
			<p><strong></strong></p>
			
					<ul class="products">
				<?php foreach ($query as $row): ?>
					<a href="viewproduct.php?product_id=<?php echo $row['product_id'];?>">
				<li>
				<li>
					<h3><?php echo $row['product_name'];?></h3>


					<img src="images/<?php echo $row['image_name']; ?>" height='200' width ='150'>;
					<p><?php?> </p>


					<p><?php echo $row['product_description'];?> </p>


					<div class="price">£<?php echo $row['product_price'];?></div>



			
		
	
				<?php endforeach ?>
				
			<?php }?>


			

			
	
	
</li>
</ul>
		

		</main>
		<?php $main = ob_get_clean();
			require 'template.php';?> 
	

		