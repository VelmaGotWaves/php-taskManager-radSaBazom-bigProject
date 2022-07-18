<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcomenovi.php");
    exit;
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
    } else{
        $username = trim($_POST["nEmail"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["nPass"]))){
        $password_err = "Please enter your password.";
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
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcomenovi.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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