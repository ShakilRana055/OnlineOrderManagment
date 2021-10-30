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
            $Password = md5('123');
            $IsActive = isset($_POST['IsActive']) && $_POST['IsActive'] == 'on' ? 1 : 0;

            $sql = "INSERT INTO `user`(`Name`, `Email`, `Password`, `Phone`, `RoleName`, `IsActive`, `CreatedBy`) 
            VALUES ('$Name', '$Email', '$Password', '$Phone' ,'$RoleName', '$IsActive', '$userId')";
            $result = mysqli_query($con , $sql);
            if($result != null){
                $_SESSION['AllUserCreate'] = 'success';
                header('Location: ../views/AllUser.php');
            }
            else{
                $_SESSION['AllUserCreate'] = 'failed';
                header('Location: ../views/AllUser.php');
            }
        } 
        catch (Throwable $th) {
            $_SESSION['AddUserCreate'] = 'failed';
            header('Location: ../views/AllUser.php');
        }
        
    }

    if(isset($_POST['Update'])){
        try 
        {
            $Id = $_POST['Id'];
            $Name = $_POST['Name'];
            $Email = $_POST['Email'];
            $RoleName = $_POST['RoleName'];
            $Phone = $_POST['Phone'];
            $IsActive = isset($_POST['IsActive']) && $_POST['IsActive'] == 'on' ? 1 : 0;

            $sql = "UPDATE `user` SET `Name`='$Name',`Phone`= '$Phone',`IsActive`='$IsActive',`UpdatedBy`= '$userId',`UpdatedDate`= '$currentDate' WHERE Id = '$Id'";
            $result = mysqli_query($con , $sql);
            if($result != null){
                $_SESSION['AllUserCreate'] = 'update';
                header('Location: ../views/AllUser.php');
            }
            else{
                $_SESSION['AllUserCreate'] = 'failed';
                header('Location: ../views/AllUser.php');
            }
            
        } 
        catch (Throwable $th) {
            $_SESSION['AllUserCreate'] = 'failed';
            header('Location: ../views/AllUser.php');
        }
    }

    if(isset($_POST['UpdateProfile'])){
        try 
        {
            $Id = $_POST['Id'];
            $Name = $_POST['Name'];
            $Phone = $_POST['Phone'];

            $sql = "UPDATE `user` SET `Name`='$Name',`Phone`= '$Phone',`UpdatedBy`= '$userId',`UpdatedDate`= '$currentDate' WHERE Id = '$Id'";
            $result = mysqli_query($con , $sql);
            if($result != null){
                $_SESSION['UpdateProfile'] = 'update';
                header('Location: ../views/UpdateProfile.php');
            }
            else{
                $_SESSION['UpdateProfile'] = 'failed';
                header('Location: ../views/UpdateProfile.php');
            }
            
        } 
        catch (Throwable $th) {
            $_SESSION['UpdateProfile'] = 'failed';
            header('Location: ../views/UpdateProfile.php');
        }
    }

    if(isset($_POST['ChangePassword'])){
        try 
        {
            $Password = md5($_POST['Password']);
            $sql = "UPDATE `user` SET `Password` = '$Password', `UpdatedBy`= '$userId',`UpdatedDate`= '$currentDate' WHERE Id = '$userId'";
            echo $sql;
            $result = mysqli_query($con , $sql);
            if($result != null){
                $_SESSION['PasswordChange'] = 'success';
                header('Location: ../index.php');
            }
            else{
                $_SESSION['PasswordChange'] = 'failed';
                header('Location: ../views/ChangePassword.php');
            }
            
        } 
        catch (Throwable $th) {
            $_SESSION['PasswordChange'] = 'failed';
            header('Location: ../views/ChangePassword.php');
        }
    }
?>