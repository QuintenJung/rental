<?php
session_start();
require_once "../database/connection.php";

if (isset($_POST['login'])) {

    $select_user = $conn->prepare("SELECT * FROM account WHERE email = :email");
    $select_user->bindParam(":email", $_POST['email']);
    $select_user->execute([$_POST['email']]);
    $user = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($user->rowCount() > 0) {
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header('Location: ../pages/connection.php');
        }

    }

}


