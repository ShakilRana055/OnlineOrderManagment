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
            //echo $sql;
            $result = mysqli_query($con , $sql);
            $_SESSION['CategoryCreate'] = 'success';
            header('Location: ../views/Category.php');
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
            $sql = "UPDATE `category` SET `Name`='$Name',`Code`='$Code',`IsActive`='$IsActive',`UpdatedDate`='$currentDate' WHERE Id = '$Id'";
            echo $sql;
            $result = mysqli_query($con , $sql);
            $_SESSION['CategoryCreate'] = 'update';
            header('Location: ../views/Category.php');
        } 
        catch (Throwable $th) {
            $_SESSION['CategoryCreate'] = 'failed';
            header('Location: ../views/Category.php');
        }
    }

    if(isset($_GET['search'])){
        try 
        {
            $id = $_GET['search'];
            $sql = "DELETE FROM `users` WHERE `Id` = '$id'";
            $result = mysqli_query($con, $sql);
            if($result != null){
                echo json_encode(true);
            }
            else{
                echo json_encode(false);
            }
        } 
        catch (Throwable $th) {
            echo json_encode(false);
        }
    }
?>