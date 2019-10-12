<?php  
	include('config.php');
  session_start();

  if(isset($_POST['submit'])){
    
    $error = '';
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

     if(!empty($email) && !empty($password)){

            $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password' LIMIT 1";
            $query = mysqli_query($connection, $sql);


            if(mysqli_num_rows($query) == 0){
                $error.= '
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Incorrect Username or Password
                    </div>
                ';
            }
            else{

                $row = mysqli_fetch_array($query);
    
                $id = $row['id'];
                $matric = $row['email'];
                $name = $row['firstname'];

                $_SESSION['email'] = $email;
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;

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