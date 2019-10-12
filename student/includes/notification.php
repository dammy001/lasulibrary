<?php 
	include('config.php');
	session_start();

	if(isset($_POST['notification'])){
		$matric = $_SESSION['matric'];
		$output = '';

    $sql2 = "UPDATE messages SET status='1' WHERE student_matricno='$matric'";
    $query2 = $connection->query($sql2);

		$output.= '
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
                <div class="card">
                
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-content">
                              <div class="stat-text"><h4>Messages</h4></div><br>
                              	<table class="table table-hover">
                              		<thead class="thead-dark">
                              			<th>From</th>
                              			<th>Subject</th>
                              			<th>Message</th>
                              			<th>Time</th>
                                    <th></th>
                              		</thead>
                              		<tbody>
                             
                ';

                $sql = "SELECT * FROM messages WHERE student_matricno='$matric'";
                $query = $connection->query($sql);
                if($query->num_rows > 0){
                	while($rows = mysqli_fetch_array($query)){
                		$from = $rows['admin_username'];
                		$title = $rows['title'];
                		$message = $rows['message'];
                		$time = $rows['timesent'];

                		$output.= "
                			<td>$from</td>
                			<td>$title</td>
                			<td>$message</td>
                			<td>$time</td>
                      <td>
                        <button class='btn btn-light btn-sm' name='reply' id='reply'><i class='fa fa-reply'></i></button>
                        <button class='btn btn-light btn-sm' name='delete' id='delete'><i class='fa fa-trash'></i></button>
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
		$matric = $_SESSION['matric'];
		$sql = "SELECT * FROM messages WHERE student_matricno='$matric' AND status='0'";
		$query = $connection->query($sql);
		$count = mysqli_num_rows($query);
		if($count){
			echo $count;
		}else{
			echo "0";
		}
	}

?>