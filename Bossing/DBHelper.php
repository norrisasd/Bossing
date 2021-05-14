<?php
//     $host="localhost";
//     $user="root";
//     $pass="";
//     $data="fooddeliverysystem";
    // HOSTING
    $host="Xn15Dg4HjH";
    $user="remotemysql.com";
    $pass="0lBbv6IvK4";
    $data="Xn15Dg4HjH";
    $db = mysqli_connect($host,$user,$pass,$data);
        //local
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    session_start();
        // LOGIN
        $_SESSION['check']=false;
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

    
?>
