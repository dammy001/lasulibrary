<?php
	include "config.php";
	session_start();

	if(isset($_POST['issuebook'])){
		$output = '';
		$option = $_POST['option'];
		$date = date('d-M-Y');

		$sql = "SELECT * FROM students WHERE matricno='$option'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			$row = mysqli_fetch_array($query);
			$matricno = $row['matricno'];
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$email = $row['email'];
			$department = $row['department'];
			$level = $row['level'];

		}

		$output.= "
		<br>
		<div class='col-lg-12'>
		<div id='alert'></div>
			<form method='POST' action='#' id='issue'>
				<div class='form-group'>
				    <label>Matric No</label>
				    <input type='text' class='form-control' id='matricno' name='matricno' placeholder='Matric No' value='$matricno' disabled  style='width: 400px;'>
				</div>
				<div class='form-group'>
				    <label>First Name</label>
				    <input type='text' class='form-control' id='firstname' name='firstname' placeholder='First Name' value='$firstname'>
				</div>
				<div class='form-group'>
				    <label>Last Name</label>
				    <input type='text' class='form-control' id='lastname' name='lastname' placeholder='Last Name' value='$lastname'>
				</div>
				<div class='form-group'>
				    <label>Email</label>
				    <input type='text' class='form-control' id='email' name='email' placeholder='Email' value='$email'>
				</div>
				<div class='form-group'>
				    <label>Department</label>
				    <input type='text' class='form-control' id='department' name='department' placeholder='Department' value='$department'>
				</div>
				<div class='form-group'>
				    <label>Level</label>
				    <input type='text' class='form-control' id='level' name='level' placeholder='Level' value='$level'>
				</div>
		";

		$output.= "
			<div class='form-group'>
				<label>Select Book</label>
				<select class='form-control' id='books'>
		";
		$sql2 = "SELECT * FROM add_books";
		$query2 = $connection->query($sql2);
		if($query2->num_rows > 0){
			while($row = mysqli_fetch_array($query2)){
				$bookName = $row['bookName'];

				$output.= "
							<option>$bookName</option>
				";
			}
		}
		$output.="
			</select>
		</div>
		";

		$output.= "
			<div class='form-group'>
				    <label>Book Issue Date</label>
				    <input type='text' class='form-control' id='issuedate' name='issuedate' placeholder='Issue Date' value='$date'>
				</div>
			<div class='form-group'>
				<button type='submit' class='btn btn-success' id='submitIssue'>Submit</button>
			</div>
		";

		$output.= "
			</form>
		</div>
		";

		echo $output;

	}

	if(isset($_POST['submitIssue'])){
		
		$matricno = $_POST['matric'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$department = $_POST['department'];
		$level = $_POST['level'];
		$book = $_POST['book'];
		$issuedate = $_POST['issuedate'];

		if(empty($matricno) && empty($firstname) && empty($lastname) && empty($email) && empty($department) && empty($level) && empty($book) && empty($issuedate)){

			echo '
						<div class="alert alert-warning">
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                Please Fill Neccessary Requirement
		              </div>
					';
		}else{
			$qty=0;
			$sql3 = "SELECT * FROM add_books WHERE bookName='$book'";
			$query3 = $connection->query($sql3);
			while($row = mysqli_fetch_array($query3)){
				$qty = $row['available_qty'];
			}
			if($qty == 0){
				echo '
					<div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                This Book is no longer available
              </div>
				';
				
			}else{

				$sql4 = "SELECT * FROM issue_books WHERE student_matricno='$matricno' AND book_name='$book' LIMIT 1";
				$query4 = $connection->query($sql4);
				if($query4->num_rows > 0){
					echo '
						<div class="alert alert-warning">
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                Book has been issued already
		              </div>
					';
					
				}else{

					$sql = "INSERT INTO issue_books (student_matricno, student_name, student_department, student_level, student_email, book_name, book_issue_date, book_return_date, status)

					VALUES('$matricno', '$firstname $lastname', '$department', '$level', '$email', '$book', '$issuedate', '', '0')";
				$query = $connection->query($sql);
				if($query === TRUE){

					$sql2 = "UPDATE add_books SET available_qty=available_qty-1 WHERE bookName='$book'";
					$query2 = $connection->query($sql2);
					if($query2 === TRUE){
						echo '
						<div class="alert alert-warning">
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                	Quantity Updated
		              </div>
					';
					}
						echo '
						<div class="alert alert-success">
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                Book Issued Successfully
		              </div>
					';
				}	
				}

				
			}
			
		}
	}

	if(isset($_POST['return'])){
		$option = $_POST['option'];
		$output = '';

		$output.= '
								
                                <table class="table table-hover table-responsive-md">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Student Matric No</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Student Department</th>
                                            <th scope="col">Student Level</th>
                                            <th scope="col">Student Email</th>
                                            <th scope="col">Book Issued</th>
                                            <th scope="col">Book Issued Date</th>
                                            <th scope="col">Book Returned Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
		';

		$sql = "SELECT * FROM issue_books WHERE student_matricno='$option'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				$id = $row['id'];
				$matric = $row['student_matricno'];
				$studentname = $row['student_name'];
				$department = $row['student_department'];
				$level = $row['student_level'];
				$email = $row['student_email'];
				$book = $row['book_name'];
				$issuedate = $row['book_issue_date'];
				$returndate = $row['book_return_date'];
				$status = $row['status'];

				$output.= "
				<tr>
					<td>$matric</td>
                    <td>$studentname</td>
                    <td>$department</td>
                    <td>$level</td>
                    <td>$email</td>
                    <td>$book</td>
                    <td>$issuedate</td>
                    <td>$returndate</td>
                   
				";

				if($status == '0'){
					$output.= "
						<td><span class='badge badge-warning'>Not Returned</span></td>
						<td><button type='button' class='btn btn-danger btn-sm returnbook' id='returnbook' pid='$id'>Return</button>
					</td>
					";
				}elseif($status == '1'){
					$output.= "
						<td><span class='badge badge-success'>Returned</span></td>
					";
				}

				$output.= "

					</tr>
				";
			}
		}else{
			$output.= '
				<td><h4>No Students</h4></td>
			';
		}

		$output.='
			</tbody>
                                </table>
                               

		';

		echo $output;

	}

	if(isset($_POST['returnbook'])){

		$studentId = $_POST['sid'];
		$date = date('d-M-Y');

		$sql = "SELECT * FROM issue_books WHERE id='$studentId' AND status='0'";
		$query = $connection->query($sql) or die(mysqli_error($connection));
		if($query->num_rows > 0){

			$row = mysqli_fetch_array($query);
			$bookName = $row['book_name'];
			$status = $row['status'];

			$sql2 = "UPDATE issue_books SET status='1', book_return_date='$date' WHERE id='$studentId'";
			$query2 = $connection->query($sql2);
			if($query2){

				$sql3 = "UPDATE add_books SET available_qty=available_qty+1 WHERE bookName='$bookName'";
				$query3 = $connection->query($sql3);
				if($query3 === TRUE){
					echo '
						<div class="alert alert-success">
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                Quantity Updated
		              </div>
					';
					
				}
				echo '
						<div class="alert alert-success">
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                Book Return Successfully
		              </div>
					';
				
		}else{
			echo '
						<div class="alert alert-warning">
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                Book has been returned already..
		              </div>
					';
			
		}

		

		
	}
}
?>