<?php
session_start();  //start session
if(isset($_SESSION['type'])){   // testing for type
	if($_SESSION['type']=='admin'){   // tetsing wheather the type is admin

require 'connect.php';
if(isset($_GET['del_id'])){   // checking for del_id
$delreview = "DELETE FROM reviews WHERE review_id = :del_id;";  // query for review 
	$remove = $pdo->prepare($delreview);
	$remove->execute($_GET);

}
if (isset($_GET['approved_id'])) {    // checking for approved_id
	if(isset($_SESSION['user_id'])){    // testing for user_id
		
	$set = "UPDATE reviews SET approved = 1 WHERE review_id = :approved_id;";  // query to set 1 in approved in review table
	$aprove->bindValue(':approved_id' ,$_GET['approved_id']);   // bindvalue of approved_id
	$aprove->execute();

}
else{
	header('location:login.php');
}
}
$review = $pdo->query("SELECT * FROM reviews WHERE approved = 0;");// query to select the reviews which are not approved.
ob_start();
?>
<main>
	<h1>Welcome to Ed's Electronics</h1>

			<p>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</p>
			<table border="2">
				<tr>
					<th> REVIEWS</th>
				
				</tr>
			<?php foreach ($review as $row) {?>   // will set results as row

				
				<tr>
					<td><?=$row['review_text']?> </td>
					<td><a href ="#" onClick ="javascript:if(confirm('Are you sure ?')){
						document.location ='review.php?del_id=<?=$row['review_id']?>';}">DELETE
						</a>

						           <!--  Confirm dilogue box -->
					</td>
					<td><a href ="#" onClick = "javascript:if(confirm('Are you sure ?')){
						document.location='review.php?approved_id=<?=$row['review_id']?>';} "> approved
					</a>

					</td>
					

				</tr>
		
			<?php }  ?>

			</table>





					
</main>
<?php
$main=ob_get_clean();
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
 