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
  <main class="Login_main">
    <h2>
      Đăng nhập tài khoản
    </h2>
    <div class="main_Login">

      <span>
        Nếu bạn đã có tài khoản, thì đăng nhập tại đây.
      </span>
      <form action="index.php?controller=account&action=loginPost" method="post">
        <h3>Email<span>*</span></h3>
        <div class="form_field">
          <input class="form_input" type="text" id="email" name="email" placeholder=" " />
          <label class="form_label" for="email">Email</label>
        </div>

        <h3>Mật khẩu<span>*</span></h3>
        <div class="form_field">
          <input class="form_input" type="password" id="password" name="password" placeholder=" " />
          <label class="form_label" for="pasword">Mật khẩu</label>
        </div>

        <div class="btn_signup">
          <button type="submit" class="btn_Login">
            <span>Đăng nhập</span>
          </button>
      </form>
      <a href="index.php?controller=account&action=register">Đăng ký</a>
    </div>
    </div>

    <div class="main_Forget">
      <span>Bạn quên mật khẩu? Nhập địa chỉ email để lấy lại mật khẩu qua email.</span>
      <h3>Email<span>*</span></h3>
      <div class="form_field">
        <input class="form_input" type="text" id="forget_email" placeholder=" " />
        <label class="form_label" for="forget_email">Email</label>
      </div>
      <div class="btn_forget">
        <button type="button" class="btn_forget_password">
          <span>Lấy lại mật khẩu</span>
        </button>
      </div>
    </div>
  </main>
  <?php include_once "FooterView.php" ?>

</body>