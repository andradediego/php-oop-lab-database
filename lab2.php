<?php 
    declare(strict_types = 1);
    require_once('./lab2db.php');

    function randomSpheres (int $numSpheres) : array {
        $spheres = array();
        for ($i=0; $i < $numSpheres; $i++) { 
            $spheres[$i] = rand(1,20);

        }
        return $spheres;
    }

    $spheres = randomSpheres(10);

    $db_conn = connectDB();

    $stmt = $db_conn->prepare('insert into spheres (radius, surface_area, volume) values (?, ?, ?)');

    if (!$stmt) {
        echo 'Error '.$dbc->errorCode().'\n Message '.implode($dbc->errorInfo()).'\n';
        exit(1);
    }

    foreach($spheres as $s) {
        $radius = $s;
        $surface = 4 * 3.14 * $s**2;
        $volume = $surface / 3;
        
        $status = $stmt->execute(array($radius, $surface, $volume));

        if (!$status) {
            echo 'Error '.$stmt.errorCode().'\n Message'.implode($stmt->errorInfo()).'\n';
            exit(1);
        }        
    }
?>