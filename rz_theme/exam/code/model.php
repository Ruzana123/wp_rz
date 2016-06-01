<?php 

if (!defined("HOME")) {
    die('Сторінка не доступна.');
}

	$servername = "localhost";
	$username = "ruzana";
	$password = "yzrjctyctq";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=exam", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    }
	catch(PDOException $e)
	    {
	    echo "Connection failed: " . $e->getMessage();
	    }
	global $conn;



function all_task(){
	global $conn;
	try {
		$stmt = $conn->prepare("SELECT * FROM `task` "); 
		$stmt->execute();
		$task=$stmt->fetchAll();
		return($task);
	    }
	catch(PDOException $e)
	    {
	    echo "Error: " . $e->getMessage();
	    }
}

function add_task(){
	global $conn;
	if (empty( $_POST["text"])) {
        add_errors('Введіть завдання');
    }
    else{    	
    	try {
			$stmt = $conn->prepare("INSERT INTO `task` (`text`) VALUES (:task)"); 
			$stmt->bindParam( ":task", $_POST["text"]);
			$stmt->execute();			
		    }
		catch(PDOException $e)
		    {
		    	echo "Error: " . $e->getMessage();
		    }
		
    }   
}
	

function delete_task($id){
	global $conn;
	try {
	$stmt = $conn->prepare("DELETE FROM `task` WHERE `task`.`id` = $id"); 
	$stmt->execute();
    }
	catch(PDOException $e)
    {
    	echo "Error: " . $e->getMessage();
    }
}


function task_todos($id){
	global $conn;
	try {
	$stmt = $conn->prepare("SELECT `mark` FROM `task` WHERE `task`.`id` = $id"); 
	$stmt->execute();
	$mark=$stmt->fetch();
	return $mark['mark'];
    }
	catch(PDOException $e)
    {
    	echo "Error: " . $e->getMessage();
    }
}

function task_mark($id,$new_mark){
	global $conn;
	try {
	$stmt = $conn->prepare("UPDATE `task` SET `mark`=$new_mark WHERE `task`.`id` = $id"); 
	$stmt->execute();
    }
	catch(PDOException $e)
    {
    	echo "Error: " . $e->getMessage();
    }
}

?>