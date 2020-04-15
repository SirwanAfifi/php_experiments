<?php

    try {
        $lat = $_GET['lat'];
        $lon = $_GET['lon'];
        $radius = $_GET['radius'];
        $limit = $_GET['limit'];
        $cat_id = $_GET['cat_id'];

        if (!isset($lat) || !isset($lon) || !isset($radius)) {
            echo json_encode(['error' => 'Enter location, Radius']);
        }
        
        if (!isset($limit)) {
            $limit = 10;
        }
        
        if (!isset($cat_id)) {
            $cat_id = "NULL";
        }

        $pdo = new PDO("mysql:host=localhost;dbname=dbName", "username", "pass");

        $statement = $pdo->prepare("CALL Get_Locations({$lat}, {$lon}, {$radius}, {$limit}, {$cat_id});");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;

    } catch (PDOException $e) {

        die($e);

    }
?>