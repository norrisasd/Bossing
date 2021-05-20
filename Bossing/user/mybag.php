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

     <div class="sidebar">
            <!-- Sidebar  -->
            <nav id="sidebar">

                <div id="dismiss">
                    <i class="fa fa-arrow-left"></i>
                </div>

                <ul class="list-unstyled components">

                    <li >
                        <a href="../index.php">Home</a>
                    </li>
                    <li>
                        <a href="../about.php">About</a>
                    </li>
                    <li>
                        <a href="../recipe.php">Recipe</a>
                    </li>
                    <li>
                        <a href="../blog.php">Blog</a>
                    </li>
                    <li>
                        <a href="../contact.php">Contact Us</a>
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
                        <a class="logo" href="../index.php"><span id="headTitle"><img src="../images/try.png" alt="#" />Bossing's</span></a> 
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="full">
                        <div class="right_header_info">
                            <ul>
                                <?php
                                echo'<li class="button_user"><a class="button" style="border:none;" href="order.php">Order</a></li>
                                <li class="button_user"><a class="button active" style="border:none;" href="#">My Bag</a></li>
                                <li class="button_user"><a class="button" style="border:none;" href="profile.php">Profile</a></li>
                                <li class="button_user"><a class="button" style="border:none;" href="../Logout.php">Logout</a></li>';
                                ?>
                                <li>
                                    <button type="button" id="sidebarCollapse">
                                        <img src="../images/menu_icon.png" alt="#">
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
<div class ="d-block justify-content-center" style="padding-top: 10rem;">
    <?php
        if($_SESSION['checkU']){
    ?>
        <div class="alert alert-success" style="text-align:center;font-size:25px"role="alert">
            Update Success!
        </div>
    <?php
        }
    ?>
    <?php
        if($_SESSION['checkD']){
    ?>
        <div class="alert alert-success" style="text-align:center;font-size:25px"role="alert">
            Delete Success!
        </div>
    <?php
        }
    ?>
    <?php
        if($_SESSION['check']){
    ?>
        <div class="alert alert-success" style="text-align:center;font-size:25px"role="alert">
            Order Success!
        </div>
    <?php
        }
    ?>
    <div class="title" style="padding-bottom:0">
        <h2>My Bag</h2>
    </div>
    <br>
    <div class="d-block justify-content-center">
    <table class="table" style="margin-left:auto;margin-right:auto;width:800px;">
        <thead>
            <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Amount</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
             $checkDisplay=displayBag($db);

            ?>
        </tbody>
    </table>
    <br>
    <?php if($checkDisplay){
        echo'<div class="title" style="padding-bottom:0">
                <div style="display:inline-flex;">
                    <h3 style="margin-left:23rem;;margin-top:0.3rem">Total</h3>
                    <h3 style="margin-left:5rem;margin-top:0.3rem">&#8369;'.totalPrice($db).'</h3>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#placeOrderModal" style="margin-left:5rem;margin-top:0;margin-bottom:1rem;font-size: 15px;">Place Order</button>
                </div>
            </div>';
    }
    ?>
    <form method="post">
        <input type="text" name="prodID" id="prodID" style="display:none">
        <button type="submit" name="deleteProd" id="delete" style="display:none"></button>
    </form>
    <form method="post">
        <button type="submit" name="placeOrder" id="placeOrder" style="display:none"></button>
    </form>
    </div>
</div>
<!-- end content -->
<!-- modal -->

<!-- PLACE ORDER -->
<div class="modal fade" id="placeOrderModal" tabindex="-1" aria-labelledby="editModal"  style="text-align:center" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="margin: 0 auto;padding:0;">
        <div class="title" style="padding-bottom:0;text-align:center">
            <h2>Almost Done!</h2>
            <h5>You just need to fill up this information!</h5>
        </div>
      </div>
    <form method="post">
      <div class="modal-body" style="margin: 0 auto;border:none;">
        <div class="form-group" >
          <input type="text" class="form-control" id="exampleInputEmail1" name="receName" aria-describedby="Username" placeholder="Name of the Receiver" style="border:2px #212020 solid;" required>
        </div>
        <div class="form-group" >
        <style>
        
    </style>
          <input type="number" class="form-control" id="contact" name="receContact" aria-describedby="Username" placeholder="Contact of the Receiver" style="border:2px #212020 solid;" required>
        </div>
        <div class="form-group" >
          <input type="text" class="form-control" id="exampleInputEmail1" name="receAddress" aria-describedby="Username" placeholder="Address of the Receiver" style="border:2px #212020 solid;" required>
        </div>
        <div class="form-group" >
            <select class="form-select" name="courier" required>
                <option selected disabled value="">Delivery Courier</option>
                <?php
                    displayCourier($db);
                ?>
            </select>
        </div>
      </div>
      <div class="modal-footer" style="margin: 0 auto;border:none;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark" name="placeOrder">Confirm</button>
    </form>
      </div>
    </div>
  </div>
</div>

<!-- EDIT -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal"  style="text-align:center" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="margin: 0 auto;padding:0;">
        <div class="title" style="padding-bottom:0;text-align:center">
            <h2>Update</h2>
        </div>
      </div>
      <div class="modal-body" style="margin: 0 auto;border:none;">
            <span class="modalSpan" id="modalText">Orange Juice</span>
            <img src ="../PHP PIC/orange.png" class="rounded mx-auto d-block" id="imgSize" alt="#">
        <form method="post">
        <input type="text" name="initial" id="initial" style="display:none">
        <input type="text" name="pID" id="uprodID" style="display:none">
        <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="modalInput" name="qty" value="0"/></span>
      </div>
      <div class="modal-footer" style="margin: 0 auto;border:none;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark" name="update">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <!-- footer -->
    <script>
        function placeOrder(){
            document.getElementById("placeOrder").click();
        }
        function deleteProd(prodID){
            if(confirm("Are you sure you want to delete this product?")){
                document.getElementById("prodID").value=prodID;
                document.getElementById("delete").click();
            }
            
        }
        function updateProd(prodID,totalQty){
            document.getElementById("initial").value=totalQty;
            document.getElementById("modalInput").value=totalQty;
            document.getElementById("uprodID").value=prodID;

            switch(prodID){
            case 1:
                document.getElementById("modalText").innerHTML="Lumpia Shanghai";
                document.getElementById("imgSize").src="../PHP PIC/lum.png";
                break;
            case 2:
                document.getElementById("modalText").innerHTML="Pork Siomai";
                document.getElementById("imgSize").src="../PHP PIC/siom.png";
                break;
            case 3:
                document.getElementById("modalText").innerHTML="Chopsuey";
                document.getElementById("imgSize").src="../PHP PIC/chop.png";
                break;
            case 4:
                document.getElementById("modalText").innerHTML="Pancit Canton";
                document.getElementById("imgSize").src="../PHP PIC/pancit.png";
                break;
            case 5:
                document.getElementById("modalText").innerHTML="Steamed Rice";
                document.getElementById("imgSize").src="../PHP PIC/steam.png";
                break;
            case 6:
                document.getElementById("modalText").innerHTML="Fried Chicken";
                document.getElementById("imgSize").src="../PHP PIC/chicken.png";
                break;
            case 7:
                document.getElementById("modalText").innerHTML="Beef Bulalo";
                document.getElementById("imgSize").src="../PHP PIC/bul.png";
                break;
            case 8:
                document.getElementById("modalText").innerHTML="Sinigang";
                document.getElementById("imgSize").src="../PHP PIC/sin.png";
                break;
            case 9:
                document.getElementById("modalText").innerHTML="French Fries";
                document.getElementById("imgSize").src="../PHP PIC/fries.png";
                break;
            case 10:
                document.getElementById("modalText").innerHTML="Orange Juice";
                document.getElementById("imgSize").src="../PHP PIC/orange.png";
                break;
        }
            
        }
    </script>
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