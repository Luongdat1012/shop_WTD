<?php $this->fileLayout = "LayoutTrangChu.php" ?>
<main class="main">
    <div class="main_title">
        <h2>
            <a href="#">Sản phẩm nổi bật</a>
        </h2>
    </div>

    <div class="main_product">
        <?php
        $hotProduct = $this->modelHotProduct();
        foreach ($hotProduct as $rows) :
        ?>
            <div class="product">
                <?php if ($rows->discount > 0) : ?>
                    <div class="sale">
                        <span>-<?php echo $rows->discount; ?>%</span>
                    </div>
                <?php endif; ?>
                <div class="wish_list">
                    <a href="index.php?controller=wishlist&action=create&id=<?php echo $rows->id; ?>">
                        <span>
                            <i class="fas fa-plus-square"></i>
                        </span>
                    </a>
                </div>
                <a href="index.php?controller=products&action=detail&id=<?php echo $rows->id; ?>">
                    <img class="product_img_fisrt" src="./assets/upload/products/<?php echo $rows->photo; ?>" alt="" />
                    <img class="product_img_last" src="./assets/upload/products/<?php echo $rows->photo; ?>" alt="" />
                    <p class="product_name"><?php echo $rows->name; ?>'</p>
                </a>
                <div class="product_price_flex">
                    <div class="product_price">
                        <span><?php echo number_format($rows->price - ($rows->price * $rows->discount) / 100); ?>
                            <span>đ</span>
                        </span>
                    </div>
                    <div class="product_price_goc">
                        <span><?php echo number_format($rows->price); ?> <span>đ</span></span>
                    </div>
                </div>
                
                <p class="product_name">
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=1"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=2"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=3"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=4"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=5"><i class="fas fa-star"></i></a>
                </p>
                <a href="index.php?controller=cart&action=create&id=<?php echo $rows->id ?>"><button class="btn_detail">Giỏ hàng</button></a>

            </div>
        <?php endforeach; ?>
    </div>

    <div class="main_title">
        <h2>
            <a href="#">Sản phẩm mới</a>
        </h2>
    </div>
    <div class="main_product">
        <?php
        $hotProduct = $this->modelGetNewProduct();
        foreach ($hotProduct as $rows) :
        ?>
            <div class="product">
                <div class="sale">
                    <span>-<?php echo $rows->discount; ?>%</span>
                </div>
                <a href="ProductDetail.html">
                    <img class="product_img_fisrt" src="./assets/upload/products/<?php echo $rows->photo; ?>" alt="" />
                    <img class="product_img_last" src="./assets/upload/products/<?php echo $rows->photo; ?>" alt="" />
                    <p class="product_name"><?php echo $rows->name; ?>'</p>
                </a>
                <div class="product_price_flex">
                    <div class="product_price">
                        <span><?php echo number_format($rows->price - ($rows->price * $rows->discount) / 100); ?>
                            <span>đ</span>
                        </span>
                    </div>
                    <div class="product_price_goc">
                        <span><?php echo number_format($rows->price); ?> <span>đ</span></span>
                    </div>
                </div>
                <p class="product_name">
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=1"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=2"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=3"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=4"><i class="fas fa-star"></i></a>
                    <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=5"><i class="fas fa-star"></i></a>
                </p>
                <a href="index.php?controller=cart&action=create&id=<?php echo $rows->id ?>"><button class="btn_detail">Giỏ hàng</button></a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="main_title">
        <h2>
            <a href="#">Tin tức</a>
        </h2>
    </div>

    <div class="main_TinTuc">
        <?php
        $news = $this->modelHotNews();
        foreach ($news as $rows) :
        ?>
            <div class="TinTuc">
                <a href="index.php?controller=new&action=detail&id=<?php echo $rows->id ?>">
                    <img src="./assets/upload/news/<?php echo $rows->photo ?>" alt="" />
                    <p class="TinTuc_name">
                        <?php echo $rows->name; ?>
                    </p>
                    <div class="TinTuc_desc">
                        <?php echo $rows->description; ?>
                    </div>
                </a>

                <div class="TinTuc_more">
                    <a href="index.php?controller=new&action=detail&id=<?php echo $rows->id ?>">
                        <span>xem thêm </span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</main>