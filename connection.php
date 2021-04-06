<?php

$connection = mysqli_connect("localhost", "root", "", "voting");

if(!$connection){
    echo "Could not connect to database" .mysqli_error($connection);
}
?>