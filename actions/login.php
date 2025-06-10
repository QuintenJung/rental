<?php
session_start();
require_once "database/connection.php";

$select_user = $conn->prepare("SELECT * FROM account WHERE email = :email");
$select_user->bindParam(":email", $_POST['email']);
$select_user->execute();
$user = $select_user->fetch(PDO::FETCH_ASSOC);

if ($select_user->rowCount() > 0) {
    if (password_verify($_POST['password'], $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header('Location: home.php');
    } elseif (!password_verify($_POST['password'], $user['password'])) {
        $_SESSION["errorMessage"] = "Email of password is niet correct.";
        header("Location: login-form");
        exit();
    }

} elseif (empty($_POST['email']) && empty($_POST['password'])) {
    $_SESSION["errorMessage"] = "Email en password zijn leeg.";
    header("Location: login-form");
    exit();
    } elseif (empty($_POST['email'])) {
        $_SESSION["errorMessage"] = "Email is leeg.";
        header("Location: login-form");
        exit();
    } elseif (empty($_POST['password'])) {
    $_SESSION["errorMessage"] = "password is leeg.";
    header("Location: login-form");
    exit();
} else {
    $_SESSION["errorMessage"] = "Email of password is niet correct.";
    header("Location: login-form");
    exit();
}

