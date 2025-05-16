<?php require "includes/header.php";?>
<main>
    <form action="login-handler" class="account-form" method="post">
        <h2 class="login-title">Log in</h2>
        <?php if (isset($_SESSION['errorMessage'])): ?>
            <div class="message">
                <?= $_SESSION['errorMessage'] ?>
            </div>
            <?php
            session_destroy();
        endif; ?>

        <label class="pictogram-container" for="email">Uw e-mail <img class="email-image" src="assets/images/email.png" alt="email plaatje"></label>
        <input type="email" name="email" id="email" placeholder="johndoe@gmail.com" value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>">
        <label class="pictogram-container" for="password">Uw wachtwoord <img class="password-image" src="assets/images/password.png" alt="password plaatje"></label>
        <input type="password" name="password" id="password" placeholder="Uw wachtwoord">
        <input type="submit" value="Log in" class="button-form">
    </form>
</main>

<?php require "includes/footer.php" ?>
