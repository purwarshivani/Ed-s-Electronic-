<?php
require 'connect.php';

if(isset($_GET['del_id'])){  // tetsing for del_id
	$delete = 'DELETE FROM catagories WHERE cat_id= :del_id';   // delete query for tabe categgories
	$stmt = $pdo->prepare($delete);
	
	$stmt->execute($_GET);
}

$query = $pdo->query("SELECT * FROM catagories");  //select from categories

if(isset($_POST['AddCategory'])) {
	header('location:add.php');
	
}
ob_start();
?>


<main>
			<form action="" method="POST">
				<h1>Category of products</h1>
				<input type="submit" name="AddCategory" value="Add Catagory"/>
				
				</form>
			<table>
				<tr>
					<th>Catagory</th>
				</tr>
				
				<?php foreach( $query as $row){ ?>
					<tr>
					<td><?=$row['cat_name']?> </td>
					<td><a href ="#" onClick ="javascript:if(confirm('Are you sure ?')){
						document.location ='categories.php?del_id=<?=$row['cat_id']?>';}">DELETE
						</a>
									<!-- 	Confrim pop box -->

					</td>
					<td><a href ="#" onClick = "javascript:if(confirm('Are you sure ?')){
						document.location='add.php?edit_id=<?=$row['cat_id']?>';} "> EDIT
					</a>

					</td>




				</tr>
				<?php } ?>
				

			</table>			
			

		</main>
		<?php
		$main = ob_get_clean();

		require 'template.php'; 
		 ?>


		

