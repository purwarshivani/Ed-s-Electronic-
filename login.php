
<?php
session_start();  // session start to assess global variable
require 'connect.php';   // connect to database

if(isset($_POST['login'])){     // checking for existance of login 
	$stmt = $pdo->prepare("SELECT * FROM users WHERE email =:email");  // query for retrive data from table users.
	$stmt->bindValue('email', $_POST['email']);  // binding value of email
	$stmt->execute();       // execute above query
	if($stmt->rowCount()!=0){      // testing for above query
		$display= $stmt->fetch();    // data fetch
		if(password_verify($_POST['password'],$display['password'])){          // verify for passwords
			
			if($display['user_type']=='admin'){               // testing whether the user_type is admin 
				header('location:main.php');
				$_SESSION['type']=$display['user_type'];
				$_SESSION['user_id']=$display['user_id'];
				$_SESSION['firstname']=$display['firstname'];
			$_SESSION['lastname']=$display['lastname'];
			}
			else{
				header('location:home.php');
				$_SESSION['type']=$display['user_type'];
			$_SESSION['firstname']=$display['firstname'];
			$_SESSION['lastname']=$display['lastname'];
			$_SESSION['user_id']=$display['user_id'];
			}
		}
		else{
			echo("RE-enter your email and password");   // if password or email is incorrect
			

		}

	}

}

if (isset($_POST['signup'])) {  // checking existance of signup
	header('location:signup.php');
}
?>
<script>
function visible(){                              // to make password visible
	 var show = document.getElementById("pass");
	if (show.type==="password"){
		show.type="text";
	}
	else{
		show.type = "password";
	}
}
 </script>


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
				</ul>
		</header>
		<section></section>
		<main>
			<h1>Welcome to Ed's Electronics</h1>
			
			<!-- created form for login -->
	<form  style="background:url(images/log.jpg);"action=""  method ='POST'>
		<fieldset>
		<h1>Login Page</h1>
		<label for="userName"><strong>email</strong></label><br>
		<input type="text" placeholder = " enter email here" name="email" required=""><br>
		<label for="password"><strong>Password</strong></label><br>
		<input type="password" placeholder="enter your password here" name="password" id="pass"  required=""><br>
		<input type="checkbox"onclick="visible()">Show password


		<br>
		
		<input type="submit" name="login" value="login">
	</form>
	<form action="" method="POST">                  <!-- //button for signup -->
		<input type="submit" name="signup" value="      
			Click to create your ID">              
	</fieldset>

		</form>
		
		</main>

	</body>

</html>
