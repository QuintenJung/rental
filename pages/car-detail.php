<?php require "includes/header.php" ?>
<?php require "database/connection.php" ?>

<?php
$car = $_GET['id'] ?? null;

$select_user = $conn->prepare("SELECT * FROM cars WHERE car_id = :id");
$select_user->bindParam(":id", $car);
$select_user->execute();
$car_info = $select_user->fetch(PDO::FETCH_ASSOC);

if ($car == null || $select_user->rowCount() == 0) {
    header("Location: home.php");
}
?>
<main class="car-detail">
    <div class="grid">
        <div class="row">
            <div class="advertorial">
                <img src="assets/images/products/<?php echo $car_info["car_img"]?>" alt="" height="300px">
            </div>
        </div>
        <div class="row white-background car-info">
            <h2 class="car-title"><?php echo $car_info["car_name"]?></h2>
            <div class="rating">
                <span class="stars stars-<?php echo $car_info["car_sterren"]?>"></span>
                <span> <?php echo $car_info["car_reviewers"]?> reviewers</span>
                <?php
                $is_favourite = false;
                if (isset($_SESSION['id'])) {
                $stmt = $conn->prepare("SELECT 1 FROM favourites WHERE user_id = :uid AND car_id = :cid");
                $stmt->execute(['uid' => $_SESSION['id'], 'cid' => $car_popup['car_id']]);
                $is_favourite = $stmt->fetch() ? true : false;
                }
                ?>
                <form method="post" action="favourite.php">
                    <input type="hidden" name="car_id" value="<?php echo $car_popup['car_id']; ?>">
                    <button type="submit" name="favourite">
                        <?php if ($is_favourite): ?>
                            <img  src="assets/images/redheart.png">
                        <?php else: ?>
                            <img  src="assets/images/greyheart.png">
                        <?php endif; ?>
                    </button>
                </form>
            </div>
            <p><?php echo  $car_info["car_desc"]?></p>
            <div class="car-type">
                <div class="grid">
                    <div class="row"><span class="accent-color">Type Car</span><span><?php echo $car_info["car_type"]?></span></div>
                    <div class="row"><span class="accent-color">Capacity</span><span><?php echo $car_info["car_capacity"]?> personen</span></div>
                </div>
                <div class="grid">
                    <div class="row"><span class="accent-color">Steering</span><span><?php echo $car_info["car_steering"]?></span></div>
                    <div class="row"><span class="accent-color">Gasoline</span><span><?php echo $car_info["car_gasoline"]?>L</span></div>
                </div>
                <div class="call-to-action huur-nu-div">
                    <div class="row"><span class="font-weight-bold">€<?php echo number_format($car_info["car_prijs"], 2, ',', '.')?></span> / dag</div>
                    <!-- href veranderen -->
                    <div class="row"><a href="home" class="button-primary">Huur nu</a></div>
                </div>

            </div>
        </div>
    </div>
</main>

<?php require "includes/footer.php" ?>
