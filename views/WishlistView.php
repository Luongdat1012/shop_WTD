<?php
$this->fileLayout = "LayoutTrangTrong.php"
?>

<main class="cart_main">
    <form action="index.php?controller=cart&action=update" method="post">
        <div class="cart-thead">
            <div style="width: 25%;">Sản phẩm</div>
            <div style="width: 25%;">Thông tin sản phẩm</div>
            <div style="width: 25%;">Đơn giá</div>
            <div style="width: 25%;">Xóa</div>
        </div>
        

        <?php foreach ($_SESSION['wishlist'] as $products) : ?>
           
            <div class="cart_product_round">
                <div class="cart_product ">
                    <div class="cart_product_img" style="width: 25%;">
                        <a href="./ProductDetail.html">
                            <img src="./assets/upload/products/<?php echo $products['photo'] ?>" alt="">
                        </a>
                    </div>
                    <div class="cart_product_name" style="width: 25%;">
                        <a href=""><?php echo $products['name'] ?></a>
                        <span style="display: block; color: red; padding-top: 10px ;">(40)</span>
                    </div>
                    <div class="cart_product_price" style="width: 25%;">
                        <span><?php echo number_format($products["price"] - ($products["price"] * $products["discount"]) / 100); ?> <span>đ</span> </span>
                    </div>
                    <div class="cart_product_delete" style="width: 25%;">
                        <a href="index.php?controller=wishlist&action=delete&id=<?php echo $products["id"]; ?>">
                            <button type="button">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </form>
</main>