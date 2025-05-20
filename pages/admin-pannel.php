<?php require "includes/header.php"?>
<header>

</header>
<main>
    <!--button kunnen beteren text hebben -->
    <button id="addCar">
        voeg een auto toe
    </button>
    <button id="editCar">
        pas auto aan
    </button>
</main>
<form id="addCarPopup">
    <!-- als een <p> leeg is kan je hem niet weghalen, de vollen natuurlijk ook niet -->
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
    <!-- deze doe ik later, ik wil hier een directe folder voor gebruiken -->
    <div class="addCarinput">
        <label>IMG (NIET AF, doe ik later)</label>
        <input type="text" name="car_img" id="car_img">
        <p class="desc"></p>
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
    <!-- voeg toe -->
    <div id="addCarSubmit">(NIET AANKOMEN)</div>

</form>

<script src="assets/javascript/admin-pannel.js"></script>

<?php require "includes/footer.php" ?>