<?php
    // DATABASE DETAILS
    $db_host = "localhost";
    $db_name = "USER_DB";
    $db_user = "root";
    $db_password = "";

    // CONNECTION CREATED
    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error >>> ". $e->getMessage();
    }

?>