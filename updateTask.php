<?php
session_start();
$location="";
 function head_there($l){
        header($l);
        exit();
    }

if ((isset($_SESSION['admin'])==false) || $_SESSION['admin']==false)
{
    
    $location= 'Location: index.php';
    head_there($location);
}
require_once "sqlconnection.php";

    $error="";
    if(isset($_POST["msg1"])){
        $check1="1";
    }else {
        $check1="0";
    }
    if(isset($_POST["msg2"])){
        $check2="1";
    }else {
        $check2="0";
    }
    

    $intID = (int)trim($_POST["nId"]);



    

    if($_SERVER["REQUEST_METHOD"] == "POST"){


        if((isset($check1) && isset($check1)) == false){
            $error ="check error";
        } 

        if(empty(trim($_POST["nComment"]))){
            $komentar = "";
        } elseif(!preg_match('/^[a-zA-Z0-9_ ]+$/', trim($_POST["nComment"]))){
            $error = "Name can only contain letters, numbers, and underscores.";
        } else $komentar = trim($_POST["nComment"]);


        if(empty(trim($_POST["nId"]))){
            $error=  "Please enter ID.";
        }
        elseif(is_int($intID)==false || $intID==0){
            $error= "ID NOT INT";
        }
        else if(empty($error)){
            
            $sql = "UPDATE task SET Completed= ? , KorisnikCompleted= ? , Komentar= ? where TaskID = ?;";
            
            if($stmt = mysqli_prepare($link, $sql)){
                


                mysqli_stmt_bind_param($stmt, "sssi", $check1,$check2,$komentar,$intID);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $location= 'Location: welcomeAdmin.php';
                    head_there($location);
                } else{
                    $location= 'Location: welcomeAdmin.php';
                    head_there($location);
                    
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($link);
    }
$location= 'Location: welcomeAdmin.php';
head_there($location);