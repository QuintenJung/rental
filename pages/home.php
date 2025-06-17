<?php require "includes/header.php" ?>
<header>
    <div class="advertorials">
        <div class="advertorial">
            <h2>Hét platform om een auto te huren</h2>
            <p>Snel en eenvoudig een auto huren. Natuurlijk voor een lage prijs.</p>
            <a href="#" class="button-primary">Huur nu een auto</a>
            <img src="assets/images/car-rent-header-image-1.png" alt="">
        </div>
        <div class="advertorial">
            <h2>Wij verhuren ook bedrijfswagens</h2>
            <p>Voor een vaste lage prijs met prettig voordelen.</p>
            <a href="#" class="button-primary">Huur een bedrijfswagen</a>
            <img src="assets/images/car-rent-header-image-2.png" alt="">

        </div>
    </div>
</header>
<main class="car-main">
    <h2 class="section-title">Populaire auto's</h2>
    <div class="cars poplaire-cars">
        <?php
        include_once "database/connection.php";
        $select_user = $conn->prepare("SELECT * FROM cars WHERE car_sterren >= 4 ORDER BY car_reviewers LIMIT 4;");
        $select_user->execute();
        $car_info = $select_user->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i <= 3; $i++) :
            $car_popup = $car_info[$i] ?? null;
            if ($car_popup == null) {
                break;
            }
        ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3><?php echo $car_popup["car_name"] ?></h3>
                    <div class="car-type">
                        <?php echo $car_popup["car_type"] ?>
                    </div>
                </div>
                <img src="assets/images/products/<?php echo $car_popup["car_img"]?>" alt="">
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
    </div>
    <h2 class="section-title">Aanbevolen auto's</h2>
    <div class="cars aanbevolen-cars">
        <?php
        $select_user = $conn->prepare("SELECT * FROM cars ORDER BY rand() LIMIT 12;");
        $select_user->execute();
        $car_info = $select_user->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i <= 11; $i++) :
            $car_popup = $car_info[$i] ?? null;
            if ($car_popup == null) {
                break;
            }
        ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3><?php echo $car_popup["car_name"] ?></h3>
                    <div class="car-type">
                        <?php echo $car_popup["car_type"] ?>
                    </div>
                </div>
                <img src="assets/images/products/<?php echo $car_popup["car_img"]?>" alt="">
                <div class="car-specification">
                    <span><img src="assets/images/icons/gas-station.svg" alt=""><?php echo $car_popup["car_gasoline"] ?>l</span>
                    <span><img src="assets/images/icons/car.svg" alt=""><?php echo $car_popup["car_steering"] ?></span>
                    <span><img src="assets/images/icons/profile-2user.svg" alt="">
                        <?php echo $car_popup["car_capacity"];?> p </span>
                </div>
                <div class="rent-details">
                    <span><span class="font-weight-bold">€<?php echo number_format($car_popup["car_prijs"], 2, ',', '.') ?></span> / dag</span>
                    <a href="car-detail?id=<?php echo $car_popup["car_id"] ?>" class="button-primary">Bekijk nu</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <div class="show-more">
        <a class="button-primary" href="ons-aanbod.php">Toon alle</a>
    </div>
</main>

<?php require "includes/footer.php" ?>