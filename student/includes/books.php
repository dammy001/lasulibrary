<?php 
include('config.php');
session_start();

if(isset($_POST['managebook'])){
		$output = '';
		echo ' <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Books</h1>
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
					<div class='card'>
  						<img class='card-img-top' src='../admin/images/$image' height='200'>
  						<div class='card-body'>
  							<h5 class='card-title'>$bookname</h5>
    						<h6 class='card-subtitle mb-2 text-muted'>$authorname</h6>
    						<h6 class='card-subtitle mb-2 text-muted'>$bookcategory</h6>
    						<p><button type='button' class='btn btn-info' pid='$id' id='viewbookdetails' data-toggle='modal' data-target='#exampleModal'>View</button>
    							
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

	if(isset($_POST['viewbook'])){
		$pid = $_POST['pid'];
		$output='';

		$output = '';
		echo ' <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Borrow Book</h1>
                    </div>
                </div>
            </div>
        </div>';

		$sql = "SELECT * FROM add_books WHERE id='$pid'";
		$query = $connection->query($sql);
		if($query->num_rows > 0){
			$output.= "
			<div class='col-md-2'></div>
			<div class='col-md-8'>
				<div class='card'>
  					<div class='card-body'>
  					<div id='alertbook'></div>
  					<table class='table table-responsive table-hover'>
                        <tbody>
			";
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
				$addedby = $row['libarian_username'];


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
					";

					if($availableqty > 0){
						$output.= "
							<tr>
								<th>Availability</th>
								<td><p><span class='badge badge-success'>Available</span></p></td>
							</tr>
						";
					}

					$output.="
					<tr>
						<th>Date Added</th>
						<td>$dateadded</td>
					</tr>
					<tr>
						<th>Added By</th>
						<td>$addedby</td>
					</tr>

					<tr>
						
						<td><button type='button' class='btn btn-success' pid='$id' id='borrow' data-toggle='modal' data-target='#exampleModal'>Borrow Book</button></td>
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
                               <div class="col-md-2"></div>
                            
		';

		echo $output;
		}

		if(isset($_POST['borrowbook'])){
			$pid = $_POST['pid'];
			$matric = $_SESSION['matric'];
			$borrowdate = date('d-M-Y');

			$sql = "SELECT * FROM add_books WHERE id='$pid'";
			$query = $connection->query($sql);

			
				$row = mysqli_fetch_array($query);
				$bookname = $row['bookName'];
 
				$sql2 = "SELECT * FROM students WHERE matricno='$matric'";
				$query2 = $connection->query($sql2);

				$row2 = mysqli_fetch_array($query2);
				$matricnum = $row2['matricno'];
				$firstname = $row2['firstname'];




			$sql3 = "SELECT * FROM issuebooks WHERE student_id='$matric' AND borrowdate='$borrowdate'";
			$query3 = $connection->query($sql3);
			if($query3->num_rows > 3){

				echo '
				<div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Maximum of 3 Books per day
              </div>
			';

				die();
			}
			else{

				$sql4 = "SELECT * FROM issuebooks WHERE student_id='$matric' AND book_id='$pid'";
				$query4 = $connection->query($sql4);

				  if($query4->num_rows > 0){
				   echo '
				    <div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     This book has been borrowed by you.
                    </div>
			      ';
			    }
			    else{

			    	$sql5 = "INSERT INTO issuebooks (student_id, name, book_id, bookname, borrowdate, issuedate, issueby, returndate, status)
			    				VALUES('$matric', '$firstname', '$pid', '$bookname', '$borrowdate', '', '', '', '0')";
				    $query5 = $connection->query($sql5);
				    if($query5){

				    	 echo '
				    <div class="alert alert-success">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     Book borrowed successfully.... Wait a minute for Admin Approval.
                    </div>
			      ';
			      
				    }
			    }
			}

		}

?>