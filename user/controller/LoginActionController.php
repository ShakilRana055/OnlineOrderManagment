<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $msg = "";

    if(isset($_POST['submit'])){  

        $user = trim($_POST['Email']);
        $pass = trim($_POST['Password']);
        $md5Password = md5($pass);

        $sql = "SELECT * FROM `user` WHERE `Email` = '$user' AND `Password` = '$md5Password' AND `RoleName` = 'Customer' AND IsActive = '1'";

        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);

        if(!empty($data)){
            $_SESSION['customer'] = $data;
            $date= date('Y-m-d H:i:s');
            $_SESSION['login_time'] = $date;
            header('Location: ../views/index.php');
            exit;
        }else{
            $_SESSION['loginErrorMsg']="Your Email or Password is not valid!";
        }
    }

    if(isset($_GET['logout'])){
        session_destroy();
        header('Location: ../views/index.php');
        exit;
    }
   
?>