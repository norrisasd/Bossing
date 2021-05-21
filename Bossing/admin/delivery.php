<!DOCTYPE html>
<html lang="en">

<head>
    <!-- PHP FILES -->
    <?php include '../DBHelper.php';?>
    <?php include '../functions.php';?>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="icon" href="../images/icon.png">
    <!-- site metas -->
    <title>Bossing's</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- additional -->
    <link rel="stylesheet" href="../css/additional.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- owl css -->
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- responsive-->
    <link rel="stylesheet" href="../css/responsive.css">
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
        <div class="loader"><img src="../images/loading.gif" alt="#" /></div>
    </div>

    <div class="wrapper">
    <!-- end loader -->

     

    <div id="content">
    <!-- header -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="full">
                        <a class="logo" href="../index.php"><span id="headTitle"><img src="../images/try.png" alt="#" />Bossing's</span></a> 
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="full">
                        <div class="right_header_info">
                            <ul>
                                <?php
                                echo'<li class="button_user"><a class="button" style="border:none;" href="dashboard.php">Dashboard</a></li>
                                <li class="button_user"><a class="button" style="border:none;" href="users.php">Users</a></li>
                                <li class="button_user"><a class="button" style="border:none;" href="orders.php">Orders</a></li>
                                <li class="button_user"><a class="button" style="border:none;" href="products.php">Products & Carriers</a></li>
                                <li class="button_user"><a class="button active" style="border:none;" href="#">Delivery</a></li>
                                <li class="button_user"><a class="button" style="border:none;" href="../Logout.php">Logout</a></li>';
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->
<!-- content -->
<div class ="d-block justify-content-center" style="padding-top: 10rem;background-image: url('../images/bg.jpg');">
    <?php
        if($_SESSION['check']){
    ?>
        <div class="alert alert-success" style="text-align:center;font-size:25px"role="alert">
            Confirmed Succesfully!
        </div>
    <?php
        }
    ?>
    <div class="title" style="padding-bottom:0">
        <h2>Delivery</h2>
    </div>
    <div class="title" style="padding-bottom:0">
        <div class="pendel">
            <a href="#" class="activeee" id="pen" onclick="hideDelivered()" style="margin:0 1rem">Pending</a><a href="#" id="del" onclick="hidePending()" style="margin:0 1rem">Delivered</a>
        </div>
    </div>
    <div class="d-block justify-content-center">
    <div id="pending">
    <table class="table" style="margin-left:auto;margin-right:auto;width:auto;">
        <thead>
            <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Delivery ID</th>
            <th scope="col">Receiver Name</th>
            <th scope="col">Receiver Contact</th>
            <th scope="col">Receiver Address</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                displayPending($db);
            ?>
        </tbody>
    </table>
    </div>
    <div id="delivered" style="display:none;">
    <table class="table" style="margin-left:auto;margin-right:auto;width:auto;">
        <thead>
            <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Delivery ID</th>
            <th scope="col">Receiver Name</th>
            <th scope="col">Receiver Contact</th>
            <th scope="col">Receiver Address</th>
            <th scope="col">Date Received</th>
            <th scope="col">Time Received</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                displayDelivered($db);
            ?>
        </tbody>
    </table>
    </div>
    <br>
</div>
<!-- end content -->
<!-- modal -->
<div class="modal fade" id="details" tabindex="-1" aria-labelledby="editModal"  style="text-align:center" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="margin: 0 auto;padding:0;">
        <div class="title" style="padding-bottom:0;text-align:center">
            <h2>ORDERS</h2>
        </div>
      </div>
      <div class="modal-body" id="modalBody" style="margin: 0 auto;border:none;">
      </div>
      <div class="modal-footer" style="margin: 0 auto;border:none;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<form method="post">
    <button type="submit" name="confirmDeli" id="confirm" style="display:none"></button>
</form>
<script>
    function hidePending(){
        document.getElementById("pen").classList.remove("activeee");
        document.getElementById("del").classList.add("activeee");
        document.getElementById("pending").style.display="none";
        document.getElementById("delivered").style.display="flex";
        
    }
    function hideDelivered(){
        document.getElementById("pen").classList.add("activeee");
        document.getElementById("del").classList.remove("activeee");
        document.getElementById("delivered").style.display="none";
        document.getElementById("pending").style.display="block";
    }
    function confirmDeli(id){
        document.getElementById("confirm").value=id;
        document.getElementById("confirm").click();
    }
    function details(prod){
        document.getElementById("modalBody").innerHTML=prod;
    }

</script>
<!-- PLACE ORDER -->
    <!-- footer -->
    <fooetr>
        <div class="footer">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-md-12">
                        <div class="footer_logo" style="padding-bottom:60px;margin:0; padding-top:0">
                            <a class="logo" href="index.php"><span id="headTitle"><img src="../images/try1.png" alt="#" />Bossing's</span></a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="lik">
                            <li > <a href="../index.php">Home</a></li>
                            <li> <a href="../about.php">About</a></li>
                            <li> <a href="../recipe.php">Recipe</a></li>
                            <li> <a href="../blog.php">Blog</a></li>
                            <li> <a href="../contact.php">Contact us</a></li>
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
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/additional.js"></script>
     <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
     <script src="../js/jquery-3.0.0.min.js"></script>
   <script type="text/javascript">
   //AVOID RESUBMISSION FORM
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