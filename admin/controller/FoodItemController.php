<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $userId = $_SESSION['user']['Id'];

    if(isset($_POST['Create'])){
        try 
        {
            $Name = $_POST['Name'];
            $Price = $_POST['Price'];
            $Discount = $_POST['Discount'];
            $CategoryId = $_POST['CategoryId'];
            $SubCategoryId = $_POST['SubCategoryId'];
            $Description = $_POST['Description'];
            $IsActive = $_POST['IsActive'] == 'on' ? 1 : 0;
            $IsAvailable = $_POST['IsAvailable'] == 'on' ? 1 : 0;

            

            $DisplayPicture = $_FILES['DisplayPicture']['name'];
            $displayPictureUrl = '';
           

            if($DisplayPicture != null){
                $photoName = explode(".", basename($DisplayPicture));
                $displayPictureUrl = "public/image/".time()."items.".$photoName[1];
            }

            $sql = "INSERT INTO `fooditem`( `Name`, `Price`, `Discount`, `IsAvailable`, `IsActive`, `CategoryId`, `SubCategoryId`, `DisplayPicture`, `Description`, `CreatedBy`)
                    VALUES ('$Name', '$Price', '$Discount', '$IsAvailable', '$IsActive', '$CategoryId', '$SubCategoryId', '$displayPictureUrl', '$Description', '$userId')";

            $result = mysqli_query($con , $sql);
            if($result != null){
                if($DisplayPicture != null){
                    move_uploaded_file( $_FILES['DisplayPicture']['tmp_name'] , '../../'.$displayPictureUrl);
                    
                    $lastId = mysqli_insert_id($con);
                    $total = count($_FILES['OtherPicture']['name']);
                    if($total > 0){
                        for($i = 0; $i < $total; $i++){

                            $date   = new DateTime(); //this returns the current date time
                            $result = $date->format('Y-m-d-H-i-s');
                            echo $result . "<br>";
                            $krr    = explode('-', $result);
                            $timeResult = implode("", $krr);

                            $tmpFilePath = $_FILES['OtherPicture']['name'][$i];
                            $photoName = explode(".", basename($tmpFilePath));
                            $pictureUrl = "public/image/".$timeResult."items.".$photoName[1];
                            $sql = "INSERT INTO `images`(`FoodItemId`, `PhotoUrl`, `CreatedBy`) 
                                    VALUES ('$lastId', '$pictureUrl', '$userId')";
                            mysqli_query($con, $sql);
                            move_uploaded_file( $_FILES['OtherPicture']['tmp_name'][$i] , '../../'.$pictureUrl);
                            sleep(1);
                        }
                    }
                }
                $_SESSION['FoodItemCreate'] = 'success';
                header('Location: ../views/FoodItem.php');
            }
            else{
                $_SESSION['FoodItemCreate'] = 'failed';
                header('Location: ../views/FoodItem.php');
            }
        } 
        catch (Throwable $th) {
            $_SESSION['FoodItemCreate'] = 'failed';
            header('Location: ../views/FoodItem.php');
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
                $_SESSION['FoodItemCreate'] = 'update';
                header('Location: ../views/FoodItem.php');
            }
            else{
                $_SESSION['FoodItemCreate'] = 'failed';
                header('Location: ../views/FoodItem.php');
            }
            
        } 
        catch (Throwable $th) {
            $_SESSION['FoodItemCreate'] = 'failed';
            header('Location: ../views/Category.php');
        }
    }
?>