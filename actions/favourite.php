<?php
session_start();
include_once "../database/connection.php";

try {
    if (!isset($_SESSION['id'])) {
        header("Location: home.php");
        exit;
    }

    $user_id = $_SESSION['id'];
    $car_id = $_POST['car_id'] ?? null;

    if ($car_id === null) {
        header("Location: home.php");
        exit;
    }

    $select_fav = $conn->prepare("SELECT 1 FROM favourites WHERE user_id = :uid AND car_id = :cid");
    $select_fav->execute(['uid' => $user_id, 'cid' => $car_id]);
    $is_fav = $select_fav->fetch() ? true : false;

    if ($is_fav) {
        $delete_fav = $conn->prepare("DELETE FROM favourites WHERE user_id = :uid AND car_id = :cid");
        $delete_fav->execute(['uid' => $user_id, 'cid' => $car_id]);
    } else {
        $insert_fav = $conn->prepare("INSERT INTO favourites (user_id, car_id) VALUES (:uid, :cid)");
        $insert_fav->execute(['uid' => $user_id, 'cid' => $car_id]);
    }


    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo "Er ging iets mis met het toevoegen/verwijderen van je favoriet. Probeer het later opnieuw!";
    exit;
}
