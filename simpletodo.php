<?php
	ob_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>To Do List</title>
</head>
<body>

	<?php

	define("server","localhost");
	define("username","root");
	define("password","root");
	define("database","todoDB");

	$conn = new mysqli(server,username,password,database);
	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}

	function setTask($taskname)
	{
		global $conn;
		$sql = "insert into todo(taskname,completed) values ('{$taskname}','Not Completed')";
		if($conn->query($sql) !== TRUE)
		{
			echo "Error creating table: " . $conn->error;
		}
	}


	function setCompleted($taskname)
	{
		global $conn;
		$sql = "update todo set completed = 'Completed' where taskname = '{$taskname}'";
		if($conn->query($sql) !== TRUE)
		{
			echo "Error creating table: " . $conn->error;
		}
	}


	function getAllTask()
	{
		global $conn;
		$sql = "select * from todo";
		$result = $conn->query($sql);

		while($list = $result->fetch_array())
		{
			echo "Task ".$list[0].": ".$list[1]." ".$list[2]."<br>";
		}

	}

	if(isset($_POST["taskname"]))
	{
		$taskname = $_POST["taskname"];
		setTask($taskname);
	}

	if(isset($_POST["taskCompleted"]))
	{
		$taskCompleted = $_POST["taskCompleted"];
		setCompleted($taskCompleted);
	}

	?>

	<form action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
		
		<input type="text" name="taskname" placeholder="Enter Task Name here">
		<br>
		<input type="submit" name="submit">
	</form>

	<br>
	<br>

	<h1>To Do List : </h1>
	<?php
		echo getAllTask();
	?>	
	<br><br>
	<br><br> 

	<form action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
		<input type="text" name="taskCompleted" placeholder="Enter completed Task">
		<br>
		<input type="submit" name="submit">
	</form>
	<br>
	<br>


</body>
</html>