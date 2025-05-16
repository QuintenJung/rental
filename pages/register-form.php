<?php require "includes/header.php" ?>
<main>
    <form action="register-handler" method="post" class="account-form">
        <h2 class="make-a-account">Maak een account aan</h2>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?= $_SESSION['message'] ?>
            </div>
            <?php
            session_destroy();
             endif; ?>
        <label class="pictogram-container" for="email">Uw e-mail <img class="email-image" src="assets/images/email.png" alt="email plaatje"></label>
        <input type="email" name="email" id="email" placeholder="johndoe@gmail.com" value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>">
        <label class="pictogram-container" for="password">Uw wachtwoord <img class="password-image" src="assets/images/password.png" alt="password plaatje"></label>
        <input type="password" name="password" id="password" placeholder="Uw wachtwoord">
        <label class="pictogram-container" for="confirm-password">Herhaal wachtwoord <img class="password-again-image" src="assets/images/passwordagain.png" alt="password plaatje"></label>
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Uw wachtwoord">
        <input type="submit" value="Maak account aan" class="button-formsubmit">
    </form>
</main>

<?php require "includes/footer.php" ?>
