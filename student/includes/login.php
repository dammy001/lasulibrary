<?php  
	include('config.php');
  session_start();

  if(isset($_POST['submit'])){
    
    $error = '';
    $matric = validate($_POST['matric']);
    $password = validate($_POST['password']);

     if(!empty($matric) && !empty($password)){

            $sql = "SELECT * FROM students WHERE matricno='$matric' AND password='$password' AND status='1' LIMIT 1";
            $query = mysqli_query($connection, $sql);


            if(mysqli_num_rows($query) == 0){
                $error.= '
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Incorrect Username or Password | Your account has not been verified
                    </div>
                ';
            }
            else{

                $row = mysqli_fetch_array($query);
    
                $id = $row['id'];
                $matric = $row['matricno'];

                $_SESSION['matric'] = $matric;
                $_SESSION['id'] = $id;

          $error.= '
            <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              User login successfully
            </div>
          ';

      echo '<script>window.location.href="dashboard.php"</script>'; 
    }  

       echo $error;
  }
}

function validate($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

?>