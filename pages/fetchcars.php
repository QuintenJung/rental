<?php
include_once "database/connection.php";

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$colum= 3;
$rijen= 5;
$perPage = $colum * $rijen;
$offset = ($page - 1) * $perPage;

$select_user = $conn->prepare("SELECT * FROM cars ORDER BY car_id LIMIT :limit OFFSET :offset");
$select_user->bindValue(':limit', $perPage, PDO::PARAM_INT);
$select_user->bindValue(':offset', $offset, PDO::PARAM_INT);
$select_user->execute();

$car_info = $select_user->fetchAll(PDO::FETCH_ASSOC);

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