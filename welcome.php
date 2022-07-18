<?php
session_start();
if ((isset($_SESSION['id']) == '') || $_SESSION['admin']==true)
{
    header("Location: logout.php");
}
require_once "sqlconnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="logout.php">logout</a>
    <fieldset>
        <legend>Unesi Task</legend>


            <form action="welcomeObrada.php" method="post">
                <p>Unesi naslov</p>
                <input type="text" name="nNaslov" id="" placeholder="Naslov">
                <p>Unesi telo</p>
                <textarea name="nTelo" id="" cols="30" rows="10" placeholder="Telo"></textarea>
                <p>Unesi datum</p>

                <input type="date" name="nDatum" id="" value="2022-07-14">
                
                <p>Kojoj kategoriji pripada tvoj projekat</p>
                
                <input type="radio" name="nKategorija" value="Marketing"id="" checked>Marketing
                <input type="radio" name="nKategorija" value="Design"id="">Design
                <input type="radio" name="nKategorija" value="Development"id="">Development
                <input type="radio" name="nKategorija" value="Management"id="">Management
                <p>Da li si zavrsio task</p>
                <input type="radio" name="nCompletedKorisnik" value="0"id="" checked>Da
                <input type="radio" name="nCompletedKorisnik" value="1"id="">Ne
                <br>
                <br>
                <br>
            <button type="submit">SUBMIT</button>
            
            </form>
    </fieldset>
</body>
</html>