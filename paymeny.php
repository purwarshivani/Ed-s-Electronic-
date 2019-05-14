<?php
session_start(); // started session 
require 'connect.php';  // link in connenct.php for database connection
require 'feature.php';  // link in feature.php for table generator.

function retrive($product_id){       // function to retrive data when users click to add in shopping cart
	require 'connect.php';

	$select ='SELECT product_name,product_description, product_price FROM products WHERE product_id = :product_id';
	//select query from products
$prepare=$pdo->prepare($select); // prepared above query to execute
$prepare->bindValue('product_id', $product_id);  //bindvalue of product_id
$prepare->execute();   // excute statement
return $prepare->fetch();   //fetch seleted data of the selected products

}
if(isset($_GET['submit'])){
	if(isset($_SESSION['user_id'])){
	//$product_id = $_GET['product_id'];
	$value = retrive($_GET['product_id']);
	$get = retrive($_GET['product_id']);
	$insert =$pdo->prepare('INSERT INTO shopping(user_id,product_id,amount,quantity)  
	VALUES(:user_id,:product_id,:product_price,1)');    // query to insert data in table shopping 
	$insert->bindValue('user_id', $_SESSION['user_id']);
	$insert->bindValue('product_id', $_GET['product_id']);
	$insert->bindValue('product_price', $get['product_price']);
}
else{
	header('location:login.php');
}

	$insert->execute();
}


if(isset($_GET['submit'])){
	

}


$shoppinglist = new Tab();
?>

<?php
ob_start();
?>
<main>
	<h1>Welcome to Ed's Electronics</h1>

	<label><strong>YOUR SHOPING DETAIL</strong></label>

<?php
	$shoppinglist->setHeading(['product','Description','amount']);
	
		


		$shoppinglist->addingRow($value);




echo $shoppinglist->getH();
	?>
	

		


					<a href="payed.php?submit='aaich'& product_id=<?php?>">
			 <input type="image" name="submit"
			src="images/buy.gif" alt=" The safest way of online payment"></a>



					


</main >
<?php
$main = ob_get_clean();

		require 'template.php'; 
?>