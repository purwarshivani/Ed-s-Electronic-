
<?php
session_start();
if(isset($_SESSION['type'])){  // session started
	if($_SESSION['type']=='admin'){    // checked for type admin
require 'connect.php';
require 'feature.php';


 if(isset($_GET['product_id'])){
 	$uptodate = $pdo->prepare("UPDATE products SET feature_status = 0 WHERE product_id =:product_id");  // update table and set feture products value 0 in table products
 	$uptodate->execute($_GET);
}
if(isset($_POST['product_name'])){	
	$select = $pdo->prepare("UPDATE products SET feature_status = 1 WHERE product_id =:product_id");   // if POST product_name  set feature_status as 1
	$select->bindValue('product_id',$_POST['product_name']);
	$select->execute();	
}

$st = $pdo->prepare("SELECT product_name,feature_status,product_id FROM products WHERE feature_status=1"); //select query from product where feature_status is 1
$st->execute();
$proced = $pdo->prepare("SELECT * FROM products where feature_status=0");
//$proced->bindValue(':product_id',$_POST['product_id']);
$proced->execute();
ob_start();
?>
<main>
	<h1>Welcome to Ed\'s Electronics</h1>

			<p>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</p>
			
				<!-- form created change status -->
			<form action="" method="POST"> 
				<h2>Hey! Admin please select product to change its status :')</h2>
				<select name="product_name">
					<?php foreach($proced as $row){?>
					<option value="<?php echo $row['product_id']?>"><?=$row['product_name']?> 
				</option>
				<?php } ?>
				</select>
				<input type="submit" name="feature" value="selected"> 
			</form>
			
</main>

<?php

//dispaly 
$table = new Tab();  // function called by object
$table->setHeading(['product_name','feature_status','product_id']);
if($st->rowCount()!=0){
foreach ($st as $row) {
	$row['action']='
			<a href ="#" onClick = "javascript:if(confirm(\'Are you sure ?\')){
						document.location=\'status.php?product_id='.$row['product_id'].'\';} "></a>';
	$table->addingRow($row);
	
	
	}

	echo $table->getH();
	}
	?>

 

<?php
$main=ob_get_clean();
require 'template.php';
}	

}
else{
	echo ' <div style="font-size:1.25em;color: RED;">FIRST YOU HAVE TO LOGIN </div>';

}?>
<form action="main.php" method="POST">
<input type="submit" name="back" value="back to page">
 </form>


