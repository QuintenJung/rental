<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once __DIR__ . '/../database/connection.php';
    $data = $_POST['data'] ?? 'No data received';

    $data = json_decode(file_get_contents("php://input"), true);
    if (!is_array($data)) {
        echo json_encode(['error' => 'Invalid data']);
        exit;
    }

    $create_account = $conn->prepare("DELETE FROM cars WHERE car_id = :id");

    $create_account->bindParam(":id", $data[0]);

    $create_account->execute();

    $last_id = $conn->lastInsertId();

    echo json_encode(['message' => $last_id, 'received' => $data]);
}
