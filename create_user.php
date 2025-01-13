<?php
include 'db.php';

$username = $_POST['username'];
$password=$_POST['password'];
$mobile=$_POST['mobile'];
$email = $_POST['email'];



$sql = "INSERT INTO users (username, password, mobile, email) VALUES ('$username', 'password', 'mobile', '$email')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "User created successfully"]);
} else {
    echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
