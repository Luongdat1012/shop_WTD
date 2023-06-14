<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/frontend/Css/index.css" />
    <link rel="stylesheet" href="./assets/frontend/Css/Cart.css">
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>SHOP</title>
</head>

<body>
    <?php include_once "HeaderView.php"; ?>
    <section class="selection">
        <div class="selection_product" style="height: 20px;">
            <a href="index.php">
                <i class="fas fa-home"></i>
                <span" style="padding: 0 5px; font-weight: 0;">Trang chủ</span>
            </a>
            <i class="fas fa-chevron-right" style="font-size: 13px; font-weight: normal; padding: 0 5px;"></i>
            <span style="font-weight: bold;">
                Giỏ hàng
            </span>
        </div>
    </section>
    <main class="cart_main">
        <form action="index.php?controller=cart&action=update" method="post">
            <div class="cart-thead">
                <div style="width: 19%;">Sản phẩm</div>
                <div style="width: 28%;">Thông tin sản phẩm</div>
                <div style="width: 17%;">Đơn giá</div>
                <div style="width: 18%;">Số lượng</div>
                <div style="width: 13%;">Thành tiền</div>
                <div style="width: 5%;">Xóa</div>
            </div>
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) : ?>
                <?php foreach ($_SESSION['cart'] as $data) :
                    foreach ($data as $rows) :
                ?>
                        <div class="cart_product_round">
                            <div class="cart_product ">
                                <div class="cart_product_img" style="width: 19%;">
                                    <a href="./ProductDetail.html">
                                        <img src="./assets/upload/products/<?php echo $rows['photo'] ?>" alt="">
                                    </a>
                                </div>
                                <div class="cart_product_name" style="width: 28%;">
                                    <a href=""><?php echo $rows['name'] ?></a>
                                    <span style="display: block; color: red; padding-top: 10px ;">(<?php echo $rows['size'] ?>)</span>
                                </div>
                                <div class="cart_product_price" style="width: 17%;">
                                    <span><?php echo number_format($rows["price"] - ($rows["price"] * $rows["discount"]) / 100); ?> <span>đ</span> </span>
                                </div>
                                <div class="cart_product_number" style="width: 18%;">

                                    <input type="number" min="1" value="<?php echo $rows['number']; ?>" name="product_<?php echo $rows['id']; ?>_<?php echo $rows['size'] ?>">
                                </div>
                                <div class="cart_product_total" style="width: 13%;">
                                    <span><?php echo number_format(($rows["price"] - ($rows["price"] * $rows["discount"]) / 100) * $rows['number'])  ?> <span>đ</span> </span>
                                </div>
                                <div class="cart_product_delete" style="width: 5%;">
                                    <a href="index.php?controller=cart&action=delete&id=<?php echo $rows["id"]; ?>&size=<?php echo $rows['size'] ?>" onclick="return window.confirm('Ban co muon xoa san pham <?php echo $rows['name'] ?> ?')">
                                        <button type="button">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php if ($this->cartNumber() > 0) : ?>
                    <button class="Pay_back" type="submit">
                        <span>Cập nhật</span>
                    </button>
                <?php endif; ?>
            <?php else : ?>
                <h3 style="text-align: center;">Chưa có sản phẩm nào trong giỏ hàng</h3>
                <a href="index.php" style="display:block; padding: 10px 15px; background: #ccc; border: 1px solid #ccc; width: 150px; margin: auto; text-align: center; font-weight: bold;">Tiếp tục mua hàng</a>
            <?php endif ?>


        </form>
    </main>
    <?php if ($this->cartNumber() > 0) : ?>
        <div class="Pay">
            <div class="Pay_total">
                <span>Tổng tiền:</span>

                <span class="Pay_total_price"><?php echo number_format($this->cartTotal()); ?> <span>đ</span> </span>

            </div>
            <div class="Pay_submit">
                <a href="index.php">
                    <button class="Pay_back">
                        <span>Tiếp tục mua hàng</span>
                    </button>
                </a>

                <a href="index.php?controller=cart&action=destroy" onclick="return window.confirm('Ban co muon xoa toan bo san pham ?')">
                    <button class="Pay_back">
                        <span>Xóa toàn bộ</span>
                    </button>
                </a>

                <a href="index.php?controller=checkOut">
                    <button class="Pay_continue">
                        <span>Tiến hành đặt hàng</span>
                    </button>
                </a>
            </div>
        </div>
    <?php endif; ?>
    <?php include_once "FooterView.php" ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./assets/frontend/Js/slick.js"></script>