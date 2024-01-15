<?php

    $server = "localhost";
    $database = "g16";
    $username = "g16";
    $password = "ki67cos";

    $connection = new mysqli($server, $username, $password, $database)
    or die("Keine Verbindung möglich: " . mysql_error());

    $query = "SELECT * FROM buecher";

    $result = $connection->query($query)
    or die("Anfrage fehlgeschlagen: " . mysql_error());

    $data_array = array();
    while($row=mysqli_fetch_assoc($result))
    {
        $data_array[] = $row;
    }

    $fp = fopen('buecher.json', 'w');
    fwrite($fp, json_encode($data_array));
    fclose($fp);
    $connection->close();
?>