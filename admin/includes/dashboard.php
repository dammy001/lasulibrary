<?php
	include "config.php"; 
	session_start();

	if(isset($_POST['dashboard'])){

		$output = '';
		
		$output.= '
			<div class="breadcrumbs" style="background: #1b2a47; color: white;">
            <div class="col-sm-4">
                <div class="page-header float-left" style="background: #1b2a47; color: white;">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right" style="background: #1b2a47; color: white;">
                    <div class="page-title">
                        <ol class="breadcrumb text-right"  style="background: #1b2a47; color: white;">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		';

	

	$output .= '
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="card text-white bg-flat" style="background: #1b2a47; color: white;">
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

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="card text-white bg-flat" style="background: #1b2a47; color: white;">
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

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="card text-white bg-flat" style="background: #1b2a47; color: white;">
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

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="card text-white bg-flat" style="background: #1b2a47; color: white;">
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
			<div class="col-md-12">
                <div class="card" style="background: #1b2a47; color: white;">
                	<div class="card-body">
                		<div class="stat-widget-one">
                			<div class="stat-content">
                				<div id="msg"></div>
                				<div class="stat-text">
                					<h4 style="color: white">Recent Registered Students</h4>

                				</div>
                				<table class="table table-hover table-responsive">
                					<thead style="background: #152036; color: white;">
                						<tr style="background: #152036; color: white;">
                                            <th scope="col">Matric No</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">FirstName</th>
                                            <th scope="col">LastName</th>
                                            
                                            <th scope="col">Department</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Approved By</th>
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
				$image = $row['image'];
				$matric = $row['matricno'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$email = $row['email'];
				$department = $row['department'];
				$level = $row['level'];
				$date = $row['dateRegistered'];
				$status = $row['status'];
				$approveBy = $row['approveBy'];

				$output.= "
					<tr>
						<td>$matric</td>
						<td><img src='../student/images/$image' height='100' width='100'></td>
						<td>$firstname</td>
                    	<td>$lastname</td>
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
					<td>$approveBy</td>
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
		$staffNo = $_SESSION['staffNo'];

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
			$sql2 = "UPDATE students SET status='1', approveBy='$staffNo' WHERE id='$studentId'";
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