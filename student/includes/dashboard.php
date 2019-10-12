<?php 
	include("config.php");
	session_start();

	if(isset($_POST['dashboard'])){
		$output = '';
		$matric = $_SESSION['matric'];

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
		<div class='table-responsive'>
		<table class='table table-hover'>
			<div class='row'>
				 <div class='col-sm-6 col-lg-3'>
	             	<tr>
						<th><h4>Matric No</h4></th>
						<td><h5>$matric</h5></td>
						</tr>
	             </div>

	             <div class='col-sm-6 col-lg-3'>
	                <tr>
						<th><h4>First Name</h4></th>
						<td><h5>$firstname</h5></td>
						</tr>
	            </div>

	            <div class='col-sm-6 col-lg-3'>
	                <tr>
						<th><h4>Last Name</h4></th>
						<td><h5>$lastname</h5></td>
						</tr>
	            </div>

	            <div class='col-sm-6 col-lg-3'>
	                <tr>
						<th><h4>Email</h4></th>
						<td><h5>$email</h5></td>
						</tr>
	            </div>

	            <div class='col-sm-6 col-lg-3'>
	                <tr>
						<th><h4>Faculty</h4></th>
						<td><h5>$faculty</h5></td>
						</tr>
	            </div>

	            <div class='col-sm-6 col-lg-3'>
	                <tr>
						<th><h4>Department</h4></th>
						<td><h5>$department</h5></td>
						</tr>
	            </div>

	            <div class='col-sm-6 col-lg-3'>
	                <tr>
						<th><h4>Level</h4></th>
						<td><h5>$level</h5></td>
						</tr>
	            </div>
        	</div>
        </table>
        </div>
		";

		echo $output;
	}

	if(isset($_POST['viewissuedbook'])){

		$matric = $_SESSION['matric'];

		$sql = "SELECT * FROM issue_books WHERE student_matricno='$matric' AND status='0'";

		$query = $connection->query($sql);

		if($query->num_rows > 0){
			while($row = $query->fetch_array()){

				$id = $row['id'];
				$matric = $row['student_matricno'];
                $bookname = $row['book_name'];
				$bookissuedate = $row['book_issue_date'];
				$bookreturndate = $row['book_return_date'];

				echo "
				<div class='row'>
                            <div class='col-md-1'></div>
                            <div class='col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12'>
                            <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog' role='document'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title' id='exampleModalLabel'>Case Details</h5>
                                                                <a href='#' class='close' data-dismiss='modal' aria-label='Close'>
                                                                            <span aria-hidden='true'>&times;</span>
                                                                        </a>
                                                            </div>
                                                            <div class='modal-body' id='casedetails'>
                                                                
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <a href='#' class='btn btn-secondary' data-dismiss='modal'>Close</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                           
                                <div class='card'>

                                    <div class='card-body p-2'>
                                    	<div class='table-responsive'>
                                            <table class='table table-hover'>
                                                <thead class='bg-dark'>
                                                    <tr class='border-0' style='color:white;'>
                                                    	 <th class='border-0'>Matric No</th>
                                                        <th class='border-0'>Book Name</th>
                                                        <th class='border-0'>Book Issue Date</th>
                                                        <th class='border-0'>Book Return Date</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<tr>
								                        <td>$matric</td>
                                                        <td>$bookname</td>
								                        <td>$bookissuedate</td>
								                        <td>$bookreturndate</td>
								                        
			
								                    </tr>
                                                </tbody>    
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        
                        </div>

                      ";
				
			}
	}else{
		echo "<center><h3 style='text-align: center;'>No Book Issued</h3></center>";
	}
	}

	if(isset($_POST['transaction'])){

		$matric = $_SESSION['matric'];
		$output = '';

		$output.= '
								
                                <table class="table table-hover table-responsive-md">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Matric No</th>
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

		$sql = "SELECT * FROM issue_books WHERE student_matricno='$matric'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				

				$id = $row['id'];
				$matric = $row['student_matricno'];
				$email = $row['student_email'];
				$book = $row['book_name'];
				$issuedate = $row['book_issue_date'];
				$returndate = $row['book_return_date'];
				$status = $row['status'];

				$output.= "
				<tr>
					<td>$matric</td>
                    <td>$email</td>
                    <td>$book</td>
                    <td>$issuedate</td>
                    <td>$returndate</td>
                   
				";

				if($status == '0'){
					$output.= "
						<td><span class='badge badge-warning'>Not Returned</span></td>
						
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
				<td><h4>No Transaction</h4></td>
			';
		}

		$output.='
			</tbody>
                                </table>
                               

		';

		echo $output;

	}
?>