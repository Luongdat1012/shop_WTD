<?php
//Load file layout vao day
$this->fileLayout = "LayoutTrangTrong.php"
?>
<div class="main_product_list">
        <?php
        foreach ($data as $rows) :
        ?>
            <div class="product" id="ajax">
                <div class="sale">
                    <span>-<?php echo $rows->discount; ?>%</span>
                </div>
                <a href="index.php?controller=products&action=detail&id=<?php echo $rows->id; ?>">
                    <img class="product_img_fisrt" src="./assets/upload/products/<?php echo $rows->photo; ?>" alt="" />
                    <img class="product_img_last" src="./assets/upload/products/<?php echo $rows->photo; ?>" alt="" />
                    <p class="product_name"><?php echo $rows->name; ?></p>
                </a>
                <div class="product_price_flex">
                    <div class="product_price">
                        <span><?php echo number_format($rows->price - ($rows->price * $rows->discount) / 100); ?>
                            <span>đ</span>
                        </span>
                    </div>
                    <div class="product_price_goc">
                        <span><?php echo number_format($rows->price); ?><span>đ</span></span>
                    </div>
                </div>
                <p class="product_name">
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=1"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=2"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=3"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=4"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=5"><i class="fas fa-star"></i></a>
                </p>
                <a href="./ProductDetail.html"><button class="btn_detail">Xem chi tiết</button></a>
            </div>
        <?php endforeach; ?>

    </div>

    