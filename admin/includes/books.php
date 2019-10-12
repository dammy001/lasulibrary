<?php 
	include "config.php";
	session_start();

	if(isset($_POST['addbook'])){
		
		$output = '';

		$output.= '
			<div class="row">
			<div class="col-lg-2"></div>
				<div class="col-lg-9">
					<div class="card">
                            <div class="card-header">
                                <strong class="card-title">Add Book</strong>
                            </div>
                            <div class="card-body">
                            	 <div class="login-form">
				                    <div id="alert"></div>
				                    <form method="POST" action="#" id="addBook" enctype="multipart/form-data" class="addBook">
				                        <div class="form-group">
				                            <label>Book Name</label>
				                            <input type="text" class="form-control" id="bookname" name="bookname" placeholder="Book Name">
				                        </div>
				                        
				                        <div class="form-group">
				                            <label>Book Category</label>
				                            <input type="text" class="form-control" id="bookcategory" name="bookcategory" placeholder="Book Category">
				                        </div>
				                        <div class="form-group">
				                            <label>Author Name</label>
				                            <input type="text" class="form-control" id="bookauthorname" name="bookauthorname" placeholder="Author Name">
				                        </div>
				                        <div class="form-group">
				                            <label>Publication Date</label>
				                            <input type="date" class="form-control" id="publicationdate" name="publicationdate" placeholder="Publication Date">
				                        </div>
				                         <div class="form-group">
				                            <label>Purchase Date</label>
				                            <input type="date" class="form-control" id="purchasedate" name="purchasedate" placeholder="Purchase Date">
				                        </div>
				                         <div class="form-group">
				                            <label>Book Quantity</label>
				                            <input type="number" class="form-control" id="bookqty" name="bookqty" placeholder="Book Quantity">
				                        </div>
				                        <div class="form-group">
				                            <label>Available Quantity</label>
				                            <input type="number" class="form-control" id="availableqty" name="availableqty" placeholder="Available Quantity">
				                        </div>
				                            
				                                
				                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" id="addBtn">Add Book</button>
				                               
				                    </form>
				                </div>
                            </div>
                    </div>
                </div>
            </div>
		';

		echo $output;
	}

	if(isset($_POST['bookname'])){

		
		$bookname = validate($_POST['bookname']);

		$username = $_SESSION['name'];

		$bookcategory = validate($_POST['bookcategory']);
		$bookauthorname = validate($_POST['bookauthorname']);
		$publicationdate= validate($_POST['publicationdate']);
		$purchasedate = validate($_POST['purchasedate']);
		$bookqty = validate($_POST['bookqty']);
		$availableqty = validate($_POST['availableqty']);
		$dateAdded = date('d-M-Y');

		$sql3 = "SELECT bookName FROM add_books WHERE bookName='$bookname' LIMIT 1";
					$query3 = $connection->query($sql3);

					if($query3->num_rows > 0){
						
						$result.= '<div class="alert alert-danger">
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									  <strong>Book has been added already</strong>
									</div>';
					}else{

						$sql = "INSERT INTO add_books (bookName, book_image, book_category, book_author_name, book_publication_date, book_purchase_date, book_qty, available_qty, libarian_username, dateAdded)
								VALUES ('$bookname', '1.jpg', '$bookcategory', '$bookauthorname', '$publicationdate', '$purchasedate', '$bookqty', '$availableqty', '$username', '$dateAdded')
					";	

				if ($connection->query($sql) === TRUE) {

				   echo '
				    	<div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Book Added Successfully</strong>
                            </div>
				    ';
				    
				}

			}
	}

	if(isset($_POST['managebook'])){
		$output = '';

		$output.= '
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
                            <div class="card-header">
                                <strong class="card-title">Manage Books</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Book Name</th>
                                            <th scope="col">Book Category</th>
                                            <th scope="col">Author Name</th>
                                            <th scope="col">Publication Date</th>
                                            <th scope="col">Purchase Date</th>
                                            <th scope="col">Book Quantity</th>
                                            <th scope="col">Available Quantity</th>
                                            <th scope="col">Date Added</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
		';

		$sql = "SELECT * FROM add_books ORDER BY id DESC";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				$id = $row['id'];
				$bookname = $row['bookName'];
				$bookcategory = $row['book_category'];
				$authorname = $row['book_author_name'];
				$publicationdate = $row['book_publication_date'];
				$purchasedate = $row['book_purchase_date'];
				$bookqty = $row['book_qty'];
				$availableqty = $row['available_qty'];
				$dateadded = $row['dateAdded'];

				$output.= "
				<tr>
					<td>$bookname</td>
                    <td>$bookcategory</td>
                    <td>$authorname</td>
                    <td>$publicationdate</td>
                    <td>$purchasedate</td>
                    <td>$bookqty</td>
                    <td>$availableqty</td>
                    <td>$dateadded</td>
                    <td><button type='button' class='btn btn-dark btn-sm view' id='view' pid='$id' data-toggle='tooltip' data-placement='top' title='View Students With This Book'><i class='fa fa-user'></i></button>
					</td>
                    <td><button type='button' class='btn btn-dark btn-sm edit' id='edit' pid='$id' data-toggle='tooltip' data-placement='top' title='Edit Book'><i class='fa fa-edit'></i></button>
					</td>
                    <td><button type='button' class='btn btn-danger btn-sm delete' id='delete' pid='$id'><i class='fa fa-trash-o' data-toggle='tooltip' data-placement='top' title='Delete Book'></i></button>
					</td>
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

	if(isset($_POST['view'])){
		$sid = $_POST['sid'];
		$output='';

		$sql = "SELECT bookName FROM add_books WHERE id='$sid'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			$row = mysqli_fetch_array($query);
			$bookname = $row['bookName'];
			//echo $bookname;

			$output.= '
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
                            <div class="card-header">
                                <strong class="card-title">Manage Books</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Student Matric No</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Student Email</th>
                                            <th scope="col">Student Department</th>
                                            <th scope="col">Student Level</th>
                                            <th scope="col">Book Name</th>
                                            <th scope="col">Book Issue Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
		';

			$sql2 = "SELECT * FROM issue_books WHERE book_name='$bookname' AND status='0'";
			$query2 = $connection->query($sql2);
			if($query2->num_rows > 0){

				while($rows = mysqli_fetch_array($query2)){
					$matricno = $rows['student_matricno'];
					$studentname = $rows['student_name'];
					$email = $rows['student_email'];
					$department = $rows['student_department'];
					$level = $rows['student_level'];
					$bookname = $rows['book_name'];
					$issuedate = $rows['book_issue_date'];

					$output.= "
					<tr>
						<td>$matricno</td>
	                    <td>$studentname</td>
	                    <td>$email</td>
	                    <td>$department</td>
	                    <td>$level</td>
	                    <td>$bookname</td>
	                    <td>$issuedate</td>
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
	}

	if(isset($_POST['viewall'])){
		$output = '';

		$output.= '
								
                                <table class="table table-hover table-responsive-md">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Matric No</th>
                                            <th scope="col">Student Name</th>
                                           
                                            <th scope="col">Student Department</th>
                                            <th scope="col">Student Level</th>
                                            <th scope="col">Book Issued</th>
                                            <th scope="col">Book Issued Date</th>
                                            <th scope="col">Book Returned Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
		';

		$sql = "SELECT * FROM issue_books";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				

				$id = $row['id'];
				$matric = $row['student_matricno'];
				$name = $row['student_name'];
				$department = $row['student_department'];
				$level = $row['student_level'];
				$book = $row['book_name'];
				$issuedate = $row['book_issue_date'];
				$returndate = $row['book_return_date'];
				$status = $row['status'];

				$output.= "
				<tr>
					<td>$matric</td>
					<td>$name</td>
					<td>$department</td>
                    <td>$level</td>
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
				<td><h4>No Issued Book</h4></td>
			';
		}

		$output.='
			</tbody>
                                </table>
                               

		';

		echo $output;

	}

	

	function validate($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}	

?>