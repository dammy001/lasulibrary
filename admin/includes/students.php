<?php 
	include "config.php";
	session_start();

	if(isset($_POST['approvestd'])){
		$output = '';

		$output.= '
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
                            <div class="card-header">
                                <strong class="card-title">Approved Students</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Matric No</th>
                                            <th scope="col">FirstName</th>
                                            <th scope="col">LastName</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Faculty</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
		';

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

				$output.= "
				<tr>
					<td>$matric</td>
                    <td>$firstname</td>
                    <td>$lastname</td>
                    <td>$email</td>
                    <td>$faculty</td>
                    <td>$department</td>
                    <td>$level</td>
                    <td>$date</td>

				";

				if($status == '0'){
					$output.= "
						<td><span class='badge badge-warning'>Not Approved</span></td>
					";
				}elseif($status == '1'){
					$output.= "
						<td><span class='badge badge-success'>Approved</span></td>
					";
				}

				$output.= "

					</tr>
				";
			}
		}

		$output.='
			</tbody>
                                </table>

                            </div>
                        </div>
				</div>
			</div>
		';

		echo $output;

	}

	if(isset($_POST['notapprovestd'])){
		$output = '';

		$output.= '
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
                            <div class="card-header">
                                <strong class="card-title">Not Approved Students</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Matric No</th>
                                            <th scope="col">FirstName</th>
                                            <th scope="col">LastName</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Faculty</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
		';

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
				$status = $row['status'];

				$output.= "
				<tr>
					<td>$matric</td>
                    <td>$firstname</td>
                    <td>$lastname</td>
                    <td>$email</td>
                    <td>$faculty</td>
                    <td>$department</td>
                    <td>$level</td>
                    <td>$date</td>

				";

				if($status == '0'){
					$output.= "
						<td><span class='badge badge-warning'>Not Approved</span></td>
					";
				}elseif($status == '1'){
					$output.= "
						<td><span class='badge badge-success'>Approved</span></td>
					";
				}

				$output.= "
					<td><button type='button' class='btn btn-success btn-sm approveStd' id='approveStd' pid='$id'>Approve Student</button>
					</td>

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

                            </div>
                        </div>
				</div>
			</div>
		';

		echo $output;

	}

?>