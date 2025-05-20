<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once __DIR__ . '/../database/connection.php';
    $data = $_POST['data'] ?? 'No data received';

    $data = json_decode(file_get_contents("php://input"), true);
if (!is_array($data)) {
    echo json_encode(['error' => 'Invalid data']);
    exit;
}

    $create_account = $conn->prepare(
        "INSERT INTO cars (
        car_name,
        car_img,
        car_sterren,
        car_reviewers,
        car_desc,
        car_type,
        car_capacity,
        car_steering,
        car_gasoline,
        car_prijs) 
        VALUES (
        :name,
        :img,
        :sterren,
        :reviewers,
        :description,
        :type,
        :capacity,
        :steering,
        :gasoline,
        :prijs
        )"
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

    $create_account->execute();


    echo json_encode(['message' => $data, 'received' => $data]);
}
?>