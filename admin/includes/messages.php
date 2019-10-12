<?php 
	include('config.php');
	session_start();

	if(isset($_POST['send'])){
		$output = '';

		$output.='
		<div class="col-lg-2"></div>
			<div class="col-lg-8">
                <div class="card">
                
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-content">
                              <div class="stat-text"><h4>Send Message To Student</h4></div><br>
                              <div id="msg"></div>
                              <form method="POST" action="#" id="sendform">
                              	<div class="form-group">
                              		<label>To: </label>
                              		<input type="text" class="form-control" name="to" id="to" placeholder="Student Matric No">
                              	</div>
                              	<div class="form-group">
                              		<label>Subject: </label>
                              		<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                              	</div>
                              	<div class="form-group">
                              		<label>Text: </label>
                              		<textarea class="form-control" name="msgbox" id="msgbox" placeholder="Type Message Here"></textarea>
                              	</div>

                              	<div class="form-group">
                              		<button type="submit" class="btn btn-success" id="sendbtn" name="sendbtn">Send Message</button>
                              	</div>
                              </form>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		';

		echo $output;
	}

	if(isset($_POST['to'])){

		$name = $_SESSION['name'];
		$matric = $_POST['to'];
		$subject = $_POST['subject'];
		$msgbox = $_POST['msgbox'];
		$timesent = date('d-M-Y h:i:sa');

		if(empty($matric) && empty($subject) && empty($msgbox)){
			echo '
				<div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Please Fill Neccessary Requirement
              </div>
			';
		}else{
			$sql = "SELECT * FROM students WHERE matricno='$matric' LIMIT 1";
			$query = $connection->query($sql);
			if($query->num_rows == 0){
				echo '
				<div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Matric No Does Not Exist
              </div>
			';
			}else{
				$sql2 = "INSERT INTO messages (admin_username, student_matricno, title, message, status, timesent)
						VALUES('$name', '$matric', '$subject', '$msgbox', '0', '$timesent')";
				$query2 = $connection->query($sql2);
				if($query2){
					echo '
					<div class="alert alert-success">
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                Message Sent Successfully
              		</div>
					';
				}
			}
		}
	}

?>