<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <!-- PHP FILES -->
    <?php include 'DBHelper.php'?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Bossing's</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icon.png">
    <link rel="stylesheet" href="css/additional.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- owl css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout blog_page">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="" /></div>
    </div>

    <div class="wrapper">
    <!-- end loader -->

     <div class="sidebar">
            <!-- Sidebar  -->
            <nav id="sidebar">

                <div id="dismiss">
                    <i class="fa fa-arrow-left"></i>
                </div>

                <ul class="list-unstyled components">

                    <li >
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="recipe.html">Recipe</a>
                    </li>
                    <li>
                        <a href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact Us</a>
                    </li>
                </ul>

            </nav>
        </div>

    <div id="content">
    <!-- header -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="full">
                        <a class="logo" href="index.html"><span id="headTitle"><img src="images/try.png" alt="#" />Bossing's</span></a> 
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="full">
                        <div class="right_header_info">
                            <ul>
                                <li class="button_user"><a class="button" href="Login.php">Login</a><a class="button active" href="#">Register</a></li>
                                <li>
                                    <button type="button" id="sidebarCollapse">
                                        <img src="images/menu_icon.png" alt="#">
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->
<!-- content -->
<div class ="d-flex justify-content-center" style="flex-flow:row wrap;padding-top: 10rem;">
    <form method="post">
        <div class="form-group" >
            <div class="title" style="padding-bottom:1rem">
                <h2>Registration</h2>
            </div>
        </div>
        <div class="form-group" >
          <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="Username" placeholder="Username" style="border:2px #212020 solid;" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" style="border:2px #212020 solid;" required>
        </div>
        <div class="form-group" >
          <input type="text" class="form-control" id="exampleInputEmail1" name="firstname" aria-describedby="Username" placeholder="Firstname" style="border:2px #212020 solid;" required>
        </div>
        <div class="form-group" >
            <input type="text" class="form-control" id="exampleInputEmail1" name="lastname" aria-describedby="Username" placeholder="Lastname" style="border:2px #212020 solid;" required>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" id="exampleInputPassword1" name="contact" placeholder="Contact" style="border:2px #212020 solid;" required>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
          <label class="form-check-label" for="exampleCheck1">Terms & Conditions ...</label>
        </div>
        <button type="submit" class="btn btn-primary" name="register" style="margin-top: 1rem;background-color:#212020; border:none">Register</button>
        <!-- ERROR REGISTRATION -->
        <?php
        if($_SESSION['check']){
        ?>
        <div style="border:1px solid red;margin-top:20px;text-align:center;background-color:#fec1c1" >
        <h3 style="margin-top:5px"><b>Invalid Username</b></h3>
        </div>
        <?php
        }
        ?>

      </form>
</div>
<!-- end content -->
<!-- footer -->
    <fooetr>
        <div class="footer">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-md-12">
                        <div class="footer_logo" style="padding-bottom:60px;margin:0; padding-top:0">
                            <a class="logo" href="index.html"><span id="headTitle"><img src="images/try1.png" alt="#" />Bossing's</span></a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="lik">
                            <li > <a href="index.html">Home</a></li>
                            <li> <a href="about.html">About</a></li>
                            <li> <a href="recipe.html">Recipe</a></li>
                            <li> <a href="blog.html">Blog</a></li>
                            <li> <a href="contact.html">Contact us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="new">
                            <h3>Newsletter</h3>
                            <form class="newtetter">
                                <input class="tetter" placeholder="Your email" type="text" name="Your email">
                                <button class="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <p>Copyright © 2020, Bossing's Restaurant. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </fooetr>
    <!-- end footer -->
    </div>
    </div>
    <div class="overlay"></div>
    
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
     <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    
     <script src="js/jquery-3.0.0.min.js"></script>
   <script type="text/javascript">
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        $(document).ready(function() {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function() {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>

</html>