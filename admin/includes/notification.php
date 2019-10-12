<?php 
	include('config.php');
	session_start();

	if(isset($_POST['notification'])){
		//$matric = $_SESSION['matric'];
		$output = '';

    $sql2 = "UPDATE studentmessages SET status='1'";
    $query2 = $connection->query($sql2);

		$output.= '
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
                <div class="card">
                
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-content">
                              <div class="stat-text"><h4>Messages</h4></div><br>
                              <div id="msgstatus"></div>
                              	<table class="table table-hover">
                              		<thead class="thead-dark">
                              			<th>From</th>
                              			<th>Subject</th>
                              			<th>Message</th>
                              			<th>Time</th>
                                    <th></th>
                              		</thead>
                              		
                             
                ';

                $sql = "SELECT * FROM studentmessages";
                $query = $connection->query($sql);
                if($query->num_rows > 0){
                	while($rows = mysqli_fetch_array($query)){
                    $id = $rows['id'];
                		$from = $rows['matricno'];
                		$title = $rows['subject'];
                		$message = $rows['message'];
                		$time = $rows['timesent'];

                		$output.= "
                        <tbody>
                			<td>$from</td>
                			<td>$title</td>
                			<td>$message</td>
                			<td>$time</td>
                      <td>
                        <button class='btn btn-light btn-sm' mid='$id' name='reply' id='reply'><i class='fa fa-reply'></i></button>
                        <button class='btn btn-light btn-sm' name='delete' mid='$id' id='delete'><i class='fa fa-trash'></i></button>
                      </td>
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
            </div>
		';

		echo $output;
	}

	if(isset($_POST['counter'])){
	//	$matric = $_SESSION['matric'];
		$sql = "SELECT * FROM studentmessages WHERE status='0'";
		$query = $connection->query($sql);
		$count = mysqli_num_rows($query);
		if($count){
			echo $count;
		}else{
			echo "0";
		}
	}

  if(isset($_POST['delete'])){

    $mid = $_POST['mid'];

    $sql = "DELETE FROM studentmessages WHERE id='$mid'";
    $query = $connection->query($sql);
    if($query === TRUE){
      echo '
          <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Message Deleted Successfully
                  </div>
          ';
    }
  }

?>