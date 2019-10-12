<?php 
	include "config.php";
	if(isset($_POST['submit'])){

		$matric = $_POST['matric'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$faculty = $_POST['faculty'];
		$department = $_POST['department'];
		$level = $_POST['level'];
		$password = $_POST['password'];
		$dateRegistered = date('Y-m-d');
		

		if(!empty($matric) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($faculty) && !empty($department) && !empty($level) && !empty($password)){

			$sql = "SELECT matricno FROM students WHERE matricno='$matric'";
			$query = $connection->query($sql);
			if($query->num_rows > 0){
				echo "matric no already exists";
			}
			else{

				$sql2 = "INSERT INTO students (matricno, firstname, lastname, email, faculty, department, level, password, status, dateRegistered)
					VALUES ('$matric', '$firstname', '$lastname', '$email', '$faculty', '$department', '$level', '$password', '0', '$dateRegistered')";
				$query2 = $connection->query($sql2);
				if($query2){
					echo 'student registered successfully';
				}
			}
		}
	}

?>