<?php require "includes/header.php" ?>

<?php
$car = $_GET['id'] ?? null;
if ($car !== null) {
    // tijdelijk
    echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('editCarOptionEditer').style.display = 'block';
        });
    </script>";
    include_once "database/connection.php";
    $select_user = $conn->prepare("SELECT * FROM cars WHERE car_id = :id");
    $select_user->bindParam(":id", $car);
    $select_user->execute();
    $car_info_edit = $select_user->fetch(PDO::FETCH_ASSOC);

    if (!$car_info_edit) {
        header("Location: home.php");
    }
}
?>

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
                <img src="assets/images/products/<?php echo $car_popup["car_img"] ?>" alt="">
                <p><?php echo $car_popup["car_name"] ?></p>
                <p class="editCarOptionPrijs">€<?php echo $car_popup["car_prijs"] ?></p>
            </div>
        </div>
    <?php endfor ?>
</form>



<form id="editCarOptionEditer">
    <div class="addCarPopupHeader">
        <p>pas auto aan</p>
        <img src="assets\images\icons\close-button.png" id="editerCarPopupClose">
    </div>
    <div class="addCarinput">
        <label>naam</label>
        <input type="text" name="edit_name" id="edit_name" value="<?php echo $car_info_edit["car_name"] ?>">
        <p class="desc"></p>
    </div>
    <div class="addCarinput">
        <label>beschijving</label>
        <input type="text" name="edit_beschijving" id="edit_beschijving" value="beschijving">
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
        <input type="text" name="edit_type" id="edit_type" value="type">
        <p class="desc">bijv. sport.</p>
    </div>
    <div class="addCarinput">
        <label>capaciteit</label>
        <input type="number" value="1" name="edit_capacity" id="edit_capacity" min="0">
        <p class="desc">hoeveel mensen passen in de auto.</p>
    </div>
    <div class="addCarinput">
        <label>schaakelen</label>
        <select name="edit_steering" id="edit_steering">
            <option value="automaat">automaat</option>
            <option value="handschakel">handschakel</option>
        </select>
        <p class="desc"></p>
    </div>
    <div class="addCarinput">
        <label>benzine capaciteit</label>
        <input type="number" name="edit_gasoline" id="edit_gasoline" value="90" min="0">
        <p class="desc">hoeveel liter bezienen kan er in de auto</p>
    </div>
    <div class="addCarinput">
        <label>prijs</label>
        <input type="number" name="edit_prijs" id="edit_prijs" step="0.01" value="100" min="0">
        <p class="desc">in €</p>
    </div>
    <!-- later weghalen als we iets "echts" hiervoor hebben verzonnen -->
    <div class="addCarinput">
        <label>sterren</label>
        <input type="number" min="0" max="5" name="edit_sterren" id="edit_sterren" value="0">
        <p class="desc">reting tussen 0 en 5</p>
    </div>
    <div class="addCarinput">
        <label>reviewers</label>
        <input type="number" name="edit_reviewers" id="edit_reviewers" value="0" min="0">
        <p class="desc">de hoeveelheid reviewers</p>
    </div>
    <div id="addCarSubmit">voeg auto toe</div>
</form>

<script src="assets/javascript/admin-pannel.js"></script>

<?php require "includes/footer.php" ?>