<?php
require 'connect.php';
if(isset($_POST["submit"])){     // checking for exsitance of submit button

	$insert= "INSERT INTO users( firstname , lastname, email, password, gender)
	VALUES (:firstname,:lastname,:email,:password,:gender);";                    // insert query to insert data in users
$stmt=$pdo->prepare($insert); // pdo prepared statement so to connect to databse

$hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);  //password hashed for security propose 
$stmt->bindValue(':firstname',$_POST['firstname']);
$stmt->bindValue(':lastname',$_POST['lastname']);
$stmt->bindValue(':email',$_POST['email']);
$stmt->bindValue(':password',$hashed);
$stmt->bindValue(':gender',$_POST['gender']);

$stmt->execute();  //execute statement

}

ob_start();
?>
		<main>
			<!-- signup Form -->
			<form style="background:url(images/sign.jpg);action="" method="POST">  
				<fieldset>
				<h1>Signup page</h1>
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
				<input type="checkbox" name="term" value="policy" checked="checked">I agree with all terms and policy of this website.</div><div>
				<input type="submit" name="submit" value="submit" /></div>
			</fieldset>
			</form>
			
		</main>
	<?php
	$main = ob_get_clean();     //buffer clean 
	require 'template.php';  // linking to template page.
	?>