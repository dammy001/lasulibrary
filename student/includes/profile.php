<?php 
	include("config.php");
	session_start();

	if(isset($_POST['profile'])){

		$matric = $_SESSION['matric'];
		$output = '';

		$sql = "SELECT * FROM students WHERE matricno='$matric'";
		$query = $connection->query($sql);

		$row = mysqli_fetch_array($query);

		$matric = $row['matricno'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$email = $row['email'];
		$faculty = $row['faculty'];
		$department = $row['department'];
		$level = $row['level'];

		$output.= "
		<div id='alert'></div>
			<div class='table-responsive'>
				<table class='table table-hover'>
					<form method='POST' action='#' id='updateform'>
						<tr>
							<div class='form-group'>
								<th>Matric No: </th>
								<td><input type='text' class='form-control' name='matricno' id='matricno' value='$matric' disabled></td>
							</div>
						</tr>
						<tr>
							<div class='form-group'>
								<th>First Name: </th>
								<td><input type='text' class='form-control' name='firstname' id='firstname' value='$firstname'></td>
							</div>
						</tr>
						<tr>
							<div class='form-group'>
								<th>Last Name: </th>
								<td><input type='text' class='form-control' name='lastname' id='lastname' value='$lastname'></td>
							</div>
						</tr>
						<tr>
							<div class='form-group'>
								<th>Email: </th>
								<td><input type='email' class='form-control' name='email' id='email' value='$email'></td>
							</div>
						</tr>
						<tr>
							<div class='form-group'>
								<th>Faculty: </th>
								<td><input type='text' class='form-control' name='faculty' id='faculty' value='$faculty' disabled></td>
							</div>
						</tr>
						<tr>
							<div class='form-group'>
								<th>Department: </th>
								<td><input type='text' class='form-control' name='department' id='department' value='$department' disabled></td>
							</div>
						</tr>
						<tr>
							<div class='form-group'>
								<th>Level: </th>
								<td><input type='text' class='form-control' name='level' id='level' value='$level'></td>
							</div>
						</tr>
						<tr>
						<td>
							<div class='form-group'>
								<button type='submit' class='btn btn-primary btn-lg' id='updatebtn' name='updatebtn'>Update</button>
							</div>
							</td>
						</tr>
					</form>
				</table>
			</div>
		";

		echo $output;

	}

	if(isset($_POST['update'])){
		$username = $_SESSION['matric'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$faculty = $_POST['faculty'];
		$department = $_POST['department'];
		$level = $_POST['level'];

		if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($level)){
			$sql = "UPDATE students SET firstname='$firstname', lastname='$lastname', email='$email', faculty='$faculty', department='$department', level='$level' WHERE matricno='$username'";
			$query = $connection->query($sql);
			if($query){
				echo '<div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Profile Update Successfully
              </div>';
			}
		}
	}

?>