    <?php
    if (file_exists("./database/connection.php")) {
        include_once "./database/connection.php";
    } else {
        include_once "../database/connection.php";
    }

    try {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $colum = 3;
        $rijen = 5;
        $perPage = $colum * $rijen;
        $offset = ($page - 1) * $perPage;

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
        $query .= " ORDER BY car_id LIMIT :limit OFFSET :offset";

        $select_user = $conn->prepare($query);
        
        foreach ($params as $key => $value) {
            $select_user->bindValue($key, $value);
        }
        $select_user->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $select_user->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        // echo $query;
        $select_user->execute();
        $car_info = $select_user->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo "Oops! The cars are hiding right now. Try again later! 🚗";
        exit;
    }
    if (count($car_info) == 0) : ?>
        <p>niks gevonden met deze filters.</p>
    <?php exit; endif;
    for ($i = 0; $i < count($car_info); $i++) :
        $car_popup = $car_info[$i];
    ?>
        <div class="car-details">
            <div class="car-brand">
                <h3><?php echo $car_popup["car_name"] ?></h3>
                <div class="car-type">
                    <?php echo $car_popup["car_type"] ?>
                </div>
            </div>
            <img src="assets/images/products/<?php echo $car_popup["car_img"] ?>" alt="">
            <div class="car-specification">
                <span><img src="assets/images/icons/gas-station.svg" alt=""><?php echo $car_popup["car_gasoline"] ?>l</span>
                <span><img src="assets/images/icons/car.svg" alt=""><?php echo $car_popup["car_steering"] ?></span>
                <span><img src="assets/images/icons/profile-2user.svg" alt=""><?php echo $car_popup["car_capacity"]; ?> p</span>
            </div>
            <div class="rent-details">
                <span><span class="font-weight-bold">€<?php echo number_format($car_popup["car_prijs"], 2, ',', '.') ?></span> / dag</span>
                <a href="car-detail?id=<?php echo $car_popup["car_id"] ?>" class="button-primary">Bekijk nu</a>
            </div>
        </div>
    <?php endfor; ?>