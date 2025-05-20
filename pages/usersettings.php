<?php
require_once "database/connection.php";
require "includes/header.php";


$msg = [];
$user = [];

try {
    //$pdo = new PDO($hostdb, $usr, $pwd, $PDOoptions);
    $select_user = $conn->prepare("SELECT email FROM account WHERE id = :id");
    $select_user->bindParam(':id', $_SESSION['id']);
    $select_user->execute();
    $user = $select_user->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $msg[] = "Database error: " . $e->getMessage();
    $user = [];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="data">
<form action="settings-handler" class="account-form" method="post">
    <h2 class="login-title">Settings</h2>
    <?php if (isset($_SESSION['error'])): ?>
    <div class="message">
        <?= $_SESSION['error'] ?>
    </div>
        <?php endif; ?>

    <label class="pictogram-container" for="email">Uw e-mail <img class="email-image" src="assets/images/email.png" alt="email plaatje"></label>
    <input type="email" name="email" id="email" placeholder="johndoe@gmail.com" value="<?php echo $user['email'] ?? ''; ?>">

    <label class="pictogram-container" for="password">Uw wachtwoord <img class="password-image" src="assets/images/password.png" alt="password plaatje"></label>
    <input type="password" name="password" id="password" placeholder="Uw wachtwoord">

    <input type="submit" value="update" class="button-form">
</form>
</div>
</body>
</html>

<?php require "includes/footer.php" ?>

