<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id16379596_root');
define('DB_PASSWORD', '+^F-24|)n@^N|Cih');
define('DB_NAME', 'id16379596_bazapodataka');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>