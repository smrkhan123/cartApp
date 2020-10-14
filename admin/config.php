<?php

$base_url = "http://localhost/app/admin/";


$servername = "localhost";
$username = "root";
$password = "";
$dbname= "app";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "Connection failed";
} else {
    echo '';
}

?>