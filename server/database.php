<? php

$conf = mysqli_connect("localhost", "USERNAME", "PASSWORD", "DATABASE");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

?>