<?php require "includes/header.php" ?>
<?php require "database/connection.php" ?>

<main class="filters-aanbod">
    <div class="filters">
        <?php $price = isset($_GET['max_price']) ? $_GET['max_price'] : 100; ?>
        <form method="get" class="filters-form">
            <h5 class="filter-title">Type</h5>
            <input type="checkbox" class="checkbox-filter" name="type[]" id="sport" value="Sport" onclick="this.form.submit()" <?php echo isset($_GET['type']) && in_array('Sport', $_GET['type'])  ? 'checked' : ''; ?>>
            <label>sport</label>
            <input type="checkbox" class="checkbox-filter" name="type[]" id="suv" value="SUV" onclick="this.form.submit()" <?php echo isset($_GET['type']) && in_array('SUV', $_GET['type']) ? 'checked' : ''; ?>>
            <label>suv</label>
            <input type="checkbox" class="checkbox-filter" name="type[]" id="mpv" value="MPV" onclick="this.form.submit()" <?php echo isset($_GET['type']) && in_array('MPV', $_GET['type']) ? 'checked' : ''; ?>>
            <label>mpv</label>
            <input type="checkbox" class="checkbox-filter" name="type[]" id="sedan" value="Sedan" onclick="this.form.submit()" <?php echo isset($_GET['type']) && in_array('Sedan', $_GET['type']) ? 'checked' : ''; ?>>
            <label>coupe</label>
            <input type="checkbox" class="checkbox-filter" name="type[]" id="coupe" value="Coupe" onclick="this.form.submit()" <?php echo isset($_GET['type']) && in_array('Coupe', $_GET['type']) ? 'checked' : ''; ?>>
            <label>sedan</label>
            <input type="checkbox" class="checkbox-filter" name="type[]" id="hatchback" value="Hatchback" onclick="this.form.submit()" <?php echo isset($_GET['type']) && in_array('Hatchback', $_GET['type']) ? 'checked' : ''; ?>>
            <label>hatchback</label>

            <h5 class="filter-title">Capacity</h5>
            <input type="checkbox" class="checkbox-filter" name="capacity[]" id="two-persons" value="2" onclick="this.form.submit()" <?php echo isset($_GET['capacity']) && in_array('2', $_GET['capacity'])  ? 'checked' : ''; ?>>
            <label>2 personen</label>
            <input type="checkbox" class="checkbox-filter" name="capacity[]" id="four-persons" value="4" onclick="this.form.submit()" <?php echo isset($_GET['capacity']) && in_array('4', $_GET['capacity'])  ? 'checked' : ''; ?>>
            <label>4 personen</label>
            <input type="checkbox" class="checkbox-filter" name="capacity[]" id="six-persons" value="6" onclick="this.form.submit()" <?php echo isset($_GET['capacity']) && in_array('6', $_GET['capacity'])  ? 'checked' : ''; ?>>
            <label>6 personen</label>
            <input type="checkbox" class="checkbox-filter" name="capacity[]" id="eight-or-more" value="8" onclick="this.form.submit()" <?php echo isset($_GET['capacity']) && in_array('8', $_GET['capacity'])  ? 'checked' : ''; ?>>
            <label>8 personen</label>

            <h5 class="filter-title">Price</h5>
            <input type="range" class="range-input-filter" list="price-markers" id="max_price" name="max_price" min="0" max="100" step="0.01" value="<?php echo $price; ?>" onchange="this.form.submit()">

            <span class="range-input-filter" >Max. €<?php echo $price; ?></span>
        </form>
    </div>
    <div class="content-aanbod content-aanbod-filters">
        <h2>Ons aanbod</h2>
        <div class="cars filterd-cars">
            <?php include "includes/fetchcars.php" ?>
        </div>

        <div class="pagination">
            <?php
            $select_user = $conn->prepare("SELECT car_id FROM cars");
            $select_user->execute();

            $car_info = $select_user->fetchAll(PDO::FETCH_ASSOC);
            $amount_id = count($car_info) / $perPage;
            for ($i = 0; $i <= $amount_id; $i++) : ?>
                <button class="pagination-button" data-page="<?php echo $i + 1 ?>"><?php echo $i + 1 ?></button>
            <?php endfor; ?>
        </div>

</main>

<script src="assets/javascript/ons-aanbod.js"></script>
<?php require "includes/footer.php" ?>