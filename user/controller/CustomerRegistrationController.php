<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $msg = "";

    if(isset($_POST['Register'])){  

        try 
        {
            $Name = $_POST['Name'];
            $Email = $_POST['Email'];
            $Phone = $_POST['Phone'];
            $Address = $_POST['Address'];
            $Password = md5($_POST['Password']);
            $RoleName = "Customer";

            $sql = "INSERT INTO `user`(`Name`, `Email`, `Password`, `Phone`,`RoleName`, `Address`, `IsActive`) 
            VALUES ('$Name', '$Email', '$Password', '$Phone' ,'$RoleName', '$Address' ,'1')";
            echo $sql;
            $result = mysqli_query($con , $sql);
            if($result != null){
                $_SESSION['UserResgister'] = 'success';
                header('Location: ../views/CustomerRegistration.php');
            }
            else{
                $_SESSION['UserResgister'] = 'failed';
                header('Location: ../views/CustomerRegistration.php');
            }
        } 
        catch (Throwable $th) {
            $_SESSION['UserResgister'] = 'failed';
           header('Location: ../views/CustomerRegistration.php');
        }
    }

?>