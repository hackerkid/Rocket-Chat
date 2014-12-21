<?php
require_once("database.php");

$name = $_POST["name"];
$message = $_POST["message"];
$room = $_POST["room"];

$query = "INSERT into message (author, message, room) VALUES ('$name', '$message','$room')";
mysqli_query($conf, $query);

mysqli_close($x);
?>


