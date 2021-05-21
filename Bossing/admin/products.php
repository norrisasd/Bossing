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
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
    </style>
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
                                <li class="button_user"><a class="button active" style="border:none;" href="#">Products & Carriers</a></li>
                                <li class="button_user"><a class="button" style="border:none;" href="delivery.php">Delivery</a></li>
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
        if($_SESSION['checkU']){
    ?>
        <div class="alert alert-success" style="text-align:center;font-size:25px"role="alert">
            Updated Successfully!
        </div>
    <?php
        }
    ?>
    <?php
        if($_SESSION['checkD']){
    ?>
        <div class="alert alert-success" style="text-align:center;font-size:25px"role="alert">
            Deleted Successfully!
        </div>
    <?php
        }
    ?>
    <?php
        if($_SESSION['check']){
    ?>
        <div class="alert alert-success" style="text-align:center;font-size:25px"role="alert">
            Added Successfully!
        </div>
    <?php
        }
    ?>
    <div class="title" style="padding-bottom:0">
        <h2>Products</h2>
    </div>
    <div class="title" style="padding-bottom:0">
        <div class="pendel">
            <a href="#" class="activeee" id="prod" onclick="hideProducts()" style="margin:0 1rem">Products</a><a href="#" id="carr" onclick="hideCarriers()" style="margin:0 1rem">Carriers</a>
        </div>
    </div>
    <br>
    <div class="d-block justify-content-center">
        <div id="products">
            <table class="table" style="margin-left:auto;margin-right:auto;width:800px;">
                <thead>
                    <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        displayAllProducts($db);
                    ?>
                </tbody>
            </table>
            <center><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addProduct" style="margin-top:3rem;">Add Product</button></center>
        </div>
        <div id="carriers" style="display:none">
            <table class="table" style="margin-left:auto;margin-right:auto;width:800px;">
                <thead>
                    <tr>
                    <th scope="col">Delivery_ID</th>
                    <th scope="col">Delivery Carrier</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        displayAllCarrier($db);
                    ?>
                </tbody>
            </table>
            <center><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCarrier" style="margin-top:3rem;">Add Carrier</button></center>
        </div>
    
    <br>
    <!-- delete Prod -->
    <form method="post">
        <button type="submit" name="delProd" id="delProd" style="display:none"></button>
    </form>
    <!-- delete carr -->
    <form method="post">
        <button type="submit" name="delCarr" id="delCarr" style="display:none"></button>
    </form>
    </div>
</div>
<!-- end content -->
<!-- modal -->
<!-- edit carrier  -->
<div class="modal fade" id="editCarrier" tabindex="-1" aria-labelledby="editModal"  style="text-align:center" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="margin: 0 auto;padding:0;">
        <div class="title" style="padding-bottom:0;text-align:center">
            <h2>Update Carrier</h2>
        </div>
      </div>
      <div class="modal-body" style="margin: 0 auto;border:none;">
        <form method="post">
        <div class="form-group" >
          <input type="text" class="form-control" id="cName" name="cName" aria-describedby="Username" placeholder="Name of the Carrier" style="border:2px #212020 solid;" required>
        </div>
      </div>
      <div class="modal-footer" style="margin: 0 auto;border:none;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark" name="editCarrier" id="editCarr">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- add carrier  -->
<div class="modal fade" id="addCarrier" tabindex="-1" aria-labelledby="editModal"  style="text-align:center" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="margin: 0 auto;padding:0;">
        <div class="title" style="padding-bottom:0;text-align:center">
            <h2>Add Carrier</h2>
        </div>
      </div>
      <div class="modal-body" style="margin: 0 auto;border:none;">
        <form method="post">
        <div class="form-group" >
          <input type="text" class="form-control" id="exampleInputEmail1" name="cName" aria-describedby="Username" placeholder="Name of the Carrier" style="border:2px #212020 solid;" required>
        </div>
      </div>
      <div class="modal-footer" style="margin: 0 auto;border:none;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark" name="addCarrier">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- edit product -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editModal"  style="text-align:center" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="margin: 0 auto;padding:0;">
        <div class="title" style="padding-bottom:0;text-align:center">
            <h2>Update This Product!</h2>
        </div>
      </div>
    <form method="post">
      <div class="modal-body" style="margin: 0 auto;border:none;">
        <form method="post">
        <div class="form-group" >
          <input type="text" class="form-control" id="pName" name="pName" aria-describedby="Username" style="border:2px #212020 solid;" required>
        </div>
        <div class="form-group" >
          <input type="Number" class="form-control" id="pPrice" name="pPrice" aria-describedby="Username"  style="border:2px #212020 solid;" required>
        </div>
      </div>
      <div class="modal-footer" style="margin: 0 auto;border:none;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark" id="updateProduct" name="updateProduct">Update</button>
    </form>
      </div>
    </div>
  </div>
</div>

<!-- EDIT -->
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="editModal"  style="text-align:center" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="margin: 0 auto;padding:0;">
        <div class="title" style="padding-bottom:0;text-align:center">
            <h2>Add Product</h2>
        </div>
      </div>
      <div class="modal-body" style="margin: 0 auto;border:none;">
        <form method="post">
        <div class="form-group" >
          <input type="text" class="form-control" id="exampleInputEmail1" name="pName" aria-describedby="Username" placeholder="Name of the Product" style="border:2px #212020 solid;" required>
        </div>
        <div class="form-group" >
          <input type="Number" class="form-control" id="exampleInputEmail1" name="pPrice" aria-describedby="Username" placeholder="Price of the Product" style="border:2px #212020 solid;" required>
        </div>
      </div>
      <div class="modal-footer" style="margin: 0 auto;border:none;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark" name="addProduct">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <!-- footer -->
    <script>
        function hideProducts(){
        document.getElementById("carr").classList.remove("activeee");
        document.getElementById("prod").classList.add("activeee");
        document.getElementById("products").style.display="block";
        document.getElementById("carriers").style.display="none";
        
        }
        function hideCarriers(){
            document.getElementById("carr").classList.add("activeee");
            document.getElementById("prod").classList.remove("activeee");
            document.getElementById("products").style.display="none";
            document.getElementById("carriers").style.display="block";
        }
        function deleteProd(id){
            if(confirm("Are you sure you want to delete this product?")){
                document.getElementById("delProd").value=id;
                document.getElementById("delProd").click();
            }
        }
        function updateProd(id,name,price){
            document.getElementById("updateProduct").value=id;
            document.getElementById("pName").value=name;
            document.getElementById("pPrice").value=id;
        }
        function updateCarr(id,name){
            document.getElementById("editCarr").value=id;
            document.getElementById("cName").value=name;
        }
        function deleteCarr(id){
            if(confirm("Are you sure you want to delete this Carrier?")){
                document.getElementById("delCarr").value=id;
                document.getElementById("delCarr").click();
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