<?php
$conn = Connection::getInstance();
$query = $conn->query("select * from banners where view = 1");
$banners = $query->fetchAll();
?>

<section class="single-item">
    <?php foreach ($banners as $rows) : ?>
        <div class="img1">
            <img src="./assets/upload/banners/<?php echo $rows->photo; ?>" width="100%" alt="" />
        </div>
    <?php endforeach; ?>
</section>