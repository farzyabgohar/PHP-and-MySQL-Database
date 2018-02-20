<?php

if (isset($_POST['submit']))
{
	
	require "config.php";

	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);

		$new_user = array(
			"StudentID"  => $_POST['StudentID'],
			"firstname" => $_POST['firstname'],
			"lastname"  => $_POST['lastname'],		
			"email"     => $_POST['email'],
			"age"       => $_POST['age']
			
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"users",
				implode(", ", array_keys($new_user)),
				":" . implode(", :", array_keys($new_user))
		);

		$statement = $connection->prepare($sql);
		$statement->execute($new_user);

	}

	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>

<!doctype html>



<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>First PHP Database App</title>
	

	<link rel="stylesheet" href="css/style.css">
</head>

<body>
<h2> Add a Student </h2>

<form method="post">
	<label for="StudentID">Student ID</label>
	<input type="text" name="StudentID" id="StudentID">
	<label for="firstname">First Name</label>
	<input type="text" name="firstname" id="firstname">
	<label for="lastname">Last Name</label>
	<input type="text" name="lastname" id="lastname">
	<label for="email">Email Address</label>
	<input type="text" name="email" id="email">
	<label for="age">Age</label>
	<input type="text" name="age" id="age">
	<br> </br>
	<br><input type="submit" name="submit" value="Submit" style="height:25px; width:167px;"><br>
</form>

<a href="index.php">Go back to home</a>


</body>
</html>