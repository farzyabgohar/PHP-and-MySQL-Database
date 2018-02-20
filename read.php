

<?php
//check if user requested to search for an entry
//if entry found, fetch it
if (isset($_POST['submit'])) 
{

	try 
	{
		require "config.php";

		$connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT * 
				FROM users
				WHERE StudentID = :StudentID";
		$StudentID = $_POST['StudentID'];
		$statement = $connection->prepare($sql);
		$statement->bindParam(':StudentID', $StudentID, PDO::PARAM_STR);
		$statement->execute();
		
		$result = $statement->fetchAll();
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

<?php
	
	//check if user request for entry is valid, and if entry exists
	//if entry exists, print it to web page
	//this block of code will make use of the result variable in the top part, where the fetched data is stored
	if (isset($_POST['submit'])) 
	{
		if ($result && $statement->rowCount() > 0) 
		{
			echo '<h2> Results </h2>';
			echo '<table width = "50%" border="1" cellpadding="5" cellspacing="5">
					<tr>
						<th> Student ID </th>
						<th> First Name </th>
						<th> Last Name </th>
						<th> Email </th>
						<th> Age </th>
					</tr>';
					
			foreach($result as $row){
				echo '<tr>
						<td>'.$row["StudentID"].'</td>
						<td>'.$row["firstname"].'</td>
						<td>'.$row["lastname"].'</td>
						<td>'.$row["email"].'</td>
						<td>'.$row["age"].'</td>
					</tr>';
			}
			
			echo '</table>';
		}
	}
?>
<h2>Find user based on Student ID</h2>

<form method="post">
	<label for="StudentID">Student ID</label>
	<input type="text" id="StudentID" name="StudentID">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Go back to home</a>
</body>
</html>