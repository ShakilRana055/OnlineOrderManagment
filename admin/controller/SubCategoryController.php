<?php
    session_start();
    include("../../connection/DatabaseConnection.php");

    $userId = $_SESSION['user']['Id'];

    if(isset($_POST['Create'])){
        try 
        {
            $Name = $_POST['Name'];
            $Code = $_POST['Code'];
            $IsActive = $_POST['IsActive'] == 'on' ? 1 : 0;
            $sql = "INSERT INTO `subcategory`(`Name`, `Code`, `IsActive`, `CreatedBy`) 
            VALUES ('$Name', '$Code', '$IsActive', '$userId' )";
            
            $result = mysqli_query($con , $sql);
            if($result != null){
                $_SESSION['SubCategoryCreate'] = 'success';
                header('Location: ../views/SubCategory.php');
            }
            else{
                $_SESSION['SubCategoryCreate'] = 'failed';
                header('Location: ../views/SubCategory.php');
            }
        } 
        catch (Throwable $th) {
            $_SESSION['SubCategoryCreate'] = 'failed';
            header('Location: ../views/SubCategory.php');
        }
        
    }

    if(isset($_POST['Update'])){
        try 
        {
            $Id = $_POST['Id'];
            $Name = $_POST['Name'];
            $Code = $_POST['Code'];
            $IsActive = $_POST['IsActive'] == 'on' ? 1 : 0;
            $sql = "UPDATE `subcategory` SET `Name`='$Name',`Code`='$Code',`IsActive`='$IsActive',`UpdatedDate`='$currentDate', UpdatedBy = '$userId' WHERE Id = '$Id'";
            $result = mysqli_query($con , $sql);
            if($result != null){
                $_SESSION['SubCategoryCreate'] = 'update';
                header('Location: ../views/SubCategory.php');
            }
            else{
                $_SESSION['SubCategoryCreate'] = 'failed';
                header('Location: ../views/SubCategory.php');
            }
            
        } 
        catch (Throwable $th) {
            $_SESSION['SubCategoryCreate'] = 'failed';
            header('Location: ../views/SubCategory.php');
        }
    }
?>