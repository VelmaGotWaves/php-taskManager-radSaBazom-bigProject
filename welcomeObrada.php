<?php
session_start();
$location="";
 function head_there($l){
        header($l);
        exit();
    }
if ((isset($_SESSION['id']) == '') || $_SESSION['admin']==true)
{
    $location = "location: index.php";
    head_there($location);
}

require_once "sqlconnection.php";

    $error = "";



    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        if(empty(trim($_POST["nNaslov"]))){
            $error = "nNaslov";
        } elseif(!preg_match('/^[a-zA-Z0-9_ ]+$/', trim($_POST["nNaslov"]))){
            $error = "nNaslov";
        } else $nNaslov = trim($_POST["nNaslov"]);
        
        if(empty(trim($_POST["nTelo"]))){
            $error = "nTelo";
        } elseif(!preg_match('/^[a-zA-Z0-9_ ]+$/', trim($_POST["nTelo"]))){
            $error = "nTelo";
        } else $nTelo = trim($_POST["nTelo"]);

        if(empty($_POST["nDatum"])){
            $error = "nDatum1";
        } elseif(!strtotime($_POST["nDatum"])){
            $error = "nDatum2";
        } else $nDatum = $_POST["nDatum"];


        if(empty($_POST["nKategorija"])){
            $error = "nKategorija1";
        } elseif($_POST["nKategorija"] == "Marketing" || $_POST["nKategorija"] == "Design" || $_POST["nKategorija"] == "Development" || $_POST["nKategorija"] == "Management"){
            $nKategorija = trim($_POST["nKategorija"]);
        } else $error = "nKategorija2";
        

        if($_POST["nCompletedKorisnik"] == "1" || $_POST["nCompletedKorisnik"] == "0"){
            $nCompletedKorisnik =$_POST["nCompletedKorisnik"];
        } else{
            $error = "nCompletedKorisnik1"; 
        } 
        
        if(empty($error)){
            $sql = "INSERT INTO task (id, naslov, telo, datum, completed, korisnikcompleted, kategorija) VALUES (?, ?, ?, ?, 0, ?, ?)";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "ssssss", $_SESSION['id'], $nNaslov, $nTelo, $nDatum, $nCompletedKorisnik, $nKategorija);
                
                
                if(mysqli_stmt_execute($stmt)){
                    $location = "location: welcomenovi.php";
                    head_there($location);
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                    echo mysqli_error($link);
                }
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($link);
    }
?>