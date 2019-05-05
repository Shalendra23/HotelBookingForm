<?php

// import the user details from user.php for connection to the DB

require_once 'user.php';

// create connection to the hotel DB

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// check connection that the connection was successful

if($conn->connect_error){
    die ("Connection Failed " . $conn->connect_error());
}else 
    echo "<script> console.log('Connection Successful'); </script>"; 
?>