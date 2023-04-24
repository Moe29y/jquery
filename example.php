<?php
$name = $_POST['name'];
$servername = "localhost";
$username = "root";
$userpassword ="07084802023";
$dbname ="db";

$conn = new mysqli($servername,$username,$userpassword,$dbname);

if($conn->connect_error){
die ("Error" . $conn->connect_error);
}

$sql = "INSERT INTO example (name) VALUES ('$name')";

if($conn->query($sql)===TRUE){

    echo "It is committed";
}
else{
    echo "error"  . $conn->connect_error;
}

$conn->close();




?>