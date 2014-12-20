<?php
//$room = $_POST["room"];
$room = "Babblenow Discusions";
$x = mysqli_connect("localhost", "root", "","nodetest" );
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

 $result = mysqli_query($x, "SELECT * from message where room = '$room'");
 $jsonData = array();
while ($array = mysqli_fetch_assoc($result)) {
    $jsonData[] = $array;
}
echo json_encode($jsonData);
 ?>
