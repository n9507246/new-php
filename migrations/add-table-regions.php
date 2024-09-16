
<?php
    
    include '/var/www/html/database/connect.php';

    $pdo = openConnection();
    $stmt = $pdo->query(    
        "CREATE TABLE IF NOT EXISTS regions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            duration INT NOT NULL
        );"
    );

    $pdo = null;