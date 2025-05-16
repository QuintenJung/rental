<?php
include_once "database/connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'] ?? 'No data received';


    $create_account = $conn->prepare(
        "INSERT INTO account (
        car_name,
        car_img,
        car_sterren,
        car_reviewers,
        car_desc,
        car_type,
        car_capacity,
        car_steering,
        car_gasoling,
        car_prijs) 
        VALUES (
        :name,
        :img,
        :sterren,
        :reviewers,
        :desc,
        :type,
        :capacity,
        :steering,
        :gasoling,
        :prijs
        )"
    );

    // hier verder met binden van de placeholders
    $create_account->bindParam(":email", $email);
    $create_account->bindParam(":password", $encrypted_password);
    $create_account->execute();


    echo json_encode(['message' => $data, 'received' => $data]);
}
