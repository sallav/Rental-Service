<?php

/*
*   Open a connection via PDO to create a new database and table with structure.
*
*/ 

require "config.php";

try {
    $connection = new PDO("mysql:host=$host;port=$port;", $username, $password, $options);
    // Set PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = file_get_contents("data/init.sql");
    $connection->exec($sql);

    echo "Database and table rentals created successfully.";
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

?>