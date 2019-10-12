<?php 
    include("includes/config.php");
    session_start();

    if(!isset($_SESSION['matric'])){
        echo '<script>window.location.href="index.html"</script>';
    }
?>

<!doctype html>

<html lang="en">
<!--<![endif]-->

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
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="dashboard.php"><img src="images/lasu.jpeg" alt="Logo" height="100" width="100"></a>
                <a class="navbar-brand hidden" href="dashboard.php"><img src="images/lasu.jpeg" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    
                    <li>
                        <a href="#" id="issuedbook"> <i class="menu-icon fa fa-book"></i>View my Issued Books </a>
                    </li>

                    <li>
                        <a href="#" id="transactions"> <i class="menu-icon fa fa-book"></i>View all Book Transactions</a>
                    </li>

                     <li>
                        <a href="#" id="profile"> <i class="menu-icon fa fa-user-o"></i>Update Profile </a>
                    </li>

                    <li>
                        <a href="#" id="sendmsg"><i class="menu-icon fa fa-envelope"></i>Send Message </a>
                    </li>

                    <li>
                        <a href="#" id="notification"> <i class="menu-icon fa fa-bell"></i>Notifications <span class="badge badge-danger notify">8</span></a>
                    </li>

                    <li>
                        <a href="#" id="logout"> <i class="menu-icon fa fa-sign-out"></i>Logout </a>
                    </li>
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form" method="POST" action="#">
                                <input class="form-control mr-sm-2" type="text" id="keywords" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" id="keywords" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="badge badge-danger notify" ></span>
                            </button>
                            
                        </div>

                        
                    </div>
                </div>

                            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div id="dashboard"></div>

        </div>


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>

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

            $('#keywords').keyup(function(e){
                e.preventDefault();
                var keywords = $(this).val();
                if(keywords == ''){
                    dashboard();
                }else{
                    $.ajax({
                        url: 'includes/search.php',
                        method: 'POST',
                        data: {search: 1, keywords:keywords},
                        success: function(data){
                            $('#dashboard').html(data);
                        }
                    })
                }
            })

            $('#issuedbook').on('click', function(e){
                e.preventDefault();
                
                $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {viewissuedbook: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                    }
                })
            })

            $('#profile').on('click', function(e){
                e.preventDefault();
                
                $.ajax({
                    url: 'includes/profile.php',
                    method: 'POST',
                    data: {profile: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                    }
                })
            })

            $('#transactions').on('click', function(e){
                e.preventDefault();
                
                $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {transaction: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                    }
                });
            });

            $('body').delegate('#updatebtn', 'click', function(e){
                e.preventDefault();

                var matricno = $('#matricno').val();
                var firstname = $('#firstname').val();
                var lastname = $('#lastname').val();
                var email = $('#email').val();
                var faculty = $('#faculty').val();
                var department = $('#department').val();
                var level = $('#level').val();

                $.ajax({
                    url: 'includes/profile.php',
                    method: 'POST',
                    data: {update: 1, matricno:matricno, firstname:firstname, lastname:lastname, email:email, faculty:faculty, department:department, level:level},
                    success: function(data){
                        $('#alert').html(data);
                    }
                })
            })

            $('#logout').click(function(e){
                e.preventDefault();

                $.ajax({
                    url: 'includes/logout.php',
                    method: 'POST',
                    data: {logout: 1},
                    success: function(data){
                        window.location.href='index.html';
                    }
                })
            })

            $('#notification').click(function(e){
                e.preventDefault();
                $.ajax({
                    url: 'includes/notification.php',
                    method: 'POST',
                    data: {notification: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                         notification_counter();
                    }
                })
            })

            function notification_counter(){
                $.ajax({
                    url: 'includes/notification.php',
                    method: 'POST',
                    data: {counter: 1},
                    success: function(data){
                        $('.notify').html(data);
                        notification_counter();
                    }
                })
            }
            notification_counter();

            $('#sendmsg').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url: 'includes/messages.php',
                    method: 'POST',
                    data: {send: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                    }
                })
            })

             $('body').delegate('#sendbtn', 'click', function(e){
                e.preventDefault();
                alert(2);
                var sendform = $('#sendform').serialize();
                $.ajax({
                    url: 'includes/messages.php',
                    method: 'POST',
                    data: sendform,
                    success: function(data){
                        $('#msg').html(data);
                        $('#sendform').trigger('reset');
                    }
                })
            })
        })
    </script>
   

</body>

</html>
