<?php 

    include '/var/www/html/database/connect.php';

    $pdo = openConnection();
    $stmt = $pdo->query(
        'CREATE TABLE IF NOT EXISTS schedule (
            id INT AUTO_INCREMENT PRIMARY KEY,
            courier_id INT,
            region_id INT,
            departure_date DATE,
            arrival_date DATE,
            FOREIGN KEY (courier_id) REFERENCES couriers(id),
            FOREIGN KEY (region_id) REFERENCES regions(id)
        )'
    );

    $pdo = null;