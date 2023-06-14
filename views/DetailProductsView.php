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
        <a href="#">
          <?php
          $category = $this->modelGetCategory($record->category_id);
          ?>
          <span>
            <?php echo $category->name; ?>
          </span>
        </a>

        <i class="fas fa-chevron-right" style="font-size: 13px; font-weight: normal; padding: 0 5px;"></i>
        <span style="font-weight: bold;"><?php echo $record->name ?></span>
      </div>
    </section>

    <main>
      <div class="product_info">
        <div class="product_img">
          <div class="image_main">
            <img width="auto" height="400px" src="./assets/upload/products/<?php echo $record->photo; ?>" style="margin: auto; display: block;">
          </div>

          <div class="img_child">
            <?php foreach ($sub_photo as $rows) : ?>
              <img width="100%" height="150px" src="./assets/upload/products/<?php echo $rows->photo; ?>" alt="">
            <?php endforeach; ?>
          </div>

        </div>

        <div class="product_desc">
          <div class="product_desc_content">
            <h1><?php echo $record->name ?></h1>
            <div class="product_price">
              <span class="product_price_cost"><?php echo number_format($record->price - ($record->price * $record->discount) / 100); ?> <span>đ</span></span>
              <span class="product_price_sale"><?php echo number_format($record->price); ?> <span>đ</span></span>
            </div>
            <div class="product_desc_info">
              <ul>
                <li>- Chất lượng Rep 1:1 chuẩn 98% chỉ có Wtd Shoes</li>
                <li>- Đi đúng size</li>
                <li>- Vận chuyển toàn quốc [ Kiểm Tra Hàng Trước Khi Thanh Toán ] </li>
                <li>- 100% Ảnh chụp trực tiếp tại Wtd Shoes</li>
                <li>- Bảo Hành Trọn Đời Sản Phẩm</li>
                <li>- Đổi Trả 7 Ngày Không Kể Lí Do </li>
                <li>- Liên Hệ : 082.939.2000</li>
              </ul>
            </div>

            <div class="product_desc-size">
              <p>Kích thước:</p>
              <div class="size_flex">
                <?php foreach ($product_size as $rows) : ?>
                  <?php $size_quantily = $this->modelGetQuantilySize($record->id, $rows->size)  ?>
                  <?php
                  /* echo '<pre>';
              print_r($size_quantily) ;
              echo '</pre>'; */
                  ?>
                  <div class="size">
                    <input type="radio" <?php if ($size_quantily->quantily == 0 && $size_quantily->size = $rows->size) : ?> disabled <?php endif; ?> name="size" id="<?php echo $rows->size ?>" value="<?php echo $rows->size ?>" class="size_shose">
                    <label class="demo_alo" <?php if ($size_quantily->quantily == 0) : ?> style="color: grey;" <?php endif; ?> for="<?php echo $rows->size ?>"><?php echo $rows->size ?></label>
                  </div>

                <?php endforeach; ?>
                <!-- <button onclick="llll()">dmeo</button> -->
                <script>
                  $(document).ready(function() {
                    $(".size_shose").click(function(e) {
                      var demo = document.getElementsByName("size");                      
                      var size = "";
                      for (var i = 0; i < demo.length; i++) {
                        if (demo[i].checked == true) {
                          size = demo[i].value;
                        }
                      }
                      $("#link_moi").attr('href', 'index.php?controller=checkOut&action=checkOutProduct&id=<?php echo $record->id ?>&size=' + size);
                      $("#add_cart").attr('href', 'index.php?controller=cart&action=create&id=<?php echo isset($_GET['id']) ? $_GET['id'] : 1 ?>&size=' + size);

                    });
                  });
                </script>
              </div>
            </div>
          </div>

          <div class="thanhtoan">
            <div class="themgiohang"><a id="add_cart" href="index.php?controller=cart&action=create&id=<?php echo isset($_GET['id']) ? $_GET['id'] : 1 ?>"><button type="button">Thêm giỏ hàng</button></a></div>
            <div class="muangay"><a href="index.php?controller=checkOut&action=checkOutProduct&id=<?php echo $record->id ?>" id="link_moi"><button type="button">Mua ngay</button></a></div>

          </div>
          <div class="vote" style="border: 1px solid #ccc;">
            <table>
              <tr>
                <td>Rating</td>
                <td></td>
              </tr>
              <tr>
                <td style="width: 90%;">
                  <i class="fas fa-star"></i>
                </td>
                <td><?php echo $this->modelGetStar($record->id, 1); ?> vote</td>
              </tr>
              <tr>
                <td style="width: 90%;">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </td>
                <td><?php echo $this->modelGetStar($record->id, 2); ?> vote</td>
              </tr>
              <tr>
                <td style="width: 90%;">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </td>
                <td><?php echo $this->modelGetStar($record->id, 3); ?> vote</td>
              </tr>
              <tr>
                <td style="width: 90%;">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </td>
                <td><?php echo $this->modelGetStar($record->id, 4); ?> vote</td>
              </tr>
              <tr>
                <td style="width: 90%;">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </td>
                <td><?php echo $this->modelGetStar($record->id, 5); ?> vote</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </main>

    <?php include_once "FooterView.php" ?>

    <!-- Xử lý thông báo -->

    <?php if (isset($_GET['notify']) && $_GET['notify'] == "rating_err") : ?>
      <script>
        var rate = confirm("Vui lòng mua và thanh toán sản phẩm <?php echo $record->name ?> để được đánh giá");
        if (rate == true) {
          location.href = 'index.php?controller=products&action=detail&id=<?php echo $record->id ?>';
        } else {
          history.back();
        }
      </script>
    <?php endif; ?>
  </body>