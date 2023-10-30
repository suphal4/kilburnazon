<?php
    $host = "dbhost.cs.man.ac.uk";
    $password = "Mondler.1822";
    $username = "j54137ss";

    $db = new pdo('mysql:host=dbhost.cs.man.ac.uk;dbname=j54137ss;', $username, $password   );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);