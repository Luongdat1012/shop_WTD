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
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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


    <?php include_once "HeaderView.php"; ?>
    <?php include_once "BannerView.php"; ?>

    <?php echo $this->view; ?>

    <?php include_once "FooterView.php" ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./assets/frontend/Js/slick.js"></script>

</html>

<?php if (isset($_GET['notify']) && $_GET['notify'] == "login_success") : ?>
    <script>
        alert("Đăng nhập thành công");
        location.href = 'index.php';
    </script>
<?php endif; ?>

<?php if (isset($_GET['notify']) && $_GET['notify'] == "success_checkout") : ?>
    <script>
        alert("Cảm ơn bạn đã đặt hàng của WTD");
        location.href = 'index.php';
    </script>
<?php endif; ?>

<?php if (isset($_GET['notify']) && $_GET['notify'] == "login_success") : ?>
    <script>
        alert("Đăng nhập thành công");
        location.href = 'index.php';
    </script>
<?php endif; ?>

<?php if (isset($_GET['notify_confirm']) && $_GET['notify_confirm'] == "login") : ?>
    <script>
        var result = confirm("Bạn phải đăng nhập để tiếp tục thực hiện");
        if (result == true) {
            location.href = 'index.php?controller=account&action=login';
        } else {
            history.back();
        }
    </script>
<?php endif ?>

<?php if (isset($_GET['notify']) && $_GET['notify'] == "register_success") : ?>
    <script>
        alert("Đăng ký thành công");
        location.href = 'index.php?controller=account&action=login';
    </script>
<?php endif; ?>