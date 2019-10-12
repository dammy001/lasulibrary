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
                              <div class="stat-text"><h4>Send Message To Libarian</h4></div><br>
                              <div id="msg"></div>
                              <form method="POST" action="#" id="sendform">
                              	
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

	if(isset($_POST['subject'])){

		$matricno = $_SESSION['matric'];
		$subject = $_POST['subject'];
		$msgbox = $_POST['msgbox'];
		$timesent = date('d-M-Y h:i:sa');

		if(empty($subject) && empty($msgbox)){
			echo '
				<div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Please Fill Neccessary Requirement
              </div>
			';
		}else{
			
				$sql2 = "INSERT INTO studentmessages (matricno, subject, message, reply, status, timesent)
						VALUES('$matricno', '$subject', '$msgbox', '', '0', '$timesent')";
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

?>