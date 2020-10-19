<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 2 - LAMP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    require_once('./lab2db.php');
                    $db_conn = connectDB();

                    $stmt = $db_conn->prepare('select radius, surface_area, volume from spheres');
                    if (!$stmt) {
                        echo 'Error '.$dbc->errorCode().'\n Message '.implode($dbc->errorInfo()).'\n';
                        exit(1);
                    }

                    $status = $stmt->execute();
                    if ($status) {
                        echo '<h2 class="text-center">Number of rows found is '.$stmt->rowCount().'</h2>';
                        if ($stmt->rowCount() > 0) {                                  
                        ?>
                        <table class="table">
                        <tr>
                            <th>Radius</th>                            
                            <th>Surface</th>
                            <th>Volume</th>
                        </tr>
                        <tbody>                                                
                        <?php
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                printf("<tr><td>%12.4f</td><td>%12.4f</td><td>%12.4f</td></tr>",
                                    $row['radius'],
                                    $row['surface_area'],
                                    $row['volume']
                                );
                            }
                            echo'</tbody></table>';
                        } else {
                            echo 'Nothing to output';
                        }
                    } else {
                        echo 'Error '.$stmt.errorCode().'\n Message'.implode($stmt->errorInfo()).'\n';
                        exit(1);
                    }
                    ?>
                <p></p>
            </div>
        </div>
    </div>
</body>
</html>