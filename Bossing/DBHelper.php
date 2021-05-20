<?php
     $host="localhost";
     $user="root";
     $pass="";
     $data="fooddeliverysystem";
    // HOSTING
    //$user="Xn15Dg4HjH";
    //$host="remotemysql.com";
    //$pass="0lBbv6IvK4";
    //$data="Xn15Dg4HjH";
    $db = mysqli_connect($host,$user,$pass,$data);
        //local
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $username="";
    session_start();
    // LOGIN
    $_SESSION['check']=false;
    $_SESSION['checkU']=false;
    $_SESSION['checkD']=false;
    if(isset($_POST["Submit"])){
        $user=$_POST["username"];
        $pass=$_POST["password"];
        $query="SELECT * FROM `tbluser` WHERE Username ='$user' and Password='$pass'";
        $result = mysqli_query($db,$query);
        $rows = mysqli_num_rows($result);
        if($rows==1){
            $_SESSION['login']=true;
            $_SESSION['username']=$user;
            header("Location: ./index.php");
        }else{
        $_SESSION['check']=true;
        }
    }
    // REGISTER
    if(isset($_POST['register'])){
        $user=$_POST["username"];
        $pass=$_POST["password"];
        $first=$_POST["firstname"];
        $last=$_POST["lastname"];
        $contact=(string)$_POST["contact"];
        $query="INSERT INTO tbluser (Username,Password,First_Name,Last_Name,Phone_Number) VALUES ('$user','$pass','$first','$last','$contact')";
        $result = mysqli_query($db,$query);
        if($result){
            header("Location: ./Login.php");
        }else{
            $_SESSION['check']=true;
        }
    }
    //fetch OID ----------
    if(isset($_SESSION['username']))
        $username=$_SESSION['username'];

    $queryOID="SELECT * FROM `tblorder` WHERE Total_Price IS NULL and Username ='$username'";
    $resultOID = mysqli_query($db,$queryOID);
    $rowsOID=mysqli_num_rows($resultOID);
    if($rowsOID==1){
        $data = mysqli_fetch_assoc($resultOID);
        $_SESSION['orderID']=$data['Order_ID'];
    }else{
        $_SESSION['orderID']=null;
    }
//----------------------------

    if(isset($_POST['addToBag'])){// insert order to the bag
        $prodID=$_POST['prodID'];
        $quantity=$_POST['quantity'];
        $username=$_SESSION['username'];
        if($rowsOID==0){//check if there is no Order
            $queryRows="SELECT * FROM `tblorder`";
            $resultRows = mysqli_query($db,$queryRows);
            $rowsCount=mysqli_num_rows($resultRows);
            $_SESSION['orderID']=$rowsCount+1;
            $queryInsert="INSERT INTO `tblorder`(`Username`) VALUES ('$username')";
            $resultInsert=mysqli_query($db,$queryInsert);
            if(!$resultInsert){
                echo '<script>alert("There was an Error!");</script>';
            }
        }
        $oID=$_SESSION['orderID'];
        $queryOrder="INSERT INTO `tblorderdetails`(`Order_ID`, `Product_ID`, `Quantity`) VALUES ($oID,$prodID,$quantity)";
        $resultOrder=mysqli_query($db,$queryOrder);
        if($resultOrder){
            $_SESSION['check']=true;
        }else{
            echo '<script>alert("There was an Error!");</script>';
        }
    }

       //DISPLAY BAG
    function displayBag($db){//display the products in the bag
        $order_id=$_SESSION['orderID'];
        if($order_id == null){
            echo'<tr height="200px" style="line-height:200px">
                    <td COLSPAN="5" style="font-size:35px; text-align:center;">BAG IS EMPTY</td>
                </tr>';
            return false;
        }
        $query="SELECT DISTINCT `tblproduct`.`Product_Name`,`tblproduct`.`Product_Price`,SUM(`tblorderdetails`.`Quantity`) AS TotalQty,`tblproduct`. `Product_Price`*SUM(`tblorderdetails`.`Quantity`) AS Initial, `tblorderdetails`.`Product_ID`, `tblorderdetails`.`Order_ID` FROM `tblorderdetails`,`tblproduct` WHERE `tblorderdetails`.`Product_ID` = `tblproduct`.`Product_ID` and `tblorderdetails`.`Order_ID` = $order_id GROUP BY `tblproduct`.`Product_Name`,`tblproduct`.`Product_Price`";
        $result=mysqli_query($db,$query);
        $rowCheck=mysqli_num_rows($result);
        if($rowCheck>=1){
            while($row=mysqli_fetch_assoc($result)){
                echo'<tr>
                        <th scope="row">'.$row['Product_Name'].'</th>
                        <td>&#8369;'.$row['Product_Price'].'</td>
                        <td>'.$row['TotalQty'].'</td>
                        <td>&#8369;'.$row['Initial'].'</td>
                        <td>
                            <i class="fa fa-minus" aria-hidden="true" onclick="deleteProd('.$row['Product_ID'].')"></i> &nbsp &nbsp &nbsp
                            <i class="fa fa-pencil-square-o" data-toggle="modal" data-target="#editModal" onclick="updateProd('.$row['Product_ID'].','.$row['TotalQty'].')"aria-hidden="true"></i>
                        </td>
                    </tr>';
            }  
        }else{
        echo'<tr height="200px" style="line-height:200px">
                <td COLSPAN="5" style="font-size:35px; text-align:center;">BAG IS EMPTY</td>
            </tr>';
        return false;
        }
        mysqli_free_result($result);
        return true;
       }
    function totalPrice($db){//get the total price
        if($_SESSION['orderID']== null){
            return;
        }
        $oid=$_SESSION['orderID'];
        $query="SELECT SUM(tblproduct.Product_Price*tblorderdetails.Quantity) AS total FROM tblproduct,tblorderdetails WHERE tblproduct.Product_ID=tblorderdetails.Product_ID and  tblorderdetails.Order_ID=$oid";
        $result=mysqli_query($db,$query);
        $data=mysqli_fetch_assoc($result);
        return $data['total'];
    }
    if(isset($_POST['deleteProd'])){//delete prod
        $oid=$_SESSION['orderID'];
        $pid=$_POST['prodID'];
        $qDelProd="DELETE FROM `tblorderdetails` WHERE Order_ID=$oid and Product_ID=$pid";
        $rDelProd=mysqli_query($db,$qDelProd);
        if($rDelProd)
            $_SESSION['checkD']=true;
    }
    function deleteLess1($db){// automatically deletes 1
        $oid=$_SESSION['orderID'];
        $queryS="SELECT `Quantity`,`Product_ID` FROM `tblorderdetails` WHERE `Quantity` <0 and `Order_ID` = $oid";
        $queryD="DELETE FROM `tblorderdetails` where `Quantity`<1 and `Order_ID` = $oid";
        $resultS=mysqli_query($db,$queryS);
        if(mysqli_num_rows($resultS)>=1){
            $data=mysqli_fetch_assoc($resultS);
            $qty=$data['Quantity'];
            $pid=$data['Product_ID'];
            mysqli_query($db,$queryD);
            $queryU="UPDATE `tblorderdetails` SET `Quantity` =`Quantity`+$qty WHERE `Order_ID`=$oid and `Product_ID`=$pid";
            mysqli_query($db,$queryU);
            mysqli_query($db,$queryD);//delete if the updated qty is 0
        }else{
            mysqli_query($db,$queryD);
        }
    }
    function displayCourier($db){//display delivery carriers
        $query="SELECT * FROM `tbldelivery`";
        $result=mysqli_query($db,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['Delivery_ID'].'">'.$data['Delivery_Carrier'].'</option>';
            }
        }
    }
    function displayOrders($db){
        $user = $_SESSION['username'];
        $query="SELECT * FROM tblorder WHERE Total_Price is not NULL and  Username='$user'";
        $result=mysqli_query($db,$query);
        if(mysqli_num_rows($result)>=1){
            while($data=mysqli_fetch_assoc($result)){
                echo '<tr>
                        <th scope="row"><a href="#" data-toggle="modal" data-target="#orderModal" onclick="getOrderId('.$data['Order_ID'].')" style="text-decoration:none">'.$data['Order_ID'].'</a></th>
                        <td>'.$data['Date_Ordered'].'</td>
                        <td>'.$data['Total_Price'].'</td>
                        </tr>
                     <tr>';
            }
        }
    }
    function displayOrderProducts($db){
        
        echo'check';
    }
    function getUserInfo($db){
        $user = $_SESSION['username'];
        $query="SELECT * FROM tbluser where Username = '$user'";
        $result=mysqli_query($db,$query);
        if(mysqli_num_rows($result)== 1){
            $data = mysqli_fetch_assoc($result);
            return $data;
        } 
    }
    if(isset($_POST['update'])){//update Qty
        $initial=$_POST['initial'];
        $uOid=$_SESSION['orderID'];
        $qty=$_POST['qty'];
        $uPid=$_POST['pID'];
        $finalQty=$qty-$initial;
        $qUpdateProd="UPDATE tblorderdetails SET `Quantity` = Quantity + $finalQty WHERE Order_ID=$uOid and Product_ID=$uPid limit 1";
        $rUpdateProd=mysqli_query($db,$qUpdateProd);
        if($rUpdateProd){
            deleteLess1($db);
            $_SESSION['checkU']=true;
        }else{
            echo '<script>alert("ERROR!");</script>';
        }
    }
    if(isset($_POST['placeOrder'])){//place order
        $receName=$_POST['receName'];
        $receContact=$_POST['receContact'];
        $receAdd=$_POST['receAddress'];
        $oid=$_SESSION['orderID'];
        $did=$_POST['courier'];
        $totalPrice=totalPrice($db);
        $qPlaceOrder="INSERT INTO `tblreceiver`(`Order_ID`, `Delivery_ID`, `Receiver_Name`, `Receiver_Contact`, `Receiver_Address`) VALUES ($oid,$did,'$receName','$receContact','$receAdd')";
        if(mysqli_query($db,$qPlaceOrder)){
            $quTP="UPDATE `tblorder` SET `Date_Ordered`=now(),`Total_Price`=$totalPrice WHERE Order_ID=$oid";
            if(mysqli_query($db,$quTP)){
                $_SESSION['orderID']=null;
                $_SESSION['check']=true;
            }else{
                echo '<script>alert("Error!");</script>';
            }
        }else{
            echo '<script>alert("Error");</script>';
        }
    }

// QUERY FOR TOTAL PRICE
//SELECT SUM(tblproduct.Product_Price*tblorderdetails.Quantity) AS total FROM tblproduct,tblorderdetails WHERE tblproduct.Product_ID=tblorderdetails.Product_ID and  tblorderdetails.Order_ID='oid'

//CURDATE(),CURTIME()
    
?>
