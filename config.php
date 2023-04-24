<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$servername = "localhost";
$username = "root";
$userpassword = "07084802023";
$dbname = "db";

$conn = new mysqli($servername, $username, $userpassword, $dbname);

//接続

if ($conn->connect_error) {
    die("connection error" . $conn->connect_error);
}

$sql = "INSERT INTO usersdb (name,email,password) VALUES ('$name','$email','$password')";

if ($conn->query($sql) === TRUE) {
    echo "It is submitted";
} else {
    echo "Error" . $conn->connect_error;
}
$conn->close();


?>