<?php 
	include "config.php";
	session_start();

	if(isset($_POST['approvestd'])){
		$output = '';

		echo ' <div class="breadcrumbs" style="background: #1b2a47; color: white;">
            <div class="col-sm-4">
                <div class="page-header float-left" style="background: #1b2a47; color: white;">
                    <div class="page-title">
                        <h1>Approved Students</h1>
                    </div>
                </div>
            </div>
        </div>';

		$sql = "SELECT * FROM students WHERE status='1'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				$id = $row['id'];
				$matric = $row['matricno'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$email = $row['email'];
				$faculty = $row['faculty'];
				$department = $row['department'];
				$level = $row['level'];
				$date = $row['dateRegistered'];
				$status = $row['status'];
				$image = $row['image'];

				$output.= "
					<div class='container-fluid'>
				<div class='col-md-3'>
					<div class='card' style='background: #1b2a47; color: white;'>
  						<img class='card-img-top' src='../student/images/$image' height='200'>
  						<div class='card-body'>
  							<h5 class='card-title'>$firstname $lastname</h5>
    						<h6 class='card-subtitle mb-2 text-muted'>$matric</h6>
    						<h6 class='card-subtitle mb-2 text-muted'>$department</h6>
    						<h6 class='card-subtitle mb-2 text-muted'>$level Level</h6>
    						<p><button type='button' class='btn btn-info' pid='$id' id='viewstudent' data-toggle='modal' data-target='#exampleModal2'>View</button>
    							<button type='button' class='btn btn-danger' pid='$id' id='deletestudent'>Delete</button><br>
    							<button type='button' class='btn btn-secondary' pid='$id' id='viewbooktransaction'>View Book Transactions</button>
    							
    						</p>
  						</div>
					</div>
				</div>
				</div>
				";

			}
		}

		echo $output;

	}

	if(isset($_POST['viewstudent'])){
		$pid = $_POST['pid'];

		$output='';

		$sql = "SELECT * FROM students WHERE id='$pid'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				$id = $row['id'];
				$matric = $row['matricno'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$email = $row['email'];
				$faculty = $row['faculty'];
				$department = $row['department'];
				$level = $row['level'];
				$date = $row['dateRegistered'];
				$status = $row['status'];
				$image = $row['image'];

					$output.= '			
                       <table class="table table-responsive table-hover">
          
                        <tbody>                             
		';

					$output.= "
					<tr>
						<th>Image</th>
						<td>
							<img src'../student/images/$image' height='200'>
						</td>
					</tr>
					<tr>
						<th>Matric No</th>
						<td>$matric</td>
					</tr>
					<tr>
						<th>First Name</th>
						<td>$firstname</td>
					</tr>
					<tr>
						<th>Last Name</th>
						<td>$lastname</td>
					</tr>
					<tr>
						<th>Department</th>
						<td>$department</td>
					</tr>
					<tr>
						<th>Level</th>
						<td>$level</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>$email</td>
					</tr>
					<tr>
						<th>Date Registered</th>
						<td>$date</td>
					</tr>
					";

					if($status == '0'){
					$output.= "
					<tr>
						<th>Status</th>
						<td>
							<span class='badge badge-warning'>Not Approved</span>
						</td>
					</tr>
					";
				}elseif($status == '1'){
					$output.= "
					<tr>
						<td>
							<span class='badge badge-success'>Approved</span>
						</td>
					</tr>
					";
				}

				}
			}
			$output.='
			</tbody>
                                </table>

                            
		';


		echo $output;
	}

	if(isset($_POST['notapprovestd'])){
		$output = '';
		echo ' <div class="breadcrumbs" style="background: #1b2a47; color: white;">
            <div class="col-sm-4">
                <div class="page-header float-left" style="background: #1b2a47; color: white;">
                    <div class="page-title">
                        <h1>Not Approved Students</h1>
                    </div>
                </div>
            </div>
        </div>';

		$sql = "SELECT * FROM students WHERE status='0'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				$id = $row['id'];
				$matric = $row['matricno'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$email = $row['email'];
				$faculty = $row['faculty'];
				$department = $row['department'];
				$level = $row['level'];
				$date = $row['dateRegistered'];
				$image = $row['image'];
				$status = $row['status'];

				$output.= "
					<div class='container-fluid'>
				<div class='col-md-3'>
					<div class='card' style='background: #1b2a47; color: white;'>
  						<img class='card-img-top' src='../student/images/$image' height='200'>
  						<div class='card-body'>
  							<h5 class='card-title'>$firstname $lastname</h5>
    						<h6 class='card-subtitle mb-2 text-muted'>$matric</h6>
    						<h6 class='card-subtitle mb-2 text-muted'>$department</h6>
    						<h6 class='card-subtitle mb-2 text-muted'>$level Level</h6>
    						<p><button type='button' class='btn btn-info btn-xs' pid='$id' id='viewstudent' data-toggle='modal' data-target='#exampleModal2'>View</button>
    							<button type='button' class='btn btn-danger btn-xs' pid='$id' id='deletestudent'>Delete</button>
    							<button type='button' class='btn btn-success btn-sm approveStd' id='approveStd' pid='$id'>Approve Student</button>
    						</p>
  						</div>
					</div>
				</div>
				</div>
				";
			}
		}else{
			echo "<h3>No Students</h3>";
		}
		echo $output;

	}

	if(isset($_POST['deletestudent'])){
		$pid = $_POST['pid'];
		
		$sql = "DELETE FROM students WHERE id='$pid'";
		$query = $connection->query($sql);
		if($query){
			echo 'Student Deleted Successfully';
		}
	}

?>