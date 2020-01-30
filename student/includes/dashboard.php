<?php 
	include("config.php");
	session_start();

	function timeago($timestamp){
		$timeago = strtotime($timestamp);
		$currenttime = time();
		$timedifference = $currenttime - $timeago;
		$seconds = $timedifference;
		$minutes = round($seconds / 60);
		$hours = round($seconds / 3600);
		$days = round($seconds / 86400);
		$weeks = round($seconds / 604800);
		$months = round($seconds / 2629440);
		$years = round($seconds / 31553280);

		if($seconds <= 60){
			return "Just Now";
		}
		else if($minutes <= 60){
			if($minutes == 1){
				return "One minute ago";
			}else{
				return "$minutes minutes ago";
			}
		}
		else if($hours <=24){
			if($hours == 1){
				return "One hour ago";
			}else{
				return "$hours hours ago";
			}
		}
		else if($days <=7){
			if($days == 1){
				return "One day ago";
			}else{
				return "$days days ago";
			}
		}
		else if($weeks <= 4.3){
			if($weeks == 1){
				return "A week ago";
			}else{
				return "$days days ago";
			}
		}
		else if($months <= 12){
			if($months == 1){
				return "One month ago";
			}else{
				return "$months months ago";
			}
		}
		else{
			if($years == 1){
				return "One year ago";
			}else{
				return "$years years ago";
			}
		}
	}

	if(isset($_POST['dashboard'])){
		$output = '';
		$matric = $_SESSION['matric'];

		$output.= '
			<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		';

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
		<div class='container-fluid'>
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
        </div>
		";

		echo $output;
	}

	if(isset($_POST['viewissuedbook'])){

		$matric = $_SESSION['matric'];
		$output = '';

		$sql = "SELECT * FROM issuebooks WHERE student_id='$matric' AND returndate=''";

		$query = $connection->query($sql);

		if($query->num_rows > 0){
			while($row = $query->fetch_array()){

				$id = $row['id'];
				$matric = $row['student_id'];
				$name = $row['name'];
				$bookid = $row['book_id'];
				$bookname = $row['bookname'];
				$borrowdate = $row['borrowdate'];
				$issuedate = timeago($row['issuedate']);
				$issueby = $row['issueby'];
				$returndate = timeago($row['returndate']);
				$status = $row['status'];

				$sql2 = "SELECT * FROM add_books WHERE id='$bookid'";
				$query2 = $connection->query($sql2);
				
				if($query2->num_rows > 0){

					while($rows = mysqli_fetch_array($query2)){
						$id = $rows['id'];
						$book = $rows['bookName'];
						$image = $rows['book_image'];
						$bookcategory = $rows['book_category'];

						$output.= "
				
				<div class='container-fluid'>
				<div class='col-md-3'>
					<div class='card'>
  						<img class='card-img-top' src='../admin/images/$image' height='200'>
  						<div class='card-body'>
  							<h6 class='card-title'>$matric</h6>
  							<h5 class='card-title'>$book</h5>
    						<h6 class='card-subtitle mb-2 text-muted'>$bookcategory</h6>
    						<h6 class='card-subtitle mb-2 text-muted'>Borrow Date - $borrowdate</h6>
    						<h6 class='card-subtitle mb-2 text-muted'>Issue Date - $issuedate</h6>
    						<h6 class='card-subtitle mb-2 text-muted'>Issue By - $issueby</h6>
    						<p><button type='button' class='btn btn-info' bid='$id' id='returnbook'>Return Book</button>
    							
    						</p>
  						</div>
					</div>
				</div>
				</div>
				";
					}
				}
			}
	}else{
		echo "<center><h3 style='text-align: center;'>No Book Issued</h3></center>";
	}
	echo $output;
	}

	if(isset($_POST['returnbooks'])){
		$bid = $_POST['bid'];
		$returndate = date('d-M-Y h:i:sa');
		echo $bid;

		$sql = "UPDATE issuebooks SET returndate='$returndate' WHERE book_id='$bid'";
		$query = $connection->query($sql);
		if($query){
			echo '
				<div class="alert alert-success">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Book Returned Successfully
                    </div>
			';
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
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Book Issued</th>
                                            <th scope="col">Book Issued Date</th>
                                            <th scope="col">Book Issued By</th>
                                            <th scope="col">Book Returned Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
		';

		$sql = "SELECT * FROM issuebooks WHERE student_id='$matric'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				

				$id = $row['id'];
				$matric = $row['student_id'];
				$name= $row['name'];
				$book = $row['bookname'];
				$borrowdate = $row['borrowdate'];
				$issuedate = $row['issuedate'];
				$issueby = $row['issueby'];
				$returndate = timeago($row['returndate']);
				$status = $row['status'];

				$output.= "
				<tr>
					<td>$matric</td>
                    <td>$name</td>
                    <td>$book</td>
                    <td>$issuedate</td>
                    <td>$issueby</td>
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