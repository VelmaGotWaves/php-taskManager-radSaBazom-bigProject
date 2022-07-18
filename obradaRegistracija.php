<?php
    require_once "sqlconnection.php";

    $username = $password = $confirm_password = $name = "";
$username_err = $password_err = $confirm_password_err = $name_error = "";
 

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    // if(empty(trim($_POST["nEmail"]))){
    //     $username_err = "Please enter an email.";
    // } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["nEmail"]))){
    //     $username_err = "Username can only contain letters, numbers, and underscores.";
    // }
    if(empty(trim($_POST["nEmail"]))){
        $username_err = "Please enter username.";
    }
     elseif(strpos(trim($_POST["nEmail"]), "@gmail.com")===false){//koa samo ljudi sa emailom od kompanije mogu da se prijave, u ovom slucaju to je gmail.com ali promeni kasnije ovo nije dobro, mora poslednji deo stringa da bude cekirana
        $username_err = "Username can only contain letters, numbers, and underscores.";
    }
    else{
        
        $sql = "SELECT id FROM korisnik WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            


            mysqli_stmt_bind_param($stmt, "s", $_POST["nEmail"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["nEmail"]);
                    
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["nPass"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["nPass"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["nPass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["nPass2"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["nPass2"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty(trim($_POST["nIme"]))){
        $name_error = "Please enter an email.";
    } elseif(!preg_match('/^[a-zA-Z0-9_ ]+$/', trim($_POST["nIme"]))){
        $name_error = "Name can only contain letters, numbers, and underscores.";
    } else $name = trim($_POST["nIme"]);
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO korisnik (email, password, ime) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
            $param_username = $username;
            $param_name = $name;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $username, $param_password, $param_name);
            
            
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                
                header("location: index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Close connection
    mysqli_close($link);
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
    
</head>
<body>
    <div class="main">
        <div class="forme">
            <div class="forma forma-active" data-vrednost="korisnik">
                <a href="index.php"><- Nazad</a>
                <form method="post">
                    <p class="naslov">Registracija Za Korisnika</p>
                    <div>
                        <input class="text-input" type="email" name="nEmail" placeholder="Email">
                        <input class="text-input" type="password" name="nPass" placeholder="Password">
                        <input class="text-input" type="password" name="nPass2" placeholder="Confirm Password">
                        <input class="text-input" type="text" name="nIme" placeholder="Ime i Prezime" >
                    </div>
                    <div class="submit-forgot-div">
                        <input type="submit" value="Registruj se" class="prijavi-se">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
    
</body>
</html>