<?php
session_start();
require "database/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];

    if ($password === $confirm_password && !empty($password) && !empty($email) && !empty($confirm_password)) {
        $check_account = $conn->prepare("SELECT * FROM account WHERE email = :email");
        $check_account->bindParam(":email", $email);
        $check_account->execute();

        if ($check_account->rowCount() === 0) {
            //Extra hoge cost om nog beter te beveiligen
            $options = ['cost' => 3];
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

            $create_account = $conn->prepare("INSERT INTO account (email, password) VALUES (:email, :password)");
            $create_account->bindParam(":email", $email);
            $create_account->bindParam(":password", $encrypted_password);
            $create_account->execute();

            $_SESSION["success"] = "Registratie is gelukt, log nu in:";
            header("Location: login-form.php");
            exit();

        }

        elseif ($check_account->rowCount() > 0) {
            $_SESSION["message"] = "Email is al in gebruik.";
            header("Location: register-form.php");
            exit();
        }
    } elseif (empty($_POST['email']) && empty($_POST['password'])) {
        $_SESSION["message"] = "Email en password zijn leeg.";
        header("Location: register-form.php");
        exit();
    } elseif (empty($_POST['email'])) {
        $_SESSION["message"] = "Email is leeg.";
        header("Location: register-form.php");
        exit();
    } elseif (empty($_POST['password'])) {
        $_SESSION["message"] = "Password is leeg.";
        header("Location: register-form.php");
        exit();
    } elseif ($password !== $confirm_password) {
        $_SESSION["message"] = "Passwords zijn niet hetzelfde.";
        header("Location: register-form.php");
        exit();
    }
}
