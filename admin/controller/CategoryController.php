<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $userId = $_SESSION['user']['Id'];

    if(isset($_POST['Create'])){
        try 
        {
            $Name = $_POST['Name'];
            $Code = $_POST['Code'];
            $IsActive = $_POST['IsActive'] == 'on' ? 1 : 0;
            $sql = "INSERT INTO `category`(`Name`, `Code`, `IsActive`, `CreatedBy`) 
            VALUES ('$Name', '$Code', '$IsActive', '$userId' )";
            
            $result = mysqli_query($con , $sql);
            if($result != null){
                $_SESSION['CategoryCreate'] = 'success';
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