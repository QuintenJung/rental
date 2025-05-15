<?php
require "includes/header.php" ;

$errormessage = "";

if (isset($_POST["login"])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = strtolower($email);
    $password = strip_tags($_POST['password']);

    if (empty($email || $password)) {
        $errormessage = "All fields must be filled in";
    } else {
        header("Location: /rental/actions/login.php");
    }
}
?>
<main>

    <form action="#" class="account-form" method="post">
        <h2>Log in</h2>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="succes-message"><?= $_SESSION['success'] ?></div>
        <?php } ?>
        <?php if (!empty($errormessage)) {
            echo '<div class="errormessage">' . $errormessage . '</div>';
        } ?>
        <label for="email">Uw e-mail</label>
        <input type="email" name="email" id="email" placeholder="Email" value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>">
        <label for="password">Uw wachtwoord</label>
        <input type="password" name="password" id="password" placeholder="Uw wachtwoord">

        <input type="submit" value="Log in" name="login" class="button-primary">
    </form>
</main>

<?php require "includes/footer.php" ?>
