<?php
// Initialize the session
session_start();
 $location="";
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    
    $location= "location: welcomenovi.php";
}
 
// Include config file
require_once "sqlconnection.php";


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["nEmail"]))){
        $username_err = "Please enter username.";
        $location = "location:index.php?error=".$username_err;
    } else{
        $username = trim($_POST["nEmail"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["nPass"]))){
        $password_err = "Please enter your password.";
        $location = "location:index.php?error=".$password_err;
    } else{
        $password = trim($_POST["nPass"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM korisnik WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            
            // Bind variables to the prepared statement as parameters
            
            mysqli_stmt_bind_param($stmt, "s", $username);
            
            // Set parameters
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){    
                                 
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    if(mysqli_stmt_fetch($stmt)){
                           
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session

                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            $_SESSION["admin"]=false;  
                            // Redirect user to welcome page
                            $location = "location:welcomenovi.php";
                            
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                            $location = "location:index.php?error=".$login_err;
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    
                    $login_err = "Invalid username or password.";
                    $location = "location:index.php?error=".$login_err;
                }
            } else{
                $location = "location:index.php?error=Database_error";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }  else {$location = "location:index.php?error=Database_error"; }     
    }
    // Close connection
    mysqli_close($link);
    header($location);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">
    <script src="index.js" defer></script>
</head>
<body>
    korisnik : ognjen@gmail.com / peraP123 | admin : admin@gmail.com / peraP123
    <div class="main">
        <div class="tabDugmad">
            <button class="tabDugme dugme-active" data-vrednost="korisnik">
                Korisnik
            </button>
            <button class="tabDugme" data-vrednost="administrator">
                Administrator
            </button>
        </div>
        <div class="forme">
            
            <div class="forma forma-active" data-vrednost="korisnik">
                <form method="post">
                <p class="naslov">Login Za Korisnika</p>
                    <div>
                        
                        <input class="text-input" type="email" name="nEmail" placeholder="Email">
                        <?php if(!empty($username_err)) echo "<p class='error'>".$username_err."</p>" ;  //ovo ne radi :( zato sto se refresuje strana , tako da se izgubi informacija username_err?>
                        <input class="text-input" type="password" name="nPass" placeholder="Password">
                        <?php if(!empty($password_err)) echo "<p class='error'>".$password_err."</p>" ; ?>
                    </div>
                    <div class="submit-forgot-div">
                        <a href="#">Zaboravljena Sifra</a>
                        <a href="obradaRegistracija.php">Registruj se</a>
                        <input type="submit" value="Prijavi Se" class="prijavi-se">
                    </div>
                    
                </form>
                <?php if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["errorKorisnik"])){ echo $_GET["errorKorisnik"];} ?>
            </div>
            <div class="forma" data-vrednost="administrator">
                <form action="obradaAdmin.php" method="post">
                    <p class="naslov">Login Za Administratora</p>
                    <div>
                        <input class="text-input" type="email" name="nEmail" placeholder="Email">
                        <input class="text-input" type="password" name="nPass" placeholder="Password">
                    </div>
                    <div class="submit-forgot-div">
                        <a href="#">Zaboravljena Sifra</a>
                        <input type="submit" value="Prijavi Se" class="prijavi-se">
                    </div>
                    
                </form>
                <?php if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["errorAdmin"])){ echo $_GET["errorAdmin"];} ?>
            </div>
            
        </div>
    </div>
    
    
</body>
</html>