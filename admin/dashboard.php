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
    <link href="vendors/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="vendors/chosen/chosen.min.css">
    <link rel="stylesheet" href="vendors/bootstrap-select/css/bootstrap-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body style="background: black; color: white;">

    <aside id="left-panel" class="left-panel" style="background: #1b2a47; color: white;">
        <nav class="navbar navbar-expand-sm navbar-default" style="background: #1b2a47; color: white;">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/lasu.png" alt="Logo" height="100" width="100"></a>
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
                        <a href="#" id="bookrequest"><i class="menu-icon fa fa-book"></i>Book Requests </a>
                    </li>
                    <li>
                        <a href="#" id="sendmsg"><i class="menu-icon fa fa-inbox"></i>Compose Message </a>
                    </li>

                     <li>
                        <a href="#" id="notification" class="notification"><i class="menu-icon fa fa-bell"></i>Notification <span class="badge badge-danger notify">9</span></a>
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
                            <button class="btn btn-secondary dropdown-toggle notification" type="button" id="notification" style="color:white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger notify">0</span>
                            </button>
                            
                        </div>

                        
                    </div>
                </div>

               
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <!-- Modal -->
                    <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                      <div class='modal-dialog' role='document'>
                        <div class='modal-content' style="background: #1b2a47; color: white;">
                          <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLabel'>Book Details</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>
                          <div class='modal-body' id="showbookdetails" style="background: #1b2a47; color: white;">
                            
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>

                     <!-- Modal -->
                    <div class='modal fade' id='exampleModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                      <div class='modal-dialog' role='document'>
                        <div class='modal-content' style="background: #1b2a47; color: white;">
                          <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLabel'>Student Details</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>
                          <div class='modal-body' id="showstudentdetails" style="background: #1b2a47; color: white;">
                            
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>

        <div class="content mt-3">
           
            <div id="dashboard"></div>


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/bootstrap-4.1/popper.min.js"></script>
    <script src="vendors/bootstrap-4.1/bootstrap.min.js"></script>
    
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="vendors/chosen/chosen.jquery.min.js"></script>
    <script src="vendors/bootstrap-select/js/bootstrap-select.js"></script>

    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
 
    <script>
         jQuery(document).ready(function($){

            $('[data-toggle="tooltip"]').tooltip();
            
            function dashboard() {
                $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {dashboard: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                        recent_registered_students();
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

            function registerStd(){
                 $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {registerstd: 1},
                    success: function(data){
                        $('#registerStd').html(data);
                        registerStd();
                    }
                })
            } 
            registerStd();

            function addedBook(){
                 $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {addedbook: 1},
                    success: function(data){
                        $('#addedbook').html(data);
                        addedBook();
                    }
                })
            } 
            addedBook();

            function issuedBook(){
                 $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {issuebook: 1},
                    success: function(data){
                        $('#issuedbook').html(data);
                        issuedBook();
                    }
                })
            } 
            issuedBook();

            function notreturnBook(){
                 $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {notreturnbook: 1},
                    success: function(data){
                        $('#notreturnbook').html(data);
                        notreturnBook();
                    }
                })
            } 
            notreturnBook();


            $('body').delegate('.approveStd', 'click', function(e){
                e.preventDefault();
                
                var sid = $(this).attr('pid');

                $.ajax({
                    url: 'includes/dashboard.php',
                    method: 'POST',
                    data: {approvedId: 1, sid:sid},
                    success: function(data){
                        $('#msg').html(data);
                        recent_registered_students();

                    }
                })
            });

            var approvestds = $('#approvestds');
            approvestds.on('click', function(e){
                e.preventDefault();
                approvestudents();
               
            });

            function approvestudents() {
                 $.ajax({
                    url: 'includes/students.php',
                    method: 'POST',
                    data: {approvestd: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                    }
                })
            }


            var notapprovedstds = $('#notapprovedstds');
            notapprovedstds.on('click', function(e){
                e.preventDefault();
                
                $.ajax({
                    url: 'includes/students.php',
                    method: 'POST',
                    data: {notapprovestd: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                    }
                })

            })

            $('#addbook').on('click', function(e){
                e.preventDefault();
               
                addbook();
            })

            function addbook(){
                $.ajax({
                    url: 'includes/books.php',
                    method: 'POST',
                    data: {addbook: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                    }
                })
            }

            $('body').delegate('#addBtn', 'click', function(e){
                e.preventDefault();


                var fdata = new FormData();
                fdata.append("bookname", $("#bookname").val());
                fdata.append("bookcategory", $("#bookcategory").val());
                fdata.append("bookauthorname", $("#bookauthorname").val());
                fdata.append("publicationdate", $("#publicationdate").val());
                fdata.append("purchasedate", $("#purchasedate").val());
                fdata.append("bookqty", $("#bookqty").val());
                fdata.append("availableqty", $("#availableqty").val());
                
                if($("#file")[0].files.length > 0)
                    fdata.append('file', $("#file")[0].files[0])
                    console.log(fdata);
                $.ajax({
                    url: 'includes/books.php',
                    method: 'POST',
                    data: fdata,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        $('#alert').html(data);
                            
                            $('#bookname').val("");
                            $('#bookcategory').val("");
                            $('#bookauthorname').val("");
                            $('#publicationdate').val("");
                            $('#purchasedate').val("");
                            $('#bookqty').val("");
                            $('#availableqty').val("");
                            
                    }
                })
                
                /*var fdata = $('#addBook').serialize();

                    $.ajax({
                        url: 'includes/books.php',
                        method: 'POST',
                        data: fdata,
                        success: function(data){
                            $('#alert').html(data);
                            $('#addBook').trigget('reset');
                            
                            $('#bookname').val("");
                            $('#bookcategory').val("");
                            $('#bookauthorname').val("");
                            $('#publicationdate').val("");
                            $('#purchasedate').val("");
                            $('#bookqty').val("");
                            $('#availableqty').val("");
                            
                        }
                    })*/
                });

            $('#managebook').on('click', function(e){
                e.preventDefault();

                managebook();
                
            })

            function managebook(){
                $.ajax({
                        url: 'includes/books.php',
                        method: 'POST',
                        data: {managebook: 1},
                        success: function(data){
                            $('#dashboard').html(data);
                            
                        }
                    })
            }

            $('body').delegate('#viewbookdetails', 'click', function(e){
                e.preventDefault();
                var pid = $(this).attr('pid');
                alert(pid);
                
                $.ajax({
                    url: 'includes/books.php',
                    method: 'POST',
                    data: {viewbook:1, pid:pid},
                    success: function(data){
                        $('#showbookdetails').html(data);
                    }
                });
            })

            $('body').delegate('#viewstudent', 'click', function(e){
                e.preventDefault();
                var pid = $(this).attr('pid');
               // alert(pid);
                
                $.ajax({
                    url: 'includes/students.php',
                    method: 'POST',
                    data: {viewstudent:1, pid:pid},
                    success: function(data){
                        $('#showstudentdetails').html(data);
                    }
                });
            })

             $('body').delegate('#deletestudent', 'click', function(e){
                e.preventDefault();
               // alert(1);
                var pid = $(this).attr('pid');
               
                $.ajax({
                    url: 'includes/students.php',
                    method: 'POST',
                    data: {deletestudent:1, pid:pid},
                    success: function(data){
                        alert(data);
                       // managebook();
                       approvestudents();
                    }
                })
            })

            $('body').delegate('#deletebook', 'click', function(e){
                e.preventDefault();
                var pid = $(this).attr('pid');
               
                $.ajax({
                    url: 'includes/books.php',
                    method: 'POST',
                    data: {deletebook:1, pid:pid},
                    success: function(data){
                        alert(data);
                        managebook();
                    }
                })
            })
            /*$('#issueBook').click(function(e){
                e.preventDefault();

                $.ajax({
                        url: 'includes/issue_book.php',
                        method: 'POST',
                        data: {issuebook: 1},
                        success: function(data){
                            $('#dashboard').html(data);
                            
                        }
                    })
            })*/

            $('#keywords').keyup(function(e){
                e.preventDefault();
                var keywords = $(this).val();
                if(keywords == ''){
                    dashboard();
                    recent_registered_students();
                    registerStd();
                    addedBook();
                    issuedBook();
                    notreturnBook();
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

            $('#issueBook').click(function(e){
                e.preventDefault();

                 window.location.href="issueBook.php";
            });

            $('#issueBtn').on('click', function(e){
                e.preventDefault();
                
                var option = $('#selected option:selected').val();

                $.ajax({
                        url: 'includes/issue_book.php',
                        method: 'POST',
                        data: {issuebook: 1, option:option},
                        success: function(data){
                            $('#issueform').html(data);
                            
                        }
                    })
            })

            $('body').delegate('#submitIssue', 'click', function(e){
                e.preventDefault();
                
                var matric = $('#matricno').val();
                var firstname = $('#firstname').val();
                var lastname = $('#lastname').val();
                var email = $('#email').val();
                var department = $('#department').val();
                var level = $('#level').val();
                var book = $('#books option:selected').val();
                var issuedate = $('#issuedate').val();

                    $.ajax({
                        url: 'includes/issue_book.php',
                        method: 'POST',
                        data: {submitIssue:1, matric:matric, firstname:firstname, lastname:lastname, email:email, department:department, level:level, book:book, issuedate:issuedate},
                        success: function(data){
                            $('#alert').html(data);
                        }
                    })
            })

            $('#returnedBook').click(function(e){
                e.preventDefault();

                window.location.href="returnBook.php";
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
                        $('#dashboard').html(data);
                    }
                })
            })

            function bookrequest(){
                $.ajax({
                    url: 'includes/books.php',
                    method: 'POST',
                    data: {viewall: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                    }
                })
            }

            $('#bookrequest').click(function(e){
                e.preventDefault();

                bookrequest();
                
            })

            $('body').delegate('#issuerequest', 'click', function(e){
                e.preventDefault();
                var bid = $(this).attr('bid');

                $.ajax({
                    url: 'includes/books.php',
                    method: 'POST',
                    data: {issuerequest: 1, bid:bid},
                    success: function(data){
                        $('#requestalert').html(data);
                        bookrequest();
                    }
                })

            });



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

            $('.notification').click(function(e){
                e.preventDefault();
               notification();
            })

            function notification(){
                 $.ajax({
                    url: 'includes/notification.php',
                    method: 'POST',
                    data: {notification: 1},
                    success: function(data){
                        $('#dashboard').html(data);
                         notification_counter();
                    }
                })
            }

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

            $('body').delegate('#deletemessage', 'click', function(event){
                event.preventDefault();

                var mid = $(this).attr('mid');
                alert(mid);

                $.ajax({
                    url: 'includes/notification.php',
                    method: 'POST',
                    data: {deletemessage: 1, mid: mid},
                    success: function(data){
                        $('#msgstatus').html(data);
                        notification();
                    }
                })
            })

        });
    </script>

</body>

</html>
