<?php 
	
	$connection = mysqli_connect('localhost', 'root', '');
    if(!$connection){
        echo 'error in connection'.mysqli_error($connection);
    }
    
    $select_db = mysqli_select_db($connection, 'library');
    if(!$select_db){
        echo 'error selecting db'.mysqli_error($connection);
    }

?>