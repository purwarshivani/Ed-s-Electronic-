<?php
session_start();
if(isset($_SESSION['type'])){  // testing, checking for type
	if($_SESSION['type']=='admin'){   // testing wheather the type is admin or not
$display= [];    // declaring $display as gloabl;
require 'connect.php';        // connect to connect.php 
if(isset($_POST["submit"])){      // testing, cheking for submit post by POST method
$dir = "images/";                
	$file = $dir.basename($_FILES['image']['name']);  // created variable file for images
	if (getimagesize($_FILES['image']['tmp_name'])==false) { //checking wheather the size of file is appropriate
		echo"edit the size of file";
		
	}
	else{
		if(move_uploaded_file($_FILES['image']['tmp_name'], $file)){   // codition to move uploaded images
			$querry = "INSERT INTO products (product_name,product_description,product_price,cat_id,image_name)
				VALUES(:product_name,:product_description,:product_price,:cat_id,:image_name)";  
				
				$query= $pdo->prepare($querry);
				unset($_POST['submit']);   //destroy the submit
				$_POST['image_name']=basename($_FILES['image']['name']);
				
					$query->execute($_POST);
		}
	}
	
}
else if(isset($_POST["edit"])){ // testing for edit
	$update ='UPDATE products SET product_name=:product_name,product_description=:product_description,product_price=:product_price, cat_id=:cat_id WHERE product_id =:editt_id';    // query for update table when edit is in exsiting coloum
	$stmt = $pdo->prepare($update);
	//binding values
	$stmt->bindValue(':editt_id',$_GET['editt_id']);
	$stmt->bindValue(':product_name',$_POST['product_name']);
	$stmt->bindValue(':product_description',$_POST['product_description']);
	$stmt->bindValue(':product_price',$_POST['product_price']);	
	$stmt->bindValue(':cat_id',$_POST['cat_id']);	
	$stmt->execute();  // execute statement
	header('loacation:product.php');
	
}

//Editing the products
if(isset($_GET['editt_id'])){
	$select = 'SELECT * FROM products WHERE product_id =:editt_id';
	$stmt = $pdo->prepare($select);
	$stmt->execute($_GET);
	$display=$stmt->fetch();
}

$select ="SELECT * FROM catagories";
$result = $pdo->query($select);



if(isset($_POST['AddCategory'])) {
	header('location:addproducts.php');
	
}
// when back got POST it will re-direct to main page
if (isset($_POST['back'])) {
	header('location:main.php');
}


?>
<?php 
ob_start();
 ?>

		<main>
			<!-- Form to addpeoduct edit and delete -->
			<form action="" method="POST" enctype="multipart/form-data">
				<h1>ADD product</h1>
				<label> Product name </label>
				<input type="text" name ="product_name" value=" <?php
				if($display!=null){
					echo $display['product_name'];}?>" />
				<label>product Description</label>
				<input type="textarea" name ="product_description" value=" <?php
				if($display!=null){
					echo $display['product_description'];}?>" />

				<label>product price</label>
				<input type="text" name ="product_price" value=" <?php
				if($display!=null){
					echo $display['product_price'];}?>" />
				<label> Catagories</label>
				<select name="cat_id">
					<?php foreach($result as $row){?> 
					<option value="<?php echo $row['cat_id']?>"><?=$row['cat_name']?> 
				</option>
			<?php } ?>
		</select>
			<label>Picture:</label>       <!-- button to submit the image with product details -->
				<input type="file" name="image"/>
				<input type="submit" name ="<?php
				if($display!=null){
					echo 'edit';}
					else{
						echo 'submit';
					}?>" value ="submit"/>
	
		</main>
		<?php
		$main = ob_get_clean();
		require 'template.php';
	}	

}
else{
	echo ' <div style="font-size:1.25em;color: RED;">FIRST YOU HAVE TO LOGIN </div>';

}?>
<form action="main.php" method="POST">
<input type="submit" name="back" value="back to page">  <!--  // back page will rediret in main page -->
 </form>

		