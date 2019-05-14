<?php
session_start(); // session started
if(isset($_SESSION['type'])){   // testing type
	if($_SESSION['type']=='admin'){  // tetsing for admin
$display= [];
require 'connect.php';
if(isset($_POST["submit"])){    // tetsing for button submit
	$insert = "INSERT INTO catagories(cat_name)
				VALUES(:cat_name)";   // insert query of table categories
	$stmt=$pdo->prepare($insert);
	unset($_POST["submit"]); // unset button submit
	$stmt->execute($_POST);
	
}
else if(isset($_POST["edit"])){
	$update ="UPDATE catagories SET cat_name=:cat_name WHERE cat_id =:edit_id";  // update query of catagores and will set name of cat_name
	$stmt = $pdo->prepare($update);
	$stmt->bindValue(':edit_id',$_GET['edit_id']);  // vlaues are binded
	$stmt->bindValue(':cat_name',$_POST['cat_name']);		
	$stmt->execute();
	header('location:categories.php');
}
if(isset($_GET['edit_id'])){  // tetsing edit_id
	$update = "SELECT * FROM catagories WHERE cat_id =:edit_id";  //select query fprm categores
	$stmt = $pdo->prepare($update);
	$stmt->execute($_GET);
	$display = $stmt->fetch();
}

?>
<?php 
ob_start();
 ?>
		<main>
			<form action="" method="POST">
				<h1>ADD page</h1>
				<input type="text" name ="cat_name" value=" <?php
				if($display!=null){
					echo $display['cat_name'];}?>" />
				<input type="submit" name ="<?php
				if($display!=null){
					echo 'edit';}
					else{
						echo 'submit';
					}?>" value ="submit"/>
			</form>
		</main>
		<?php
		$main = ob_get_clean();
		require 'template.php';
	}	
}
		else{
			echo ' <div style="font-size:1.25em;color: RED;">FIRST YOU HAVE TO LOGIN </div>';

}
?>
			<form action="main.php" method="POST">
					<input type="submit" name="back" value="back to page">
 			</form>
