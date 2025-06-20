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
            <label>sedan</label>
            <input type="checkbox" class="checkbox-filter" name="type[]" id="coupe" value="Coupe" onclick="this.form.submit()" <?php echo isset($_GET['type']) && in_array('Coupe', $_GET['type']) ? 'checked' : ''; ?>>
            <label>coupe</label>
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

            <span class="range-input-filter">Max. €<?php echo $price; ?></span>
        </form>
    </div>
    <div class="content-aanbod content-aanbod-filters">
        <h2>Ons aanbod</h2>
        <div class="cars filterd-cars">
            <?php include "includes/fetchcars.php" ?>
        </div>

        <div class="pagination">
            <?php
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            $where_conditions = [];
            $params = [];
            if (!empty($_GET['type'])) {
                $type_placeholders = [];
                foreach ($_GET['type'] as $key => $type) {
                    $param_name = ":type_$key";
                    $type_placeholders[] = $param_name;
                    $params[$param_name] = $type;
                }
                if (!empty($type_placeholders)) {
                    $where_conditions[] = "car_type IN (" . implode(',', $type_placeholders) . ")";
                }
            }
            if (!empty($_GET['capacity'])) {
                $capacity_placeholders = [];
                foreach ($_GET['capacity'] as $key => $capacity) {
                    if (is_numeric($capacity)) {
                        $param_name = ":capacity_$key";
                        $capacity_placeholders[] = $param_name;
                        $params[$param_name] = (int)$capacity;
                    }
                }
                // Add capacity condition if we have any
                if (!empty($capacity_placeholders)) {
                    $where_conditions[] = "car_capacity IN (" . implode(',', $capacity_placeholders) . ")";
                }
            }
            // --- PRICE FILTER ---
            // Check if user set a maximum price
            if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
                $where_conditions[] = "car_prijs <= :price";
                $params[':price'] = (float)$_GET['max_price'];  // Convert to float
            }
            $query = "SELECT * FROM cars";
            if (!empty($where_conditions)) {
                $query .= " WHERE " . implode(' AND ', $where_conditions);
            }
            $select_user = $conn->prepare($query);

            foreach ($params as $key => $value) {
                $select_user->bindValue($key, $value);
            }
            // echo $query;
            $select_user->execute();
            $car_info = $select_user->fetchAll(PDO::FETCH_ASSOC);
            $amount_id = count($car_info) / $perPage;
            $maxpage = $page + 1 == $amount_id ? null : $page + 1;


            for ($i = 1; $i <= $amount_id + 1; $i++) : ?>
                <button class="pagination-button" data-page="<?= $i ?>"><?= $i ?></button>
            <?php endfor; ?>

        </div>

</main>

<script src="assets/javascript/ons-aanbod.js"></script>
<?php require "includes/footer.php" ?>