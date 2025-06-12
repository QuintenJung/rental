<?php require "includes/header.php" ?>

<main class="filters-aanbod">
    <div class="filters">
        <form action="#" method="post" class="filters-form">
            <input type="checkbox" name="Sport" id="Sport">

            <input type="checkbox" name="SUV" id="SUV">

            <input type="checkbox" name="MPV" id="MPV">

            <input type="checkbox" name="Sedan" id="Sedan">

            <input type="checkbox" name="Coupe" id="Coupe">

            <input type="checkbox" name="Hatchback" id="Hatchback">

            <input type="checkbox" name="two-persons" id="two-persons">

            <input type="checkbox" name="four-persons" id="four-persons">

            <input type="checkbox" name="six-persons" id="six-persons">

            <input type="checkbox" name="eigth-or-more" id="eigth-or-more">
        </form>
    </div>

    <div class="content-aanbod">
    <h2>Ons aanbod</h2>
    <div class="cars">
        <?php include "fetchcars.php" ?>
    </div>

    <div class="pagination">
        <?php
        $select_user = $conn->prepare ("SELECT car_id FROM cars");
        $select_user->execute();

        $car_info = $select_user->fetchAll(PDO::FETCH_ASSOC);
        $amount_id = count($car_info) / $perPage;
        for ($i = 0; $i <= $amount_id; $i++) :?>
        <button class="pagination-button" data-page="<?php echo $i + 1 ?>"><?php echo $i + 1 ?></button>
        <!-- etc -->
//        <?php endfor;?>
    </div>
    </div>
</main>
<?php require "includes/footer.php" ?>

