<?php 
	include('config.php');
	session_start();

	if(isset($_POST['search'])){

		$keywords = $_POST['keywords'];
        $output = '';

		$sql = "SELECT * FROM add_books WHERE bookName LIKE '%$keywords%'";

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
                $image = $row['book_image'];


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
	}else{
		echo "<center><h3 style='text-align: center;'>No Results Found</h3></center>";
	}

    echo $output;
}
?>