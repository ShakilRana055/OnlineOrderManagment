<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $userId = $_SESSION['user']['Id'];

    if(isset($_POST['Create'])){
        try 
        {
            $Name = $_POST['Name'];
            $Email = $_POST['Email'];
            $RoleName = $_POST['RoleName'];
            $Phone = $_POST['Phone'];
            $Password = md5($_POST['Password']);
            $IsActive = isset($_POST['IsActive']) && $_POST['IsActive'] == 'on' ? 1 : 0;

            $sql = "INSERT INTO `user`(`Name`, `Email`, `Password`, `Phone`, `RoleName`, `IsActive`, `CreatedBy`) 
            VALUES ('$Name', '$Email', '$Password', '$Phone' ,'$RoleName', '$IsActive', '$userId')";
            echo $sql;
            $result = mysqli_query($con , $sql);
            if($result != null){
                $_SESSION['AddUserCreate'] = 'success';
                header('Location: ../views/AddUser.php');
            }
            else{
                $_SESSION['AddUserCreate'] = 'failed';
                header('Location: ../views/AddUser.php');
            }
        } 
        catch (Throwable $th) {
            $_SESSION['AddUserCreate'] = 'failed';
            header('Location: ../views/AddUser.php');
        }
        
    }

    if(isset($_POST['Update'])){
        try 
        {
            $Id = $_POST['Id'];
            $Name = $_POST['Name'];
            $Code = $_POST['Code'];
            $IsActive = $_POST['IsActive'] == 'on' ? 1 : 0;
            $sql = "UPDATE `category` SET `Name`='$Name',`Code`='$Code',`IsActive`='$IsActive',`UpdatedDate`='$currentDate', UpdatedBy = '$userId' WHERE Id = '$Id'";
            $result = mysqli_query($con , $sql);
            if($result != null){
                $_SESSION['CategoryCreate'] = 'update';
                header('Location: ../views/Category.php');
            }
            else{
                $_SESSION['CategoryCreate'] = 'failed';
                header('Location: ../views/Category.php');
            }
            
        } 
        catch (Throwable $th) {
            $_SESSION['CategoryCreate'] = 'failed';
            header('Location: ../views/Category.php');
        }
    }
?>