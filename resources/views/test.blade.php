<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quillz</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    
    
   <!--************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="">
                    <b class="logo-abbr"><img height="40" width="180" src="images/Quillz-logos-logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/Quillz-logo-text.png" alt=""></span>
                    <span class="brand-title">
                        <img height="50" width="180" src="images/Quillz-logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">   
            
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    
                    <div class="hamburger">
                        
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                    
                </div>
                
                <div class="header-left">
                    
                </div>
                
                <div class="header-right">
                    
                    <ul class="clearfix">
                        
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                                <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">عربي</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                
                                <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href=""><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        
                                        <hr class="my-2">
                                        
                                        <li><a href=""><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Home</li>
                    <hr class="my-2">
                    <li>
                        <a href="javascript:void()" aria-expanded="false">
                            <i class="icon-book-open menu-icon"></i><span class="nav-text">Your library</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void()" aria-expanded="false">
                            <i class="icon-social-dropbox menu-icon"></i><span class="nav-text">Question bank</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Question Bank</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body mr-3">
                            <div style="float: left;" class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Catagory</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">all catagories</a>
                                            <a class="dropdown-item" href="#">SWE 434</a> 
                                            <a class="dropdown-item" href="#">SWE 481</a>
                                            <a class="dropdown-item" href="#">SWE 455</a>
                                        </div>
                                    </div><br><br><hr><br>
                                <h4 class="card-title">Catagories</h4>
                                <p class="text-muted"><code></code>
                                </p>
                                <div id="accordion-three" class="accordion">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4"><i class="fa" aria-hidden="true"></i> SWE434</h5>
                                        </div>
                                        <div id="collapseOne4" class="collapse show" data-parent="#accordion-three">
                                            <div class="card-body"> 
                                                <div class="col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-header">Question 1</div>
                                    <div class="card-body">
                                        <h5 class="card-title">How are you ?</h5>
                                        <div class="card-text">
                                            <h6>answers:</h6>
                                        <div class="basic-list-group">
                                    <ul class="list-group">
                                        <li class="list-group-item">fine</li>
                                        <li class="list-group-item">not good</li>
                                        <li class="list-group-item">meh</li>
                                        
                                    </ul>
                                </div>
                                            
                                        </div><br>
                                    <a href="#" class="btn btn-primary">Import to Quiz</a>
                                    </div>
                                </div>
                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo5" aria-expanded="false" aria-controls="collapseTwo5"><i class="fa" aria-hidden="true"></i>SWE 481</h5>
                                        </div>
                                        <div id="collapseTwo5" class="collapse" data-parent="#accordion-three">
                                            <div class="card-body"> </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree6" aria-expanded="false" aria-controls="collapseThree6"><i class="fa" aria-hidden="true"></i> SWE 455</h5>
                                        </div>
                                        <div id="collapseThree6" class="collapse" data-parent="#accordion-three">
                                            <div class="card-body">Anim </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
      
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/gleek.js') }}"></script>
    <script src="{{ asset('js/styleSwitcher.js') }}"></script>

</body>

</html>