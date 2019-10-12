<?php
	include "config.php"; 
	session_start();

	if(isset($_POST['dashboard'])){

	$output = '';

	$output.= '
		<div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat bg-dark">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count" id="registerStd"></span>
                        </h4>
                        <p class="text-light">Registered Student</p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat bg-dark">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count" id="addedbook"></span>
                        </h4>
                        <p class="text-light">Books Added</p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat bg-dark">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count" id="issuedbook"></span>
                        </h4>
                        <p class="text-light">Issued Books</p>

                    </div>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart3"></canvas>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat bg-dark">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count" id="notreturnbook"></span>
                        </h4>
                        <p class="text-light">Not Returned Books</p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>
		';

		$output.= '
			<div class="col-lg-12">
                <div class="card">
                
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-content">
                              <div class="stat-text"><h4>Recent Registered Students</h4></div><br>
                              <div id="msg"></div>
                              <table class="table table-hover table-responsive">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Matric No</th>
                                            <th scope="col">FirstName</th>
                                            <th scope="col">LastName</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        
                                       
                                        
                                    </tbody>
                                </table>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		';
		echo $output;
	}

	if(isset($_POST['recent'])){
		$output = '';

		$sql = "SELECT * FROM students ORDER BY id DESC LIMIT 7";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				$id = $row['id'];
				$matric = $row['matricno'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$email = $row['email'];
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
		}
		echo $output;

	}
	

	if(isset($_POST['approvedId'])){
		$studentId = $_POST['sid'];

		$sql = "SELECT * FROM students WHERE id='$studentId'";
		$query = $connection->query($sql);

		$row = mysqli_fetch_array($query);
		$status = $row['status'];
		if($status == '1'){
			echo '
				<div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                	Student Approved Already
              </div>
			';
		}else{
			$sql2 = "UPDATE students SET status='1' WHERE id='$studentId'";
		$query2 = $connection->query($sql2);
		if($query2 === TRUE){
			echo '
				<div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Student Approved Successfully
              </div>
			';
		}
		}

		
	}

	if(isset($_POST['registerstd'])){
		$sql = "SELECT * FROM students";
		$query = $connection->query($sql);
		$count = mysqli_num_rows($query);
		if($count){
			echo $count;
		}else{
			echo "0";
		}
	}

	if(isset($_POST['addedbook'])){
		$sql = "SELECT * FROM add_books";
		$query = $connection->query($sql);
		$count = mysqli_num_rows($query);
		if($count){
			echo $count;
		}else{
			echo "0";
		}
	}

	if(isset($_POST['issuebook'])){
		$sql = "SELECT * FROM issue_books";
		$query = $connection->query($sql);
		$count = mysqli_num_rows($query);
		if($count){
			echo $count;
		}else{
			echo "0";
		}
	}

	if(isset($_POST['notreturnbook'])){
		$sql = "SELECT * FROM issue_books WHERE status='0'";
		$query = $connection->query($sql);
		$count = mysqli_num_rows($query);
		if($count){
			echo $count;
		}else{
			echo "0";
		}
	}
	

?>