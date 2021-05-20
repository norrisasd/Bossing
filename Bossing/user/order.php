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
                                echo'<li class="button_user"><a class="button active" style="border:none;" href="#">Order</a></li>
                                <li class="button_user"><a class="button" style="border:none;" href="mybag.php">My Bag</a></li>
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
        if($_SESSION['check']){
    ?>
        <div class="alert alert-success" style="text-align:center;font-size:25px"role="alert">
            Added to Bag
        </div>
    <?php
        }
    ?>
    <div class="title" style="padding-bottom:0">
        <h2>Order</h2>
    </div>
    <div class="d-flex justify-content-center">
        <div class="rowItem">
            <span><b>Fried Chicken</b></span>
            <img src ="../PHP PIC/chicken.png" class="rounded mx-auto d-block" alt="#">
            <span>&#8369;40</span>
            <br>
            <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="chicken" placeholder="0"/></span>
            <br>
            <button type="button" class="btn btn-dark" onclick="setProdQuant(6)">Add To Bag</button>
        </div>
        <div class="rowItem">
            <span><b>Chopsuey</b></span>
            <img src ="../PHP PIC/chop.png" class="rounded mx-auto d-block" alt="#">
            <span>&#8369;20</span>
            <br>
            <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="chop" placeholder="0"/></span>
            <br>
            <button type="button" class="btn btn-dark" onclick="setProdQuant(3)">Add To Bag</button>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="rowItem">
            <span><b>Lumpia Shanghai</b></span>
            <img src ="../PHP PIC/lum.png" class="rounded mx-auto d-block" alt="#">
            <span>&#8369;10</span>
            <br>
            <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="lumpia" value="0"/></span>
            <br>
            <button type="button" class="btn btn-dark" onclick="setProdQuant(1)">Add To Bag</button>
        </div>
        <div class="rowItem">
            <span><b>Pancit Canton</b></span>
            <img src ="../PHP PIC/pancit.png" class="rounded mx-auto d-block" alt="#">
            <span>&#8369;30</span>
            <br>
            <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="pancit" value="0"/></span>
            <br>
            <button type="button" class="btn btn-dark" onclick="setProdQuant(4)">Add To Bag</button>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="rowItem">
            <span><b>Steamed Rice</b></span>
            <img src ="../PHP PIC/steam.png" class="rounded mx-auto d-block" alt="#">
            <span>&#8369;25</span>
            <br>
            <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="steamed" value="0"/></span>
            <br>
            <button type="button" class="btn btn-dark" onclick="setProdQuant(5)">Add To Bag</button>
        </div>
        <div class="rowItem">
            <span><b>Beef Bulalo</b></span>
            <img src ="../PHP PIC/bul.png" class="rounded mx-auto d-block" alt="#">
            <span>&#8369;50</span>
            <br>
            <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="bulalo" value="0"/></span>
            <br>
            <button type="button" class="btn btn-dark" onclick="setProdQuant(7)">Add To Bag</button>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="rowItem">
            <span><b>Sinigang</b></span>
            <img src ="../PHP PIC/sin.png" class="rounded mx-auto d-block" alt="#">
            <span>&#8369;50</span>
            <br>
            <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="sinigang" value="0"/></span>
            <br>
            <button type="button" class="btn btn-dark" onclick="setProdQuant(8)">Add To Bag</button>
        </div>
        <div class="rowItem">
            <span><b>Pork Siomai</b></span>
            <img src ="../PHP PIC/siom.png" class="rounded mx-auto d-block" alt="#">
            <span>&#8369;10</span>
            <br>
            <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="siomai" value="0"/></span>
            <br>
            <button type="button" class="btn btn-dark" onclick="setProdQuant(2)">Add To Bag</button>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="rowItem">
            <span><b>French Fries</b></span>
            <img src ="../PHP PIC/fries.png" class="rounded mx-auto d-block" alt="#">
            <span>&#8369;30</span>
            <br>
            <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="fries" value="0"/></span>
            <br>
            <button type="button" class="btn btn-dark" onclick="setProdQuant(9)">Add To Bag</button>
        </div>
        <div class="rowItem">
            <span><b>Orange Juice</b></span>
            <img src ="../PHP PIC/orange.png" class="rounded mx-auto d-block" alt="#">
            <span>&#8369;20</span>
            <br>
            <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="juice" value="0"/></span>
            <br>
            <button type="button" class="btn btn-dark" onclick="setProdQuant(10)">Add To Bag</button>
        </div>
    </div>
    <form method="post">
        <input type="number" name="prodID" id="prodID" style="display:none">
        <input type="number" name="quantity" id="quantity" style="display:none">
        <button type="submit" name="addToBag" id="addBag" style="display:none"></button>
    </form>
    <script>
        function setProdQuant(prodID){
        var pID = document.getElementById("prodID").value=prodID;
        switch(pID){
            case 1:
                var prodQ = document.getElementById("lumpia").value;//
                document.getElementById("quantity").value=prodQ;
                break;
            case 2:
                var prodQ = document.getElementById("siomai").value;//
                document.getElementById("quantity").value=prodQ;
                break;
            case 3:
                var prodQ = document.getElementById("chop").value;
                document.getElementById("quantity").value=prodQ;
                break;
            case 4:
                var prodQ = document.getElementById("pancit").value;
                document.getElementById("quantity").value=prodQ;
                break;
            case 5:
                var prodQ = document.getElementById("steamed").value;
                document.getElementById("quantity").value=prodQ;
                break;
            case 6:
                var prodQ = document.getElementById("chicken").value;
                document.getElementById("quantity").value=prodQ;
                break;
            case 7:
                var prodQ = document.getElementById("bulalo").value;
                document.getElementById("quantity").value=prodQ;
                break;
            case 8:
                var prodQ = document.getElementById("sinigang").value;
                document.getElementById("quantity").value=prodQ;
                break;
            case 9:
                var prodQ = document.getElementById("fries").value;
                document.getElementById("quantity").value=prodQ;
                break;
            case 10:
                var prodQ = document.getElementById("juice").value;
                document.getElementById("quantity").value=prodQ;
                break;
        }
        document.getElementById("addBag").click();
        }
    </script>
</div>
<!-- end content -->
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