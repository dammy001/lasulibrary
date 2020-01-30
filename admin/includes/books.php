<?php 
	include "config.php";
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

	if(isset($_POST['addbook'])){
		
		$output = '';
		echo ' <div class="breadcrumbs" style="background: #1b2a47; color: white;">
            <div class="col-sm-4">
                <div class="page-header float-left" style="background: #1b2a47; color: white;">
                    <div class="page-title">
                        <h1>Add Book</h1>
                    </div>
                </div>
            </div>
        </div>';

		$output.= '
			<div class="row">
			<div class="col-lg-2"></div>
				<div class="col-lg-9">
					<div class="card" style="background: #1b2a47; color: white;">
                            <div class="card-header">
                                <strong class="card-title">Add Book</strong>
                            </div>
                            <div class="card-body">
                            	 <div class="login-form" style="background: #1b2a47; color: white;">
				                    <div id="alert"></div>
				                    <form method="POST" action="#" id="addBook" enctype="multipart/form-data" class="addBook">
				                        <div class="form-group">
				                            <label>Book Name</label>
				                            <input type="text" class="form-control" id="bookname" name="bookname" placeholder="Book Name">
				                        </div>
				                        <div class="form-group">
				                            <label>Book Image</label>
				                            <input type="file" class="form-control" id="file" name="file" placeholder="Book Image
				                            ">
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

	if(isset($_FILES['file']['name'])){

		
		$bookname = validate($_POST['bookname']);

		$username = $_SESSION['staffNo'];
		$result = '';
        $targetDir = '../images/';
        $image = basename($_FILES['file']['name']);
        $targetFile = $targetDir . basename($_FILES['file']['name']);
        $FileType = pathinfo($targetFile,PATHINFO_EXTENSION);
        $uploadOk = 1;

		$bookcategory = validate($_POST['bookcategory']);
		$bookauthorname = validate($_POST['bookauthorname']);
		$publicationdate= validate($_POST['publicationdate']);
		$purchasedate = validate($_POST['purchasedate']);
		$bookqty = validate($_POST['bookqty']);
		$availableqty = validate($_POST['availableqty']);
		$dateAdded = date('d-M-Y');

		 if(file_exists(($targetFile))){
            $result.= '<div class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>File Already Exists</strong>
                    </div>';
            $uploadOk = 0;
            
        }

        
        if($_FILES['file']['size'] > 1000000){
            $result.= '<div class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sorry your file is too large</strong>
                    </div>';
            $uploadOk = 0;
            
        }

        $allowedExts = array(
          "png", 
          "jpeg", 
          "jpg",
          "gif"
        ); 

        $allowedMimeTypes = array( 
          'image/gif',
          'image/jpeg',
          'image/png',
        );

        //$extension = end(explode(".", $_FILES["file"]["name"]));
        $tmp = explode('.', $_FILES['file']['name']);
        $extension = end($tmp);

        if ( !( in_array($extension, $allowedExts ))) {
          //die('Please provide another file type [E/2].');
            $result.= '<div class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Please provide another file type</strong>
                    </div>';
            $uploadOk = 0;
            
        }

         if ( in_array( $_FILES["file"]["type"], $allowedMimeTypes ) ) 
        {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {

                if($uploadOk == 0){

                    $result.= '<div class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sorry, an error occured</strong>
                    </div>';
                }
                else{
                    
                    $sql3 = "SELECT bookName FROM add_books WHERE bookName='$bookname' LIMIT 1";
					$query3 = $connection->query($sql3);

					if($query3->num_rows > 0){
						
						$result.= '<div class="alert alert-danger">
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									  <strong>Book has been added already</strong>
									</div>';
					}
					else{

						$sql = "INSERT INTO add_books (bookName, book_image, book_category, book_author_name, book_publication_date, book_purchase_date, book_qty, available_qty, libarian_username, dateAdded)
								VALUES ('$bookname', '$image', '$bookcategory', '$bookauthorname', '$publicationdate', '$purchasedate', '$bookqty', '$availableqty', '$username', '$dateAdded')
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
            }
        }
		
	}

	if(isset($_POST['managebook'])){
		$output = '';
		echo ' <div class="breadcrumbs" style="background: #1b2a47; color: white;">
            <div class="col-sm-4">
                <div class="page-header float-left" style="background: #1b2a47; color: white;">
                    <div class="page-title">
                        <h1>Manage Books</h1>
                    </div>
                </div>
            </div>
        </div>';
		
		$sql = "SELECT * FROM add_books ORDER BY id DESC";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				$id = $row['id'];
				$bookname = $row['bookName'];
				$image = $row['book_image'];
				$bookcategory = $row['book_category'];
				$authorname = $row['book_author_name'];
				$publicationdate = $row['book_publication_date'];
				$purchasedate = $row['book_purchase_date'];
				$bookqty = $row['book_qty'];
				$availableqty = $row['available_qty'];
				$dateadded = $row['dateAdded'];

				$output.= "
				
				<div class='container-fluid'>
				<div class='col-md-3'>
					<div class='card' style='background: #1b2a47; color: white;'>
  						<img class='card-img-top' src='./images/$image' height='200'>
  						<div class='card-body'>
  							<h5 class='card-title'>$bookname</h5>
    						<h6 class='card-subtitle mb-2 text-muted'>$authorname</h6>
    						<h6 class='card-subtitle mb-2 text-muted'>$bookcategory</h6>
    						<p><button type='button' class='btn btn-info' pid='$id' id='viewbookdetails' data-toggle='modal' data-target='#exampleModal'>View</button>
    							<button type='button' class='btn btn-danger' pid='$id' id='deletebook'>Delete</button>
    							
    						</p>
  						</div>
					</div>
				</div>
				</div>
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

	if(isset($_POST['viewbook'])){
		$pid = $_POST['pid'];
		$output='';

		$sql = "SELECT * FROM add_books WHERE id='$pid'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){

				$id = $row['id'];
				$bookname = $row['bookName'];
				$image = $row['book_image'];
				$bookcategory = $row['book_category'];
				$authorname = $row['book_author_name'];
				$publicationdate = $row['book_publication_date'];
				$purchasedate = $row['book_purchase_date'];
				$bookqty = $row['book_qty'];
				$availableqty = $row['available_qty'];
				$dateadded = timeago($row['dateAdded']);
				$addedby = $row['libarian_username'];

					$output.= '
							
                                <table class="table table-responsive table-hover">
          
                                    <tbody>
                                        
		';

					$output.= "
					<tr>
						<th>Book Name</th>
						<td>$bookname</td>
					</tr>
					<tr>
						<th>Book Category</th>
						<td>$bookcategory</td>
					</tr>
					<tr>
						<th>Book Author Name</th>
						<td>$authorname</td>
					</tr>
					<tr>
						<th>Publication Date</th>
						<td>$publicationdate</td>
					</tr>
					<tr>
						<th>Purchase Date</th>
						<td>$purchasedate</td>
					</tr>
					<tr>
						<th>Book Quantity</th>
						<td>$bookqty</td>
					</tr>
					<tr>
						<th>Available Quantity</th>
						<td>$availableqty</td>
					</tr>
					<tr>
						<th>Date Added</th>
						<td>$dateadded</td>
					</tr>
					<tr>
						<th>Added By</th>
						<td>$addedby</td>
					</tr>

					";
				}
			}
			$output.='
			</tbody>
                                </table>

                            
		';


		echo $output;
		}

	if(isset($_POST['deletebook'])){
		$pid = $_POST['pid'];
		
		$sql = "DELETE FROM add_books WHERE id='$pid'";
		$query = $connection->query($sql);
		if($query){
			echo 'Book Deleted Successfully';
		}
	}


	if(isset($_POST['viewall'])){
		$output = '';
		echo ' <div class="breadcrumbs" style="background: #1b2a47; color: white;">
            <div class="col-sm-4">
                <div class="page-header float-left" style="background: #1b2a47; color: white;">
                    <div class="page-title">
                        <h1>Book Requests</h1>
                    </div>
                </div>
            </div>
        </div>';
        $output.= '
        	<div id="requestalert"></div>
        ';

		/*$output.= '
								
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
*/
		$sql = "SELECT * FROM issuebooks WHERE status='0'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			while($row = mysqli_fetch_array($query)){	

				$id = $row['id'];
				$matric = $row['student_id'];
				$name = $row['name'];
				$bookid = $row['book_id'];
				$bookname = $row['bookname'];
				$borrowdate = timeago($row['borrowdate']);
				$issuedate = $row['issuedate'];
				$issueby = $row['issueby'];
				$returndate = $row['returndate'];
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
					<div class='card' style='background: #1b2a47; color: white;'>
  						<img class='card-img-top' src='./images/$image' height='200'>
  						<div class='card-body'>
  							<h6 class='card-title'>$matric</h6>
  							<h5 class='card-title'>$book</h5>
    						<h6 class='card-subtitle mb-2 text-muted'>$bookcategory</h6>
    						<h6 class='card-subtitle mb-2 text-muted'>$borrowdate</h6>
    						<p><button type='button' class='btn btn-info' bid='$id' id='issuerequest'>Issue Book</button>
    						<button type='button' class='btn btn-danger' bid='$id' id='deleterequest'>Delete Request</button>	
    						</p>
  						</div>
					</div>
				</div>
				</div>
				";
					}
				}

				

				/*$output.= "
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
				";*/
			}
		}else{
			$output.= '
				<td><h4>No Book Requests</h4></td>
			';
		}

		/*$output.='
			</tbody>
                                </table>
                               

		';*/

		echo $output;

	}

	if(isset($_POST['issuerequest'])){
		$bid = $_POST['bid'];
		$issuedate = date('d-M-Y h:i:sa');
		$issueby = $_SESSION['staffNo'];
		
		$sql = "UPDATE issuebooks SET issuedate='$issuedate', issueby='$issueby', status='1' WHERE book_id='$bid'";
		$query = $connection->query($sql);
		if($query){
			echo '
			<div class="alert alert-success">
                                	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                	<strong>Book Added Successfully</strong>
                            	</div>
		';
		}




	}
	

	function validate($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}	

?>