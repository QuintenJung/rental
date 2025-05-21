<?php require "includes/header.php" ?>

<main id="buttonMain">
    <button id="addCar">
        voeg een auto toe
    </button>
    <button id="editCar">
        pas auto aan
    </button>
</main>
<!-- als een <p> leeg is kan je hem niet weghalen, de vollen natuurlijk ook niet -->
<form id="addCarPopup">
    <div class="addCarPopupHeader">
        <p>voeg een auto toe</p>
        <img src="assets\images\icons\close-button.png" id="addCarPopupClose">
    </div>
    <div class="addCarinput">
        <label>naam</label>
        <input type="text" name="car_name" id="car_name" value="naam">
        <p class="desc"></p>
    </div>
    <div class="addCarinput">
        <label>beschijving</label>
        <input type="text" name="car_beschijving" id="car_beschijving" value="beschijving">
        <p class="desc"></p>
    </div>
    <div class="addCarinput">
        <label>afbelding</label>
        <?php
        $folder = 'assets/images/products';
        $files = array_diff(scandir($folder), ['.', '..']);
        ?>
        <select name="car_img" id="car_img">
            <?php foreach ($files as $file): ?>
                <option value="<?php echo htmlspecialchars($file); ?>">
                    <?php echo htmlspecialchars($file); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="desc">je kan in de folder kijken welke afbelding wat is</p>
    </div>
    <div class="addCarinput">
        <label>type</label>
        <input type="text" name="car_type" id="car_type" value="type">
        <p class="desc">bijv. sport.</p>
    </div>
    <div class="addCarinput">
        <label>capaciteit</label>
        <input type="number" value="1" name="car_capacity" id="car_capacity" min="0">
        <p class="desc">hoeveel mensen passen in de auto.</p>
    </div>
    <div class="addCarinput">
        <label>schaakelen</label>
        <select name="car_steering" id="car_steering">
            <option value="automaat">automaat</option>
            <option value="handschakel">handschakel</option>
        </select>
        <p class="desc"></p>
    </div>
    <div class="addCarinput">
        <label>benzine capaciteit</label>
        <input type="number" name="car_gasoline" id="car_gasoline" value="90" min="0">
        <p class="desc">hoeveel liter bezienen kan er in de auto</p>
    </div>
    <div class="addCarinput">
        <label>prijs</label>
        <input type="number" name="car_prijs" id="car_prijs" step="0.01" value="100" min="0">
        <p class="desc">in €</p>
    </div>
    <!-- later weghalen als we iets "echts" hiervoor hebben verzonnen -->
    <div class="addCarinput">
        <label>sterren</label>
        <input type="number" min="0" max="5" name="car_sterren" id="car_sterren" value="0">
        <p class="desc">reting tussen 0 en 5</p>
    </div>
    <div class="addCarinput">
        <label>reviewers</label>
        <input type="number" name="car_reviewers" id="car_reviewers" value="0" min="0">
        <p class="desc">de hoeveelheid reviewers</p>
    </div>
    <div id="addCarSubmit">voeg auto toe</div>
</form>

<form id="editCarPopup">
    <div class="editCarPopupHeader">
        <p>kies een auto om aan te passen</p>
        <img src="assets\images\icons\close-button.png" id="editCarPopupClose">
    </div>
    <?php
    include_once "database/connection.php";
    $select_user = $conn->prepare("SELECT * FROM cars");
    $select_user->execute();
    $car_info = $select_user->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i <= $select_user->rowCount(); $i++) :
        $car_popup = $car_info[$i] ?? null;
        if ($car_popup == null) {
            break;
        }
    ?>
    <div class="editCarOptionDysplay">
        <div class="editCarOption">
            <img src="assets/images/products/<?php echo $car_popup["car_img"]?>" alt="">
            <p><?php echo $car_popup["car_name"]?></p>
        </div>
    </div>
    <?php endfor ?>
</form>

<script src="assets/javascript/admin-pannel.js"></script>

<?php require "includes/footer.php" ?>