<?php
if(isset($_POST['type'])){  // checking of existance type
session_start();        // started session 
}
require 'connect.php'; // provided link of connect.php
$result = $pdo->query("SELECT * FROM catagories"); // query to select data from catagories table
$display = $pdo->query("SELECT * FROM catagories"); 
if(isset($_GET['key'])){    //checking for availablity of key
		$take = $pdo->prepare("SELECT product_name,product_id FROM products WHERE product_name like '%:key%'"); // to retrive data of  product name and and product id    SEARCH BLOCK
		$take->execute($_GET);           //execute statement
		$search_data=$take->fetch();    // fetch 
	require 'product.php';
}
?>
<html>
	<head>
		<title>Ed's Electronics</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="electronics.css" />
	</head>

	<body>
		<header>
			<h1>Ed's Electronics</h1>
				<ul>
					<li><a href="home.php ?>">Home</a></li>
					<li>Category
				<ul>
					<?php foreach($display as $row){?>
					<li><a href="home.php?cat_id=<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></a>  <!-- to display the category in drop down method -->
					</li>
							<?php } ?>	
				</ul>


					</li>
					<?php
					if(!isset($_SESSION['type'])){?>     <!-- //if any user is not login then login will display in header -->
					<li><a href="login.php ?>">Log In</a></li>

				<?php } ?>

				</ul>

			<address>
				<p>We are open 9-5, 7 days a week. Call us on

					<strong>01604 11111</strong>
				</p>
				<header>
					<?php
					if(isset($_SESSION['type'])){?>        <!--   if user is login then logout will display  -->

					<ul> 
						<li><a href="logout.php">Log out</a></li>

					</ul> 

					<?php } ?>
				</header>

			</address>


		</header>
		<section>
			
		</section>
		<div class="left">                   <!-- search block -->
				<form action="" method="GET">
					<label><strong>Serch:</strong></label>
					<input id="search" name="key" type="text" placeholder="Type...">
					<input id="submit" type="submit" value="Search">
			</form>
					<?php if(isset($search_data['product_name'])){echo $search_data['product_name'];}?>
		</div>

		<main>
			<?php echo $main?>			
		</main>
		

		<aside>

		<h1><a href="#">categories</a></h1>
			<ul>
				<?php foreach($result as $row){?>        <!--   display categories in right bar -->
				<li><a href="home.php?cat_id=<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?>  
				</a>
				</li>
			<?php } ?>
		 </ul>
		</aside>

		<footer>
			&copy; Ed's Electronics 2018
		</footer>
	</body>
</html>
