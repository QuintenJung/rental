
<?php require "includes/header.php" ?>

<?php
$car = $_GET['id'] ?? null;
$actie = $_GET['actie'] ?? null;
if ($car !== null && $actie == null) {
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
        // header("Location: home.php");
    }
} else {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
        console.log('de 25 warnings horen');
        });
    </script>";
}
?>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
<main id="buttonMain">
    <button id="addCar">
        voeg een auto toe
    </button>
    <button id="editCar">
        pas auto aan
    </button>
    <button id="delCar">
        verwijder een auto
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
            <a class="editCarOption" href="admin-pannel.php?id=<?php echo $car_popup["car_id"] ?>">
                <img src="assets/images/products/<?php echo $car_popup["car_img"] ?>" alt="">
                <p><?php echo $car_popup["car_name"] ?></p>
                <p class="editCarOptionPrijs">€<?php echo $car_popup["car_prijs"] ?></p>
            </a>
        </div>
    <?php endfor ?>
</form>

<!-- hier nog 1 voor del -->
<form id="delCarPopup">
    <div class="delCarPopupHeader">
        <p>kies een auto om te verwijderen</p>
        <img src="assets\images\icons\close-button.png" id="delCarPopupClose">
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
        <div class="delCarOptionDysplay">
            <a class="delCarOption" onclick="delCarWarningPopup(<?php echo $car_popup['car_id'] ?>)">
                <img src="assets/images/products/<?php echo $car_popup["car_img"] ?>" alt="">
                <p><?php echo $car_popup["car_name"] ?></p>
                <p class="delCarOptionPrijs">€<?php echo $car_popup["car_prijs"] ?></p>
            </a>
        </div>
    <?php endfor ?>
</form>

<div id="delCarWarning">
    <p>Weet je zeker dat de deze auto wilt verwijderen. <br>Dit kan niet ongedaan woorden</p>
    <div id="buttonDiv">
        <!-- de nog niet hier verder -->
        <div id="confirmCarDel">confirm</div>
        <!-- deze heeft onclick -->
        <div id="cancelCarDel">cancel</div>
    </div>
</div>

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
        <input type="text" name="edit_beschijving" id="edit_beschijving" value="<?php echo $car_info_edit["car_desc"] ?>">
        <p class="desc"></p>
    </div>
    <div class="addCarinput">
        <label>afbelding</label>
        <?php
        $folder = 'assets/images/products';
        $files = array_diff(scandir($folder), ['.', '..']);
        ?>
        <select name="edit_img" id="edit_img">
            <option value="<?php echo $car_info_edit["car_img"] ?>">
                >> <?php echo $car_info_edit["car_img"] ?>
            </option>
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
        <input type="text" name="edit_type" id="edit_type" value="<?php echo $car_info_edit["car_type"] ?>">
        <p class="desc">bijv. sport.</p>
    </div>
    <div class="addCarinput">
        <label>capaciteit</label>
        <input type="number" value="<?php echo $car_info_edit["car_capacity"] ?>" name="edit_capacity" id="edit_capacity" min="0">
        <p class="desc">hoeveel mensen passen in de auto.</p>
    </div>
    <div class="addCarinput">
        <label>schaakelen</label>
        <select name="edit_steering" id="edit_steering">
            <option value="<?php echo $car_info_edit["car_steering"] ?>"> >> <?php echo $car_info_edit["car_steering"] ?> </option>
            <option value="automaat">automaat</option>
            <option value="handschakel">handschakel</option>
        </select>
        <p class="desc"></p>
    </div>
    <div class="addCarinput">
        <label>benzine capaciteit</label>
        <input type="number" name="edit_gasoline" id="edit_gasoline" value="<?php echo $car_info_edit["car_capacity"] ?>" min="0">
        <p class="desc">hoeveel liter bezienen kan er in de auto</p>
    </div>
    <div class="addCarinput">
        <label>prijs</label>
        <input type="number" name="edit_prijs" id="edit_prijs" step="0.01" value="<?php echo $car_info_edit["car_prijs"] ?>" min="0">
        <p class="desc">in €</p>
    </div>
    <!-- later weghalen als we iets "echts" hiervoor hebben verzonnen -->
    <div class="addCarinput">
        <label>sterren</label>
        <input type="number" min="0" max="5" name="edit_sterren" id="edit_sterren" value="<?php echo $car_info_edit["car_sterren"] ?>">
        <p class="desc">reting tussen 0 en 5</p>
    </div>
    <div class="addCarinput">
        <label>reviewers</label>
        <input type="number" name="edit_reviewers" id="edit_reviewers" value="<?php echo $car_info_edit["car_reviewers"] ?>" min="0">
        <p class="desc">de hoeveelheid reviewers</p>
    </div>
    <div id="editCarSubmit" data-waarde="<?php echo $car_info_edit["car_id"] ?>">pas auto aan</div>
</form>

<script src="assets/javascript/admin-pannel.js"></script>

<?php require "includes/footer.php" ?>

<?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'gebruiker'): ?>
    <?php
    header('Location: home.php');
    exit();
    ?>
<?php else: ?>
<?php
    header('Location: home.php');
exit();
?>
<?php endif; ?>
