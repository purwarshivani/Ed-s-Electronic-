<?php
session_start(); // start session

require 'connect.php';   // link to connect php
if (isset($_GET['product_id'])) {   //testing condition
	$result = "SELECT * FROM products WHERE product_id = :product_id";   // select query for table products 
	$stmt = $pdo->prepare($result);
	$stmt->bindValue(':product_id',$_GET['product_id']);  // bind value of product_id
	$stmt->execute($_GET);   //execute satement
	$product=$stmt->fetch();  //fetch data
}
if (isset($_POST['review'])){    //testing condition , review will set By POST method
if(isset($_SESSION['type'])){     // testing for type
 $insert = "INSERT INTO reviews(user_id,product_id,date,review_text)        
 			VALUES (:user_id,:product_id, 
 			:date,:review_text);";                           //insert query for review table when review will POST
 $stmt = $pdo->prepare($insert);// prepred the query to excute
 $stmt->bindValue(':user_id',$_SESSION['user_id']);
 $stmt->bindValue(':product_id' ,$_GET['product_id']);
 $stmt->bindValue('date', date('Y/m/d'));
$stmt->bindValue(':review_text', $_POST['review_text']);
 $stmt->execute();
}else{
	header('location:login.php');
	var_dump($_SESSION);
}	
}
if(isset($_GET['submit'])){
	require'paymeny.php';
}

$result = $pdo->query("SELECT * FROM catagories");  //select query for table categories
$display = $pdo->query("SELECT * FROM catagories");
$select = ("SELECT review_text,firstname,lastname,date FROM reviews INNER JOIN users ON reviews.user_id = users.user_id WHERE product_id=:product_id AND approved = 1 "); //joinig the two table users and reviews
$reviews = $pdo->prepare($select);
$reviews->bindValue(':product_id' ,$_GET['product_id']);
$reviews->execute();
?>
<?php 
ob_start();
 ?>
		<main>
			<h1>Welcome to Ed's Electronics</h1>
			<p>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</p>
			<ul class="products">
				<li>
					<h3><?php echo $product['product_name'];?></h3>
					<img src="images/<?php echo $product['image_name']; ?>" height='200' width ='150'>; <!-- for image uploded -->
					<p><?php?> </p> 
					<p><?php echo $product['product_description'];?> </p>
					<div class="price">£<?php echo $product['product_price'];?></div>  

			<a href="paymeny.php?submit='anything'& product_id=<?php echo $product['product_id'];?>">
			 <input type="image" name="submit"
			src="images/cart.png"></a>  <!-- // FOR shoping cart
			 -->
				</li>
				<hr />
				<h4>Product reviews</h4>
				<?php foreach ($reviews as $row) {?>    <!-- //result set of review rows -->
				<ul class="reviews">			
				<li>
					<h3><?php echo $row['review_text'];?></h3>
					<div class="details">
						<strong><?php echo $row['firstname'].' '.$row['lastname'];?></strong>
						<em><?php echo $row['date'];?></em>
					</div>
				</li>
			</a>
			<?php } ?>
			<form action="" method="POST">
			<input type="textarea" name="review_text" value="review">  <!-- texarea to type review -->
			<input type="submit" name="review" value="review">           <!-- review button to submit -->
		</form>	
		</ul>
		
<h2>Share US</h2>    <!--  social_media link -->
<a href="https://www.facebook.com/sharer/sharer.php?"><img src="images/face.png" onmouseover="this.src='images/face-but-hov.png';" onmouseout="this.src='images/face.png';"/></a>
<a href="https://www.linkedin.com/sharer/sharer.php?"><img src="images/linkin.png" onmouseover="this.src='images/linkin-hov.png';" onmouseout="this.src='images/linkin.png';"/></a>

<a href="https://plus.google.com/sharer/sharer.php?"><img src="images/gplus.png" onmouseover="this.src='images/gplus-hov.png';" onmouseout="this.src='images/gplus.png';"/></a>

<a href="https://plus.google.com/sharer/sharer.php?"><img src="images/email.png" </a>



		</main>

		<?php
		$main= ob_get_clean();
		require 'template.php';
		  ?>
