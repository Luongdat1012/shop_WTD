<style type="text/css">
  .search_ajax {
    position: absolute;
    width: 100%;
    background: white;
    height: 350px;
    overflow: scroll;
    z-index: 1000;
    display: none;
  }

  .search_ajax ul {
    padding: 0px;
    margin: 0px;
    list-style: none;
    float: left;
  }

  .search_ajax ul li {
    border-bottom: 1px solid #dddddd;
    font-size: 13px;
    padding: 10px 0;
    display: flex;
    align-items: center;
    text-align: left;

  }

  .search_ajax ul li a {
    vertical-align: middle;
    display: inline-block;
    font-weight: bold;
  }

  .search_ajax img {
    width: 100px;
    margin-right: 5px;
    display: inline-block;
    vertical-align: middle;
  }

  .header_search input {
    width: 350px;
  }
</style>

<?php
/* echo '<pre>';
  print_r($_SESSION['cart']);
  echo '</pre>'; */

?>

<header class="header">
  <div class="logo_header">
    <a href="index.php">
      <img height="50px" width="auto" src="./assets/frontend/Image/Logo_shop.png" alt="" />
    </a>
  </div>
  <!-- Tìm kiếm -->
  <div class="header_search">
    <input type="text" autocomplete="off" onkeypress="searchForm(event);" value="" placeholder="Nhập từ khóa tìm kiếm..." id="key" class="ip_search">
    <button type="submit" class="btn_search">
      <i class="fas fa-search" onclick="return search();"></i>
    </button>
    <div class="search_ajax">
      <ul>

      </ul>
    </div>

    <!-- Script Tìm kiếm sản phẩm -->
    <script type="text/javascript">
      function search() {
        //Lấy giá trị của id=key;
        var key = document.getElementById("key").value;
        //di chuyển url tìm kiếm
        location.href = 'index.php?controller=search&action=name&key=' + key;
      }
      // Khi ấn phím enter trong ô text box có id=key thì cũng thực hiện tìm kiếm.
      function searchForm(event) {
        if (event.keyCode == 13) {
          //Lấy giá trị của id=key;
          var key = document.getElementById("key").value;
          //di chuyển url tìm kiếm
          location.href = 'index.php?controller=search&action=name&key=' + key;
        }
      }
      //-----------------
      $(".ip_search").keyup(function() {

        var strKey = $("#key").val();
        if (strKey.trim() == "")
          $(".search_ajax").attr("style", "display:none");
        else {
          $(".search_ajax").attr("style", "display:block");
          //---
          //su dung ajax de lay du lieu
          $.get("index.php?controller=search&action=ajaxSearch&key=" + strKey, function(data) {
            //clear cac the li ben trong the ul
            $(".search_ajax ul").empty();
            //them su lieu vua lay duoc bang ajax vao the ul
            $(".search_ajax ul").append(data);
          });
          //---
        }
      });
      //-----------------
    </script>
    <!-- Kết thúc Script Tìm kiếm sản phẩm -->

  </div>
  <!-- kết thúc Tìm kiếm -->
  <div class="header_user">
    <div class="header_accout">
      <a href="#">
        <i class="fas fa-user"></i>
        <?php if (isset($_SESSION["customer_email"])) : ?>
          <span>Xin chào <?php echo $_SESSION["customer_email"] ?></span>
          <div class="account">
            <a href="index.php?controller=account&action=logout">
              <span>Đăng xuất</span>
            </a>
          </div>
        <?php else : ?>
          <span>Tài khoản</span>
          <div class="account">
            <a href="index.php?controller=account&action=login">
              <span>Đăng nhập</span>
            </a>
            <a href="index.php?controller=account&action=register">
              <span>Đăng ký</span>
            </a>
          </div>
        <?php endif; ?>

      </a>
    </div>
    <?php
    $numberProduct = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    ?>
    <div class="header_cart">
      <a href="index.php?controller=cart">
        <div class="cart_icon">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="cart_title"><b>Giỏ hàng</b> <span>(<?php echo $numberProduct; ?>)</span></div>
      </a>

      <div class="cart_info">

        <div class="Cart_product_overflow">
          <?php if (isset($_SESSION['cart'])) : ?>
            <?php foreach ($_SESSION['cart'] as $rows) : ?>
              <?php foreach ($rows as $product) : ?>
                <div class="Cart_product_flex">
                  <div class="cart_product_img">
                    <a href="#">
                      <img src="./assets/upload/products/<?php echo $product['photo'] ?>" height="100px" alt="" />
                    </a>
                  </div>
                  <div class="cart_product_info">
                    <a href="#">
                      <span><?php echo $product['name'] ?></span>
                    </a>
                    <span><?php echo number_format(($product['price'] - ($product['price'] * $product['discount'] / 100)) * $product['number']) ?> đ</span>
                    <div class="number_product">

                      <input type="number" min="1" value="<?php echo $product['number'] ?>" />
                    </div>
                  </div>

                  <div class="cart_product_delete">
                    <a href="index.php?controller=cart&action=delete&id=<?php echo $product['id']; ?>">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <!-- Tổng tiền -->
        <!-- <div class="cart_product_total">
          <span class="left">Tổng cộng</span>
          <span class="right"> đ</span>
        </div> -->

        <div class="btn_submit_cart">
          <a href="index.php?controller=cart"><button class="btn_submit_cart_1">
              <span>Giỏ hàng</span>
            </button></a>
          <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) : ?>
            <a href="index.php?controller=checkOut">
              <button class="btn_submit_cart_2"><span>Thanh toán</span></button>
            </a>
          <?php endif; ?>
        </div>

      </div>

    </div>
  </div>
</header>

<?php
$conn = Connection::getInstance();
$query = $conn->query("select * from categories where parent_id = 0 order by id ASC");
$categories = $query->fetchAll();
?>

<nav class="nav">
  <ul class="menu_product">
    <?php foreach ($categories as $rows) : ?>
      <li class="sub_menu_cha">
        <a href="index.php?controller=products&action=category&id=<?php echo $rows->id; ?>"><?php echo $rows->name; ?></a>
        <ul class="sub_menu">
          <?php
          $querySub = $conn->query("select * from categories where parent_id = {$rows->id} order by id desc");
          $categoriesSub = $querySub->fetchAll();
          ?>
          <?php foreach ($categoriesSub as $rowsSub) : ?>
            <li><a href="index.php?controller=products&action=category&id=<?php echo $rowsSub->id; ?>"><?php echo $rowsSub->name; ?></a></li>
          <?php endforeach; ?>
        </ul>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>