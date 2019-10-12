<?php  
	include('config.php');
	session_start();

	if(isset($_POST['search'])){

		$keywords = $_POST['keywords'];

		$sql = "SELECT * FROM add_books WHERE bookName LIKE '%$keywords%' OR book_category LIKE '%$keywords%'";

		$query = $connection->query($sql);

		if($query->num_rows > 0){
			while($row = $query->fetch_array()){

				$id = $row['id'];
                $bookname = $row['bookName'];
				$bookcategory = $row['book_category'];
				$authorname = $row['book_author_name'];
				$publicationdate = $row['book_publication_date'];
				$purchasedate = $row['book_purchase_date'];
				$bookqty = $row['book_qty'];
				$availableqty = $row['available_qty'];
				$dateadded = $row['dateAdded'];


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
                                                        <th class='border-0'>Book Name</th>
                                                        <th class='border-0'>Book Category</th>
                                                        <th class='border-0'>Author Name</th>
                                                        <th class='border-0'>Publication Date</th>
                                                        <th class='border-0'>Book Quantity</th>
                                                        <th class='border-0'>Available Quantity</th>
                                                        <th class='border-0'>Date Added</th>
                                                        <th class='border-0'></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<tr>
								                        <td>$bookname</td>
                                                        <td>$bookcategory</td>
								                        <td>$authorname</td>
								                        <td>$publicationdate</td>
								                        <td>$bookqty</td>
                                                        <td>$availableqty</td>
								                        <td>$dateadded</td>
								                        
			
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
		echo "<center><h3 style='text-align: center;'>No Results Found</h3></center>";
	}
}

?>