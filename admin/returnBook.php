<?php 
	include("includes/config.php");
	session_start();

    if(!isset($_SESSION['staffNo'])){
        echo "<script>window.location.href='index.html'</script>";
    }
?>

<!doctype html>

<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lasu E-Library</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="vendors/chosen/chosen.min.css">
    <link rel="stylesheet" href="vendors/bootstrap-select/css/bootstrap-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->
<aside id="left-panel" class="left-panel" style="background: #1b2a47; color: white;">
        <nav class="navbar navbar-expand-sm navbar-default" style="background: #1b2a47; color: white;">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><h4>Lasu E-Library</h4></a>
                <a class="navbar-brand hidden" href="./"><img src="images/lasu.png" alt="Logo"></a>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"><i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Students</a>
                        <ul class="sub-menu children dropdown-menu"  style="background: #1b2a47; color: white;">
                            <li>
                                <i class="fa fa-user"></i><a href="#" id="approvestds">Approved Students</a>
                            </li>
                            <li>
                                <i class="fa fa-user"></i><a href="#" id="notapprovedstds">Not Approved Students</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Books</a>
                        <ul class="sub-menu children dropdown-menu" style="background: #1b2a47; color: white;">
                            <li><i class="fa fa-table"></i><a href="#" id="addbook">Add Book</a></li>
                            <li><i class="fa fa-table"></i><a href="#" id="managebook">Manage Books</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Issued Books</a>
                        <ul class="sub-menu children dropdown-menu" style="background: #1b2a47; color: white;">
                            <li><i class="menu-icon fa fa-th"></i><a href="#" id="issueBook">Issue Book</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="#" id="returnedBook">Returned Books</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="viewallissued"><i class="menu-icon fa fa-eye"></i>View all Issued Books </a>
                    </li>
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cog"></i>Settings</a>
                        <ul class="sub-menu children dropdown-menu"  style="background: #1b2a47; color: white;">
                            
                            <li><i class="menu-icon fa fa-pencil"></i><a href="#" id="changepassword">Change Password</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="logout"><i class="menu-icon fa fa-sign-out"></i>Logout </a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel" style="background: #152036; color:white;">

        <!-- Header-->
        <header id="header" class="header" style="background: #1b2a47; color: white;">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger" style="color:white;"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form" method="POST" action="#">
                                <input class="form-control mr-sm-2" type="text" id="keywords" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" style="color:white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">0</span>
                            </button>
                            
                        </div>

                        
                    </div>
                </div>

               
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs" style="background: #1b2a47; color: white;">
            <div class="col-sm-4">
                <div class="page-header float-left" style="background: #1b2a47; color: white;">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right" style="background: #1b2a47; color: white;">
                    <div class="page-title">
                        <ol class="breadcrumb text-right"  style="background: #1b2a47; color: white;">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3" id="contentPage">
           <div class="row">
            
                <div class="col-lg-12" id="content">
                    <div class="card" style="background: #1b2a47; color: white;">
                            <div class="card-header">
                                <strong class="card-title">Return Book</strong>
                            </div>
                            <div class="card-body">
                            	<div class="col-lg-12">
                                <form method="POST" action="#" id="searchMatric">
                                    <div class="form-group">
                                         <select class="selectpicker" data-live-search="true" id="selected">
                                            <?php 
                                                $sql = "SELECT * FROM issue_books WHERE status='0'";
                                                $query = $connection->query($sql);
                                                if($query->num_rows > 0){
                                                	while($row = mysqli_fetch_array($query)){
                                                		$matricno = $row['student_matricno'];
                                            ?>
                                            <option data-tokens="ketchup mustard"><?php echo $matricno; ?></option>
                                            

                                            <?php 
                                            	}
                                              }
                                            ?>
                                        </select>
                                        <button type="submit" class="btn btn-warning" id="search">Search</button>
                                    </div>
                                </form>

                                <div class="row">
                                	<div id="returnform"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            </div>


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="vendors/chosen/chosen.jquery.min.js"></script>
    <script src="vendors/bootstrap-select/js/bootstrap-select.js"></script>

    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>

    <script>

    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script>

    
    <script>
         jQuery(document).ready(function($){
            
            function dashboard() {
                $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {dashboard: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                    }
                })
            }
            dashboard();

            function recent_registered_students(){
                $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {recent: 1},
                    success: function(data){
                        $('#tbody').html(data);
                    }
                })
            }
            recent_registered_students();

            $('body').delegate('.approveStd', 'click', function(e){
                e.preventDefault();
                
                var sid = $(this).attr('pid');
                
                $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {approvedId: 1, sid:sid},
                    success: function(data){
                        $('#msg').html(data);

                    }
                })
            });

            var approvestds = $('#approvestds');
            approvestds.on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url: 'includes/students.php',
                    method: 'POST',
                    data: {approvestd: 1},
                    success: function(data){
                        $('#contentPage').html(data);
                    }
                })
            })

            var notapprovedstds = $('#notapprovedstds');
            notapprovedstds.on('click', function(e){
                e.preventDefault();
                alert(1);
                $.ajax({
                    url: 'includes/students.php',
                    method: 'POST',
                    data: {notapprovestd: 1},
                    success: function(data){
                        $('#contentPage').html(data);
                    }
                })

            })

            $('#addbook').on('click', function(e){
                e.preventDefault();
                
                $.ajax({
                    url: 'includes/books.php',
                    method: 'POST',
                    data: {addbook: 1},
                    success: function(data){
                        $('#contentPage').html(data);
                    }
                })

            })

            $('body').delegate('#addBtn', 'click', function(e){
                e.preventDefault();
                
                var fdata = $('#addBook').serialize();

                    $.ajax({
                        url: 'includes/books.php',
                        method: 'POST',
                        data: fdata,
                        success: function(data){
                            $('#alert').html(data);
                            
                        }
                    })
                });

            $('#managebook').on('click', function(e){
                e.preventDefault();

                $.ajax({
                        url: 'includes/books.php',
                        method: 'POST',
                        data: {managebook: 1},
                        success: function(data){
                            $('#contentPage').html(data);
                            
                        }
                    })
            })

            $('#issueBook').click(function(e){
                e.preventDefault();

        	     window.location.href="issueBook.php";
            });

            $('#returnedBook').click(function(e){
            	e.preventDefault();

            	window.location.href="returnBook.php";
            })

            $('#search').click(function(e){
            	e.preventDefault();
            	
            	var option = $('#selected option:selected').val();
            	if(option == ""){
            		alert('no book');
            	}else{
            		$.ajax({
            		url: 'includes/issue_book.php',
            		method: 'POST',
            		data: {return:1, option:option},
            		success: function(data){
            			$('#returnform').html(data);
            		}
            	})
            	}
            	
            })

            $('body').delegate('#returnbook', 'click', function(e){
            	e.preventDefault();

            	var sid = $(this).attr('pid');
            	alert(sid);
            	$.ajax({
            		url: 'includes/issue_book.php',
            		method: 'POST',
            		data: {returnbook: 1, sid:sid},
            		success: function(data){
            			alert(data);
            		}
            	})
            })

            $('#keywords').keyup(function(e){
                e.preventDefault();
                var keyword = $('#keywords').val();
                if(keyword == ''){
                	$('#contentPage').hide();
                	$('#content').show();

                }else{
                	$.ajax({
                		url: 'includes/search.php',
                		method: 'POST',
                		data: {search:1, keyword:keyword},
                		success: function(data){
                			$('#content').hide();
                			$('#contentPage').html(data).show();

                		}
                	})
                }
            })

            $('body').delegate('#view', 'click', function(e){
            	e.preventDefault();
            	var sid = $(this).attr('pid');
            	alert(sid);
            	$.ajax({
            		url: 'includes/books.php',
            		method: 'POST',
            		data: {view:1, sid:sid},
            		success: function(data){
            			$('#contentPage').html(data);
            		}
            	})
            })
        });
    </script>

</body>

</html>
