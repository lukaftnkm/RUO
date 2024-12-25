
<?php

$host = 'db';
$user = 'devuser';
$password = 'devpass';
$db = 'test_db';

$conn = new mysqli($host, $user, $password, $db);

if($conn->connect_error) {
    echo 'conection failed' . $conn->connect_error;
}
echo 'Succesfully connected to MYSQL';

?>
