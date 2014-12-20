<?php

$x = mysqli_connect("localhost", "root", "","nodetest" );
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$name = $_POST["name"];
$message = $_POST["message"];
$room = $_POST["room"];

$query = "INSERT into message (author, message, room) VALUES ('$name', '$message','$room')";
mysqli_query($x, $query);

mysqli_close($x);
?>


