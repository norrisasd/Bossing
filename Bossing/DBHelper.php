<?php
     $host="localhost";
     $user="root";
     $pass="";
     $data="fooddeliverysystem";
    // HOSTING
    // $user="Xn15Dg4HjH";
    // $host="remotemysql.com";
    // $pass="0lBbv6IvK4";
    // $data="Xn15Dg4HjH";
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
            $data=mysqli_fetch_assoc($result);
            if($data['Is_Admin']){
                header("Location: admin/dashboard.php");
            }else{
                $_SESSION['login']=true;
                $_SESSION['username']=$user;
                header("Location: ./index.php");
            }
            
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
    function displayProducts($db){//display product for orders
        $query="SELECT * FROM `tblproduct`";
        $result=mysqli_query($db,$query);
        $ctr=0;
        $ctr1=0;
        if(mysqli_num_rows($result)>=1){
            while($data=mysqli_fetch_assoc($result)){
                if($ctr%2 == 0){
                    echo'<div class="d-flex justify-content-center">';
                }
                echo'<div class="rowItem">
                <span><b>'.$data['Product_Name'].'</b></span>
                <img src ="../PHP PIC/'.$data['Product_Name'].'.png" class="rounded mx-auto d-block" alt="'.$data['Product_Name'].'">
                <span>&#8369;'.$data['Product_Price'].'</span>
                <br>
                <span style="font-size:21px">Quantity:&nbsp<input type="number" min="0" max="100" id="'.$data['Product_Name'].'" value="0"/></span>
                <br>
                <button type="button" class="btn btn-dark" onclick="setProdQuant('.$data['Product_ID'].',\''.$data['Product_Name'].'\')">Add To Bag</button>
            </div>';
            $ctr++;
            $ctr1++;
                if($ctr1 == 2){
                    echo'</div>';
                    $ctr1=0;
                }
            }
        }else{
            echo '';
        }

    }
    function displayProductSlider($db){
        $query="SELECT * FROM `tblproduct`";
        $result=mysqli_query($db,$query);
        if(mysqli_num_rows($result)>=1){
            while($data=mysqli_fetch_assoc($result)){
                echo'<div class="item">
                        <div class="product_blog_img">
                            <img src="PHP PIC/'.$data['Product_Name'].'.png" alt="'.$data['Product_Name'].'" />
                        </div>
                        <div class="product_blog_cont">
                            <h3>'.$data['Product_Name'].'</h3>
                            <h4>&#8369;'.$data['Product_Price'].'</h4>
                        </div>
                    </div>';
            }
        }else{
            echo '';
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
                            <i class="fa fa-pencil-square-o" data-toggle="modal" data-target="#editModal" onclick="updateProd('.$row['Product_ID'].','.$row['TotalQty'].',\''.$row['Product_Name'].'\')"aria-hidden="true"></i>
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
                        <th scope="row">'.$data['Order_ID'].'</th>
                        <td>'.$data['Date_Ordered'].'</td>
                        <td>'.$data['Total_Price'].'</td>
                        <td><button type="button" class="btn btn-info" style="height:25px;padding:0 10px;margin-left:0.5rem" data-toggle="modal" data-target="#orderModal" onclick="products(\''.displayOrderProducts($db,$data['Order_ID']).'\')">Details</button></td>
                        </tr>
                     <tr>';
            }
        }
    }
    //----------------------------------
    function displayOrderProducts($db,$order_id){
        $string="";
        $query="SELECT DISTINCT `tblproduct`.`Product_Name`,`tblproduct`.`Product_Price`,SUM(`tblorderdetails`.`Quantity`) AS TotalQty,`tblproduct`. `Product_Price`*SUM(`tblorderdetails`.`Quantity`) AS Initial FROM `tblorderdetails`,`tblproduct` WHERE `tblorderdetails`.`Product_ID` = `tblproduct`.`Product_ID` and `tblorderdetails`.`Order_ID` = $order_id GROUP BY `tblproduct`.`Product_Name`,`tblproduct`.`Product_Price`";
        $result=mysqli_query($db,$query);
        $rowCheck=mysqli_num_rows($result);
        if ($rowCheck>=1) {
            while ($row=mysqli_fetch_assoc($result)) {
                $name=$row['Product_Name'];
                $qty=$row['TotalQty'];
                $initial=$row['Initial'];
                $string.="<h5>$name&nbsp&nbsp&nbsp - &nbsp&nbsp&nbsp  $qty (&#8369;$initial)</h5>";
            }
        }
        return $string;
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
//update Profile
    if(isset($_POST['updateProfile'])){
        $user=$_SESSION['username'];
        $uname=$_POST['uname'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $contact=$_POST['contact'];
        $qUP="UPDATE `tbluser` SET  tbluser.`Username`='$uname',tbluser.`First_Name`='$fname',tbluser.`Last_Name`='$lname',`Phone_Number`='$contact' WHERE tbluser.`Username`='$user'";
        // $qUP="UPDATE `tbluser`,`tblorder` SET tblorder.Username='$uname', tbluser.`Username`='$uname',tbluser.`First_Name`='$fname',tbluser.`Last_Name`='$lname',`Phone_Number`='$contact' WHERE tbluser.`Username`=tblorder.Username='$user'";
        $rUP=mysqli_query($db,$qUP);
        if($rUP){
            echo '<script>alert("Update Succes!");</script>';
            $_SESSION['username']=$uname;
        }else{
            echo '<script>alert("'.mysqli_error($db).'");</script>';
            echo '<script>alert("'.$user.'");</script>';
        }
    }










//-------------------------------------------------------------------------------------- ADMIN ------------------------------------------------------------
    function displayPending($db){
        $query="SELECT * FROM `tblreceiver` WHERE Date_Received = Time_Received IS NULL";
        $result=mysqli_query($db,$query);
        while($data=mysqli_fetch_assoc($result)){
            echo'<tr>
                    <td>'.$data['Order_ID'].'</td>
                    <td>'.$data['Delivery_ID'].'</td>
                    <td>'.$data['Receiver_Name'].'</td>
                    <td>'.$data['Receiver_Contact'].'</td>
                    <td>'.$data['Receiver_Address'].'</td>
                    <td><button type="button" class="btn btn-primary" style="height:25px;padding:0 10px" onclick="confirmDeli('.$data['Order_ID'].')">Confirm</button><button type="button" class="btn btn-info" style="height:25px;padding:0 10px;margin-left:0.5rem" data-toggle="modal" data-target="#details" onclick="details(\''.displayOrderProducts($db,$data['Order_ID']).'\')">Details</button></td>
                </tr>';
        }
    }
    function displayDelivered($db){
        $query="SELECT * FROM `tblreceiver` WHERE Date_Received IS NOT NULL AND Time_Received IS NOT NULL";
        $result=mysqli_query($db,$query) or die(mysqli_error($db));
        while($data=mysqli_fetch_assoc($result)){
            echo'<tr>
                    <td>'.$data['Order_ID'].'</td>
                    <td>'.$data['Delivery_ID'].'</td>
                    <td>'.$data['Receiver_Name'].'</td>
                    <td>'.$data['Receiver_Contact'].'</td>
                    <td>'.$data['Receiver_Address'].'</td>
                    <td>'.$data['Date_Received'].'</td>
                    <td>'.$data['Time_Received'].'</td>
                    <td><button type="button" class="btn btn-info" style="height:25px;padding:0 10px;margin-left:0.5rem" data-toggle="modal" data-target="#details" onclick="details(\''.displayOrderProducts($db,$data['Order_ID']).'\')">Details</button></td>
                </tr>';
        }
        
    }
    function displayAllOrders($db){
        $query="SELECT * FROM `tblorder` WHERE Total_Price IS NOT NULL";
        $result=mysqli_query($db,$query);
        while($data=mysqli_fetch_assoc($result)){
            echo '<tr>
                    <th scope="row">'.$data['Order_ID'].'</th>
                    <td>'.$data['Date_Ordered'].'</td>
                    <td>'.$data['Total_Price'].'</td>
                    <td>'.$data['Username'].'</td>
                    <td><button type="button" class="btn btn-info" style="height:25px;padding:0 10px" data-toggle="modal" data-target="#details" onclick="details(\''.displayOrderProducts($db,$data['Order_ID']).'\')">Details</button>
                              </td>
                  </tr>';
        }
    }
    function getOrderCount($db,$user){
        $query="SELECT COUNT(*) as ctr FROM tblorder WHERE Username='$user' and Total_Price is not NULL";
        $result=mysqli_query($db,$query);
        $data=mysqli_fetch_assoc($result);
        return $data['ctr'];
    }
    function displayAllUsers($db){
        $query="SELECT * FROM `tbluser`";
        $result=mysqli_query($db,$query);
        while($data=mysqli_fetch_assoc($result)){
            echo '<tr>
                    <th scope="row">'.$data['Username'].'</th>
                    <td>'.$data['Password'].'</td>
                    <td>'.$data['First_Name'].'</td>
                    <td>'.$data['Last_Name'].'</td>
                    <td>'.$data['Phone_Number'].'</td>
                    <td>'.getOrderCount($db,$data['Username']).'</td>
                    <td>'.$data['Is_Admin'].'</td>';
                    if(!$data['Is_Admin']){
                        echo '<td><button type="button" class="btn btn-success" style="height:25px;padding:0 10px" onclick="makeAdmin(\''.$data['Username'].'\')">Make Admin</button>
                              </td>';
                    }else{
                        echo'<td></td>';
                    }
                    
              echo '</tr>';
        }
    }

    function displayAllProducts($db){
        $query="SELECT * FROM `tblproduct`";
        $result=mysqli_query($db,$query);
        while($data=mysqli_fetch_assoc($result)){
            echo'<tr>
                    <th scope="row">'.$data['Product_ID'].'</th>
                    <td>'.$data['Product_Name'].'</td>
                    <td>&#8369;'.$data['Product_Price'].'</td>
                    <td>
                        <i class="fa fa-minus" aria-hidden="true" onclick="deleteProd('.$data['Product_ID'].')" ></i> &nbsp &nbsp &nbsp
                        <i class="fa fa-pencil-square-o" data-toggle="modal" data-target="#editProductModal" onclick="updateProd('.$data['Product_ID'].',\''.$data['Product_Name'].'\','.$data['Product_Price'].')" aria-hidden="true"></i>
                    </td>
                </tr>';
        }
    }
    function displayAllCarrier($db){
        $query="SELECT * FROM `tbldelivery`";
        $result=mysqli_query($db,$query);
        while($data=mysqli_fetch_assoc($result)){
            echo'<tr>
                    <th scope="row">'.$data['Delivery_ID'].'</th>
                    <td>'.$data['Delivery_Carrier'].'</td>
                    <td>
                        <i class="fa fa-minus" aria-hidden="true" onclick="deleteCarr('.$data['Delivery_ID'].')"></i> &nbsp &nbsp &nbsp
                        <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" data-target="#editCarrier" onclick="updateCarr('.$data['Delivery_ID'].',\''.$data['Delivery_Carrier'].'\')"></i>
                    </td>
                </tr>';
        }
    }
    function countUsers($db){
        $query="SELECT COUNT(*) as ctr FROM `tbluser`";
        $result=mysqli_query($db,$query);
        $data=mysqli_fetch_assoc($result);
        return $data['ctr'];
    }
    function countProducts($db){
        $query="SELECT COUNT(*) as ctr FROM `tblproduct`";
        $result=mysqli_query($db,$query);
        $data=mysqli_fetch_assoc($result);
        return $data['ctr'];
    }
    function countOrders($db){
        $query="SELECT COUNT(*) as ctr FROM `tblorder` WHERE Total_Price is not NULL";
        $result=mysqli_query($db,$query);
        $data=mysqli_fetch_assoc($result);
        return $data['ctr'];
    }
    function countDelivery($db){
        $query="SELECT COUNT(*) as ctr FROM `tblreceiver` WHERE Date_Received is not NULL AND Time_Received IS NOT NULL";
        $result=mysqli_query($db,$query);
        $data=mysqli_fetch_assoc($result);
        return $data['ctr'];
    }
    if(isset($_POST['addProduct'])){
        $name=$_POST['pName'];
        $price=$_POST['pPrice'];
        $query="INSERT INTO `tblproduct`(`Product_Name`, `Product_Price`) VALUES ('$name','$price')";
        if(mysqli_query($db,$query)){
            $_SESSION['check']=true;
        }else{
            echo '<script>alert("'.mysqli_error($db).'");</script>';
        }
    }
    if(isset($_POST['delProd'])){
        $dpID=$_POST['delProd'];
        $query="DELETE FROM `tblproduct` WHERE Product_ID = $dpID";
        if(mysqli_query($db,$query)){
            $_SESSION['checkD']=true;
        }else{
            echo '<script>alert("'.mysqli_error($db).'");</script>';
        }
    }
    if(isset($_POST['updateProduct'])){
        $upID=$_POST['updateProduct'];
        $name=$_POST['pName'];
        $price=$_POST['pPrice'];
        $query="UPDATE `tblproduct` SET `Product_Name`='$name',`Product_Price`='$price' WHERE Product_ID=$upID";
        if(mysqli_query($db,$query)){
            $_SESSION['checkU']=true;
        }else{
            echo '<script>alert("'.mysqli_error($db).'");</script>';
        }
    }
    if(isset($_POST['admin'])){
        $user=$_POST['admin'];
        $query="UPDATE tbluser SET Is_Admin=1 WHERE Username='$user'";
        if(mysqli_query($db,$query)){
            $_SESSION['checkU']=true;
        }else{
            echo '<script>alert("'.mysqli_error($db).'");</script>';
        }
    }
    if(isset($_POST['confirmDeli'])){
        $id=$_POST['confirmDeli'];
        $query="UPDATE `tblreceiver` SET `Date_Received`=CURDATE(),`Time_Received`=CURTIME() WHERE `Order_ID`=$id";
        $result=mysqli_query($db,$query);
        if($result){
            $_SESSION['check']=true;
        }
    }
    if(isset($_POST['addCarrier'])){
        $cname=$_POST['cName'];
        $query="INSERT INTO `tbldelivery`(`Delivery_Carrier`) VALUES ('$cname')";
        if(mysqli_query($db,$query)){
            $_SESSION['check']=true;
        }else{
            echo '<script>alert("'.mysqli_error($db).'");</script>';
        }
    }
    if(isset($_POST['editCarrier'])){
        $did=$_POST['editCarrier'];
        $name=$_POST['cName'];
        $query="UPDATE tbldelivery SET Delivery_Carrier='$name' WHERE Delivery_ID = $did";
        if(mysqli_query($db,$query)){
            $_SESSION['checkU']=true;
        }else{
            echo '<script>alert("'.mysqli_error($db).'");</script>';
        }
    }
    if(isset($_POST['delCarr'])){
        $did=$_POST['delCarr'];
        $query="DELETE FROM tbldelivery WHERE Delivery_ID =$did";
        if(mysqli_query($db,$query)){
            $_SESSION['checkD']=true;
        }else{
            echo '<script>alert("'.mysqli_error($db).'");</script>';
        }
    }

    
?>
