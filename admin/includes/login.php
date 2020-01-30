<?php  
	include('config.php');
  session_start();

  if(isset($_POST['submit'])){
    
    $error = '';
    $staffNo = validate($_POST['staffNo']);
    $password = validate($_POST['password']);
    $date = date('Y-m-d h:i:sa');

     if(!empty($staffNo) && !empty($password)){

            $sql = "SELECT * FROM admin WHERE staffNo='$staffNo' AND password='$password' LIMIT 1";
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
                $staffNo = $row['staffNo'];
                $name = $row['firstname'];

                $_SESSION['staffNo'] = $staffNo;
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;

                $sql2 = "UPDATE admin SET lastLogin='$date' WHERE staffNo='$staffNo'";
                $query2 = $connection->query($sql2);

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