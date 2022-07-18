<?php
session_start();
if ((isset($_SESSION['admin'])==false) || $_SESSION['admin']==false)
{
    header("Location: index.php");
}
require_once "sqlconnection.php";
    $intID = (int) trim($_POST["nId"]);
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["nId"]))){
            echo  "Please enter ID.";
        }
        elseif(is_int($intID)==false || $intID==0){
            echo "ID NOT INT";
        }
        else{
            
            $sql = "DELETE FROM task where TaskID = ?;";
            
            if($stmt = mysqli_prepare($link, $sql)){
                


                mysqli_stmt_bind_param($stmt, "s", $_POST["nId"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    
                    header("Location: welcomeAdmin.php");
                } else{
                    
                    
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($link);
    }
header("Location: welcomeAdmin.php");
?>