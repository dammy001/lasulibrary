<?php 
	include('config.php');
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

	if(isset($_POST['notification'])){
		//$matric = $_SESSION['matric'];
		$output = '';

    $sql2 = "UPDATE messages SET status='1'";
    $query2 = $connection->query($sql2);

		$output.= '
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
                <div class="card" style="background: #1b2a47; color: white;">
                
                    <div class="card-body" style="background: #1b2a47; color: white;">
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
                                    <th></th>
                              		</thead>
                              		
                             
                ';

                $sql = "SELECT * FROM messages";
                $query = $connection->query($sql);
                if($query->num_rows > 0){
                	while($rows = mysqli_fetch_array($query)){
                    $id = $rows['id'];
                		$from = $rows['sender'];
                		$title = $rows['title'];
                		$message = $rows['message'];
                		$time = timeago($rows['timesent']);

                		$output.= "
                        <tbody>

                			<td>$from</td>
                			<td>$title</td>
                			<td>$message</td>
                			<td>$time</td>
                      ";
                      if($from != $_SESSION['staffNo']){
                        $output.="
                          <td><span class='badge badge-success'>Recieved</span></td>
                        ";
                      }else{
                        $output.="
                          <td><span class='badge badge-dark'>Sent</span></td>
                        ";
                      }
                      
                      $output.="
                      <td>
                        <button class='btn btn-light btn-sm' mid='$id' name='reply' id='reply'><i class='fa fa-reply'></i></button>
                        <button class='btn btn-light btn-sm' name='delete' mid='$id' id='deletemessage'><i class='fa fa-trash'></i></button>
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
		$staffNo = $_SESSION['staffNo'];
		$sql = "SELECT * FROM messages WHERE sender!='$staffNo' AND status='0'";
		$query = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($query);
		if($count){
			echo $count;
		}else{
			echo "0";
		}
	}

  if(isset($_POST['deletemessage'])){

    $mid = $_POST['mid'];

    $sql = "DELETE FROM messages WHERE id='$mid'";
    $query = $connection->query($sql);
    if($query){
      echo '
          <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Message Deleted Successfully
                  </div>
          ';
    }
  }

?>