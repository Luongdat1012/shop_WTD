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
  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/61dd4f8af7cf527e84d182a0/1fp47tduf';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
  <!--End of Tawk.to Script-->


  <?php include "HeaderView.php" ?>

  <section class="selection">
    <div class="selection_product" style="height: 20px;">
      <a href="index.php">
        <i class="fas fa-home"></i>
        <span" style="padding: 0 5px; font-weight: 0;">Trang chủ</span>
      </a>
      <i class="fas fa-chevron-right" style="font-size: 13px; font-weight: normal; padding: 0 5px;"></i>
      <span style="font-weight: bold;">
        <?php if (isset($_GET["id"])) : ?>
          <?php $category = $this->modelGetCategory($_GET["id"]);
          echo $category->name;
          ?>
        <?php endif; ?>
      </span>
    </div>
  </section>

  <main class="main">
    <!-- Phần thông tin tìm kiếm -->
    <div class="main_info">
      <h2>theo size giày</h2>

      <div class="main_info_content">
        <ul>
          <li>
            <input type="checkbox" name="size" value="36" class="main_info_list demo" id="list_size_36">
            <label for="list_size_36">36</label>
          </li>
          <li>
            <input type="checkbox" name="size" value="37" class="main_info_list demo" id="list_size_37">
            <label for="list_size_37">37</label>
          </li>
          <li>
            <input type="checkbox" name="size" value="38" class="main_info_list" id="list_size_38">
            <label for="list_size_38">38</label>
          </li>
          <li>
            <input type="checkbox" name="size" value="39" class="main_info_list" id="list_size_39">
            <label for="list_size_39">39</label>
          </li>
          <li>
            <input type="checkbox" name="size" value="40" class="main_info_list" id="list_size_40">
            <label for="list_size_40">40</label>
          </li>
          <li>
            <input type="checkbox" name="size" value="41" class="main_info_list" id="list_size_41">
            <label for="list_size_41">41</label>
          </li>
          <li>
            <input type="checkbox" name="size" value="42" class="main_info_list" id="list_size_42">
            <label for="list_size_42">42</label>
          </li>
          <li>
            <input type="checkbox" name="size" value="43" class="main_info_list" id="list_size_43">
            <label for="list_size_43">43</label>
          </li>
          <li>
            <input type="checkbox" name="size" value="44" class="main_info_list" id="list_size_44">
            <label for="list_size_44">44</label>
          </li>
        </ul>
      </div>


      <h2>theo loại</h2>
      <div class="main_info_content">
        <ul>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_nike">
            <label for="list_nike">Nike</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_Balenciaga_Speed_2017">
            <label for="list_Balenciaga_Speed_2017">list Balenciaga Speed 2017</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_Gucci">
            <label for="list_Gucci">Gucci</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_Adidas">
            <label for="list_Adidas">Adidas</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_Puma">
            <label for="list_Puma">Puma</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_size_41">
            <label for="list_size_41">41</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_size_42">
            <label for="list_size_42">42</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_size_43">
            <label for="list_size_43">43</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_size_44">
            <label for="list_size_44">44</label>
          </li>
        </ul>

      </div>

      <h2>sale</h2>
      <div class="main_info_content">
        <ul>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_sale_10">
            <label for="list_sale_10">Giảm 10%</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_sale_15">
            <label for="list_sale_15">Giảm 15%</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_sale_20">
            <label for="list_sale_20">Giảm 20%</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_sale_30">
            <label for="list_sale_30">Giảm 30%</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_sale_40">
            <label for="list_sale_40">Giảm 40%</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_sale_50">
            <label for="list_sale_50">Giảm 50%</label>
          </li>
          <li>
            <input type="checkbox" name="" class="main_info_list" id="list_sale_60">
            <label for="list_sale_60">Giảm 60%</label>
          </li>
        </ul>

      </div>

      <h2>Tìm kiếm theo giá</h2>

      <div class="form_field">
        <input class="form_input" type="number" min="0" value="0" id="fromPrice" name="fromPrice" placeholder=" " />
        <label class="form_label" for="fromPrice">Giá nhỏ nhất</label>
      </div>

      <div class="form_field">
        <input class="form_input" type="number" min="0" value="0" id="toPrice" name="fromPrice" placeholder=" " />
        <label class="form_label" for="fromPrice">Giá lớn nhất</label>
      </div>
      <input type="button" class="btn_search_price" value="Tìm mức giá" onclick="location.href = 'index.php?controller=search&action=price&fromPrice=' + document.getElementById('fromPrice').value + '&toPrice=' + document.getElementById('toPrice').value;" />

    </div>
    <!-- Kết thúc thông tin tìm kiếm -->
    <!-- Phần thông tin hiển thị -->
    <div class="main_product">
      <div class="main_view">

        <div class="main_product_view">
          <button><i class="fa fa-th"></i></button>
          <button><i class="fa fa-bars"></i></button>
          <span><?php if ($this->modelTotalRecord() > 0) : ?>Hiển thị 1 - <?php if ($recordPerPage < $this->modelTotalRecord()) : echo $recordPerPage ?><?php else : echo $this->modelTotalRecord();
                                                                                                                                                      endif; ?> trong tổng số <?php endif; ?><span><?php echo $this->modelTotalRecord(); ?></span> sản phẩm</span>
        </div>
        <div class="main_product_sort">
          <span>Sắp xếp theo:</span>
          <ul class="sort_by">
            <li>
              <span><?php
                    $order = isset($_GET["order"]) ? $_GET["order"] : "";
                    switch ($order) {
                      case 'priceAsc':
                        echo "Giá tăng dần";
                        break;
                      case 'priceDesc':
                        echo "Giá giảm dần";
                        break;
                      case 'nameAsc':
                        echo "A → Z";
                        break;
                      case 'nameAsc':
                        echo "Z → A";
                        break;
                      default:
                        echo "Mặc định";
                    }
                    ?></span>
              <i class="fas fa-chevron-down"></i>
              <ul class="sort_by_child">
                <li><a href="index.php?controller=products&action=category&id=<?php echo $_GET['id']; ?>&order">Mặc định</a></li>
                <li><a href="index.php?controller=products&action=category&id=<?php echo $_GET['id']; ?>&order=nameAsc">A → Z</a></li>
                <li><a href="index.php?controller=products&action=category&id=<?php echo $_GET['id']; ?>&order=nameDesc">Z → A</a></li>
                <li><a href="index.php?controller=products&action=category&id=<?php echo $_GET['id']; ?>&order=priceAsc">Giá tăng dần</a></li>
                <li><a href="index.php?controller=products&action=category&id=<?php echo $_GET['id']; ?>&order=priceDesc">Giá giảm dần</a></li>

              </ul>
            </li>

          </ul>
        </div>
      </div>

      <?php echo $this->view; ?>


      <div class="page">
        <ul>
          <li>
            <a href="">
              << </a>
          </li>
          <?php for ($i = 1; $i <= $numPage; $i++) : ?>
            <li><a href="index.php?controller=products&action=category&p=<?php echo $i; ?>&id=<?php echo $_GET['id'] ?>"><?php echo $i; ?></a></li>
          <?php endfor; ?>
          <li>
            <a href="">>></a>
          </li>
        </ul>

      </div>
    </div>
    <!-- Phần kết thúc thông tin hiển thị -->

  </main>


  <?php include_once "FooterView.php" ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./assets/frontend/Js/slick.js"></script>
  <script>
    $(document).ready(function() {
      $(".main_info_list").change(function(event) {
        var checkbox = document.getElementsByName('size');
        result = Array();
        
        // Lặp qua từng checkbox để lấy giá trị
        for (var i = 0; i < checkbox.length; i++) {
          if (checkbox[i].checked === true) {
            result.unshift(checkbox[i].value);
          }
        }
        
        $.post("index.php?controller=products&action=demo&id=<?php echo $_GET['id'] ?>", {
            size: result
          },
          function(data) {
            $(".main_product_list").html(data);
          }
        );
      })
    });
  </script>
</body>

</html>