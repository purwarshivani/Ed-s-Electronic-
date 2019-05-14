<?php
session_start();
if(isset($_SESSION['type'])){
	if($_SESSION['type']=='admin'){
require 'connect.php';
if(isset($_POST["submit"])){  // tetsing for submit button

	$insert= "INSERT INTO users( firstname , lastname, email, password,user_type, gender)
	VALUES (:firstname,:lastname,:email,:password,:user_type,:gender);"; // insert in table users
$stmt=$pdo->prepare($insert);

$hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);   // password hashed
$stmt->bindValue(':firstname',$_POST['firstname']);
$stmt->bindValue(':lastname',$_POST['lastname']);
$stmt->bindValue(':email',$_POST['email']);          // binding value
$stmt->bindValue(':user_type','admin');
$stmt->bindValue(':password',$hashed);
$stmt->bindValue(':gender',$_POST['gender']);

$stmt->execute();

}

//select query for table users 
$select =$pdo->query("SELECT user_id, firstname FROM users WHERE user_type= 'admin' ");
$run = $pdo->query("SELECT user_id,firstname FROM users WHERE user_type = 'user'");

if(isset($_GET['delete_id'])){  // tetsing for delete_id
	$remove = $pdo->prepare("DELETE FROM users WHERE user_id=:delete_id");  // delete query for users


	$remove->execute($_GET);
}


require 'feature.php'; // linking to feature php
$userlist = new Tab(); // function tab() is called
$adminList = new Tab();

?>

<?php
ob_start();
?>
<main>
	<h1>Welcome to Ed's Electronics</h1>
	 										<!-- form to create Admin -->
		<form action="" method="POST">
			<fieldset>

				<h1>CREATE ADMIN</h1>
				<div>
				<label>First Name:</label>
				 <input type="text" placeholder="Enter your first name here" name="firstname" required="" /></div><div>
				<label>Last name</label>
				 <input type="text" placeholder= "enter your last name"name="lastname" required="" /></div><div>
				<label>Email address</label>
				 <input type="text" name="email" placeholder="enter your email address"  required="" optional /></div><div>
				<label>Password</label>
				 <input type="Password" name="password" required="" /></div><div>
				<label>Confrim password</label>
				<input type="password" name="conform" required=""></div><div>

				<input type="radio" name="gender" value="M" checked>MALE</div><div>
				<input type="radio" name="gender" value="F">Female</div><div>
				<input type="radio" name="gender" value="O">other</div><div>



				<input type="submit" name="submit" value="submit" /></div>
</fieldset>
	</form>
	<label><strong>Admin List:</strong></label>
<?php
	$adminList->setHeading(['username','delete']);   //set title name
	foreach($select as $row){
	$row['delete']='<a href ="#" onClick ="javascript:if(confirm(\'Are you sure ?\')){
						document.location =\'userlist.php?delete_id='.$row['user_id'].'\';}">DELETE
						</a>';

						unset($row['user_id']);
	$adminList->addingRow($row);    // adding row
}
echo $adminList->getH();
?>
<label><strong>USER LIST:</strong></label>
<?php
	$userlist->setHeading(['username','delete']); // seting heading
	foreach($run as $row){
	$row['delete']='<a href ="#" onClick ="javascript:if(confirm(\'Are you sure ?\')){
						document.location =\'userlist.php?delete_id='.$row['user_id'].'\';}">DELETE
						</a>';

						unset($row['user_id']);
	$userlist->addingRow($row);
}
echo $userlist->getH();  // useing getH function
?>	
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
<input type="submit" name="back" value="back to page">
 </form>

