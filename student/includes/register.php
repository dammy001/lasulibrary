<?php 
	include "config.php";
	 session_start();

    if(isset($_FILES['file']['name'])){

        $result = '';
        $targetDir = '../images/';
        $image = basename($_FILES['file']['name']);
        $targetFile = $targetDir . basename($_FILES['file']['name']);
        $FileType = pathinfo($targetFile,PATHINFO_EXTENSION);
        $uploadOk = 1;

        $matricno = $_POST['matricno'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $faculty = $_POST['faculty'];
        $department = $_POST['department'];
        $level = $_POST['level'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $dateRegistered = date('Y-m-d');


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

        if($password != $confirmpassword){
            $result.= '
                <div class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Incorrect Password</strong>
                    </div>

                ';

        }
        else{
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
                        $sql = "SELECT * FROM students WHERE matricno='$matricno'";
                        $query = $connection->query($sql);

                        if($query->num_rows == 0){

                            $sql2 = "INSERT INTO students (matricno, firstname, lastname, email, faculty, department, level, image, password, status, dateRegistered) 
                            VALUES('$matricno', '$firstname', '$lastname', '$email', '$faculty', '$department', '$level', '$image', '$password', '0', '$dateRegistered')";
                            $query2 = $connection->query($sql2);
                            if($query2){

                               echo '
                                    <div class="alert alert-success">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Student Registered Successfully</strong>
                                        </div>
                                ';

                                echo '<script>window.location.href="./index.html.php"</script>';
                               // echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
                                
                            }
                            else{
                                echo "Error: " . $sql . "<br>" . $connection->error;
                            }

                            
                        }
                        else{
                            $result.= '
                                <div class="alert alert-danger">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <strong>Matric No Exists Already</strong>
                                        </div>
                            ';
                            
                        }
                }
            }
        }
        }
        echo $result;
    }
	/*if(isset($_POST['submit'])){

		$matric = $_POST['matric'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$faculty = $_POST['faculty'];
		$department = $_POST['department'];
		$level = $_POST['level'];
		$password = $_POST['password'];
		$dateRegistered = date('Y-m-d');
		

		if(!empty($matric) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($faculty) && !empty($department) && !empty($level) && !empty($password)){

			$sql = "SELECT matricno FROM students WHERE matricno='$matric'";
			$query = $connection->query($sql);
			if($query->num_rows > 0){
				echo "matric no already exists";
			}
			else{

				$sql2 = "INSERT INTO students (matricno, firstname, lastname, email, faculty, department, level, password, status, dateRegistered)
					VALUES ('$matric', '$firstname', '$lastname', '$email', '$faculty', '$department', '$level', '$password', '0', '$dateRegistered')";
				$query2 = $connection->query($sql2);
				if($query2){
					echo 'student registered successfully';
				}
			}
		}
	}*/

?>