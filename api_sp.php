<?php

    try {
        $lat = $_GET['lat'];
        $lon = $_GET['lon'];

        if (!isset($lat) || !isset($lon)) {
            echo json_encode(['error' => 'Enter location']);
        }

        $pdo = new PDO("mysql:host=localhost;dbname=dbName", "username", "pass");

        $statement = $pdo->prepare("CALL `spName`({$lat}, {$lon});");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;

    } catch (PDOException $e) {

        die($e);

    }
?>