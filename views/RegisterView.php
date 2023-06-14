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
    <main class="Register_main">
        <h2>Đăng ký tài khoản</h2>
        <?php if (isset($_GET["notify"]) && $_GET["notify"] == 'error') : ?>
            <p style="color: red;">Email đã tồn tại, vui lòng chọn email khác.</p>
        <?php else : ?>
            <span>Nếu chưa có tài khoản vui lòng đăng ký tại đây</span>
        <?php endif; ?>
        <form action="index.php?controller=account&action=registerPost" method="POST">
            <div class="register">
                <h3>Họ và tên<span>*</span></h3>
                <div class="form_field">
                    <input class="form_input" type="text" id="name" name="name" required placeholder=" " />
                    <label class="form_label" for="name">Họ và tên</label>
                </div>

                <h3>Email<span>*</span></h3>
                <div class="form_field">
                    <input class="form_input" type="email" id="email" name="email" required placeholder=" " />
                    <label class="form_label" for="email">Email</label>
                </div>

                <h3>Địa chỉ<span>*</span></h3>
                <div class="form_field">
                    <input class="form_input" type="text" id="address" name="address" required placeholder=" " />
                    <label class="form_label" for="address">Địa chỉ</label>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <h4>Tỉnh/ Thành phố</h4>
                        <select name="provice" id="province" class="form-select">
                            <option value="">---Chọn tỉnh---</option>
                            <?php foreach ($province as $rows)
                                echo '<option value="' . $rows->provinceid . '">' . $rows->name . '</option>'
                            ?>
                        </select>
                    </div>
                    <div class="col-md-5" style=" float: right;">
                        <h4>Quận/ Huyện</h4>
                        <select name="district" id="district" class="form-select">
                            <option value="">---Chưa chọn tỉnh---</option>
                        </select>
                    </div>
                </div>
                <div class="row" style=" padding-top: 10px;">
                    <div class="col-md-5">
                        <h4>Phường/ Xã</h4>
                        <select name="ward" id="ward" class="form-select">
                            <option value="">---Chưa chọn Quận/ Huyện---</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <h4>Tổ/ Thôn</h4>
                        <select name="village" id="village" class="form-select">
                            <option value="">---Chưa chọn Phường/ Xã---</option>
                        </select>
                    </div>
                </div>

                <h3>Số điện thoại<span>*</span></h3>
                <div class="form_field">
                    <input class="form_input" type="number" id="phone" name="phone" required placeholder=" " />
                    <label class="form_label" for="phone">Số điện thoại</label>
                </div>


                <h3>Mật khẩu<span>*</span></h3>
                <div class="form_field">
                    <input class="form_input" type="password" id="email" name="password" required placeholder=" " />
                    <label class="form_label" for="email">Mật khẩu</label>
                </div>

                <div class="btn_register">
                    <button type="submit" class="btn_register_sm">
                        <span>Đăng ký</span>
                    </button>
                    <a href="index.php?controller=account&action=login">Đăng nhập.</a>
                </div>
            </div>
        </form>
    </main>
    <?php include_once "FooterView.php" ?>

</body>

<!-- Script Ajax load địa chỉ -->
<script>
    $(document).ready(function($) {
        $("#province").change(function(event) {
            provinceid = $("#province").val();
            $.get('index.php?controller=account&action=ajaxSearchDistrict&provinceid=' + provinceid, function(data) {
                $("#district").html(data);
            });
        });
        $("#district").change(function(event) {
            districtid = $("#district").val();
            $.get('index.php?controller=account&action=ajaxSearchWard&districtid=' + districtid, function(data) {
                $("#ward").html(data);
            });
        });
        $("#ward").change(function(event) {
            ward = $("#ward").val();
            $.get('index.php?controller=account&action=ajaxSearchVillage&wardid=' + ward, function(data) {
                $("#village").html(data);
            });
        });
    });
</script>