<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

        <link rel="stylesheet" href="./assets/frontend/Css/product detail.css">
        <link rel="stylesheet" href="./assets/frontend/Css/Login.css">
        <link rel="stylesheet" href="./assets/frontend/Css/Register.css">
        <link rel="stylesheet" href="./assets/frontend/Css/Cart.css">
        <link rel="stylesheet" href="./assets/frontend/Css/category.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                        Tin tức
                    </span>
                </div>
            </section>
        <main class="main">
            
            <div class="main_info">
                <h2>Bài viết liên quan</h2>
                <?php foreach ($data as $rows) : ?>
                    <div class="main_info_content">
                        <div class="loop_blog">
                            <div class="thumb-left">
                                <a href="index.php?controller=new&action=detail&id=<?php echo $rows->id ?>">
                                    <img width="100px" height="50px" src="./assets/upload/news/<?php echo $rows->photo ?>" alt="">
                                </a>
                            </div>
                            <div class="name-right">
                                <p>
                                    <?php echo $rows->name ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="main_product" style="margin-top: 50px;">
                <?php foreach ($data as $rows) : ?>
                    <div class="">
                        <div class="" style="display: flex; border-bottom:1px solid #ccc; padding: 20px 0;">
                            <div class="thum_content">
                                <a href="index.php?controller=new&action=detail&id=<?php echo $rows->id ?>">
                                    <img width="100%" height="300px" src="./assets/upload/news/<?php echo $rows->photo ?>" alt="">
                                </a>
                            </div>
                            <div class="thum_right">
                                <h3><?php echo $rows->name ?></h3>
                                <div class="thum_right_content">
                                    <?php echo $rows->description ?>
                                </div>
                                <div class="thum_right_more">
                                    <a href="index.php?controller=new&action=detail&id=<?php echo $rows->id ?>">
                                        Xem thêm
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


                <div class="page">

                    <ul>
                        <li>
                            <a href="">
                                << </a>
                        </li>
                        <li>
                            <a href="">1</a>
                        </li>
                        <li>
                            <a href="">2</a>
                        </li>
                        <li>
                            <a href="">3</a>
                        </li>
                        <li>
                            <a href="">...</a>
                        </li>
                        <li>
                            <a href="">14</a>
                        </li>
                        <li>
                            <a href="">>></a>
                        </li>
                    </ul>

                </div>

        </main>