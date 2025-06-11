<?php

// nog niet goed!!!
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once __DIR__ . '/../database/connection.php';
    $data = $_POST['data'] ?? 'No data received';

    $data = json_decode(file_get_contents("php://input"), true);
    if (!is_array($data)) {
        echo json_encode(['error' => 'Invalid data']);
        exit;
    }

    $create_account = $conn->prepare("
    UPDATE cars SET
    car_name = :name,
    car_img = :img,
    car_sterren = :sterren,
    car_reviewers = :reviewers,
    car_desc = :description,
    car_type = :type,
    car_capacity = :capacity,
    car_steering = :steering,
    car_gasoline = :gasoline,
    car_prijs = :prijs
    WHERE car_id = :id"

    );

    $create_account->bindParam(":name", $data[0]);
    $create_account->bindParam(":img", $data[2]);
    $create_account->bindParam(":sterren", $data[8]);
    $create_account->bindParam(":reviewers", $data[9]);
    $create_account->bindParam(":description", $data[1]);
    $create_account->bindParam(":type", $data[3]);
    $create_account->bindParam(":capacity", $data[4]);
    $create_account->bindParam(":steering", $data[5]);
    $create_account->bindParam(":gasoline", $data[6]);
    $create_account->bindParam(":prijs", $data[7]);
    $create_account->bindParam(":id", $data[10]);

    $create_account->execute();

    $last_id = $conn->lastInsertId();

    echo json_encode(['message' => $last_id, 'received' => $data]);
}
