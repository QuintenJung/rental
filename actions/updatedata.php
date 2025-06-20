<?php
session_start();
require "database/connection.php";

if (!empty($_POST['email'])) {
    $check_account = $conn->prepare("SELECT * FROM account WHERE email = :email AND id != :id");
    $check_account->bindParam(":email", $_POST['email']);
    $check_account->bindParam(":id", $_SESSION['id']);
    $check_account->execute();

    if ($check_account->rowCount() === 0) {
        $select_user = $conn->prepare("UPDATE account SET email = :email WHERE id = :id");
        $select_user->bindParam(":id", $_SESSION['id']);
        $select_user->bindParam(":email", $_POST['email']);
        $select_user->execute();
        $_SESSION["error"] = "gegevens geüpdatet";
    } elseif ($check_account->rowCount() > 0) {
        $_SESSION["error"] = "Email is al in gebruik.";
        header("Location: usersettings.php");
        exit();
    }
}

if (!empty($_POST['password'])) {
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $select_user = $conn->prepare("UPDATE account SET password = :password WHERE id = :id");
    $select_user->bindParam(":password", $hashed_password);
    $select_user->bindParam(":id", $_SESSION['id']);
    $select_user->execute();
}

header('Location: usersettings.php');
exit();
