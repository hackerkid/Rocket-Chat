<? php
require_once("database.php");
$room = $_POST["room"];

$result = mysqli_query($conf, "SELECT * from message  where room = '$room' ORDER by id DESC LIMIT 18");
$jsonData = array();
while ($array = mysqli_fetch_assoc($result)) {
    $jsonData[] = $array;
}
echo json_encode($jsonData); ?>