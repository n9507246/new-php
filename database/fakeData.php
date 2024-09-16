<?php
    include '/var/www/html/database/connect.php';

    $pdo = openConnection();


    // Список курьеров
    $couriers = ['Иванов Иван', 'Петров Петр', 'Сидоров Сидор', 'Алексеев Алексей', 'Васильев Василий', 'Кузнецов Михаил', 'Егоров Сергей', 'Николаев Никита', 'Макаров Максим', 'Лебедев Леонид'];

    // Список регионов и длительности поездок
    $regions = [
        ['name' => 'Санкт-Петербург', 'duration' => 3],
        ['name' => 'Уфа', 'duration' => 5],
        ['name' => 'Нижний Новгород', 'duration' => 4],
        ['name' => 'Владимир', 'duration' => 2],
        ['name' => 'Кострома', 'duration' => 6],
        ['name' => 'Екатеринбург', 'duration' => 7],
        ['name' => 'Ковров', 'duration' => 2],
        ['name' => 'Воронеж', 'duration' => 3],
        ['name' => 'Самара', 'duration' => 4],
        ['name' => 'Астрахань', 'duration' => 6],
    ];

    // Заполнение таблицы курьеров
    foreach ($couriers as $courier) {
        $pdo->query("INSERT INTO couriers (name) VALUES ('$courier')");
    }

    // Заполнение таблицы регионов
    foreach ($regions as $region) {
        $name = $region['name'];
        $duration = $region['duration'];
        $pdo->query("INSERT INTO regions (name, duration) VALUES ('$name', $duration)");
    }

    // Генерация поездок на 3 месяца
    for ($i = 0; $i < 90; $i++) {
        $courier_id = rand(1, count($couriers));
        $region_id = rand(1, count($regions));
        $departure_date = date('Y-m-d', strtotime("+$i days"));
        
        // Получаем длительность поездки для региона
        $result = $pdo->query("SELECT duration FROM regions WHERE id = $region_id");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $duration = $row['duration'];
        
        // Рассчитываем дату прибытия
        $arrival_date = date('Y-m-d', strtotime("+$duration days", strtotime($departure_date)));
        
        // Добавляем запись в расписание
        $pdo->query("INSERT INTO schedule (courier_id, region_id, departure_date, arrival_date) 
                        VALUES ($courier_id, $region_id, '$departure_date', '$arrival_date')");
    }

    echo "Данные успешно сгенерированы!";

    $pdo = null;
?>
