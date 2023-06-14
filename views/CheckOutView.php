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
    <link rel="stylesheet" href="./assets/frontend/Css/CheckOut.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Shop</title>
</head>

<body>
    <form action="index.php?controller=checkout&action=<?php if (isset($_GET['action']) && $_GET['action'] == 'checkOutProduct') : ?>thanhToanDonHang<?php else : ?>inhoadon<?php endif; ?>" method="post">
        <main class="main">
            <div class="checkout_info">
                <div class="logo">
                    <a href="index.php">
                        <img src="assets/frontend/Image/Logo_shop.png" width="auto" height="100px " alt="" srcset=""/>
                    </a>
                </div>
                <div class="check_out_flex">
                    <div class="checkout_info_left">
                        <div class="left_title">
                            <h1>Thông tin nhận hàng</h1>
                            <a href="index.php?controller=checkOut&action=login">
                                <i class="fas fa-users"></i>
                                <span><?php echo $data->name ?></span>
                            </a>
                        </div>

                        <div class="left_info_data">
                            <div class="form_field">
                                <input class="form_input" type="text" name="name" id="name" placeholder=" " value="<?php echo $data->name ?>" />
                                <label class="form_label" for="name">Họ và tên</label>
                            </div>
                            <div class="form_field">
                                <input class="form_input" type="text" name="email" id="email" placeholder=" " value="<?php echo $data->email ?>" />
                                <label class="form_label" for="email">Email</label>
                            </div>
                            <div class="form_field">
                                <input class="form_input" type="text" name="phone" id="phone" placeholder=" " value="<?php echo $data->phone ?>" />
                                <label class="form_label" for="phone">Số điện thoại</label>
                            </div>
                            <div class="form_field">
                                <input class="form_input" type="text" name="address" id="address" placeholder=" " value="<?php echo $data->address ?>" />
                                <label class="form_label" for="address">Địa chỉ</label>
                            </div>
                            <div class="form_field">
                                <textarea class="form_input" name="note" id="note" cols="30" rows="10" placeholder=" "></textarea>
                                <label class="form_label" for="note">Ghi chú</label>
                            </div>

                            <?php

                            $provinceCustomers = $this->modelGetProvinceUser($data->provinceid);
                            $districtCustomers = $this->modelGetDistrictUser($data->districtid);
                            $wardCustomers = $this->modelGetWardUser($data->wardid);
                            $villageCustomers = $this->modelGetVillageUser($data->villageid);

                            ?>

                            <div class="selec" style="padding: 5px 0;">
                                <label for="provice">Tỉnh</label> <br>
                                <select name="provice" id="province" style="width: 100%; font-size: 16px;">
                                    <?php if (isset($data->provinceid) && !empty($data->provinceid)) : ?>
                                        <option value="<?php echo $data->provinceid ?>"><?php echo $provinceCustomers->name ?></option>
                                    <?php else : ?>
                                        <option value="">---Chọn tỉnh---</option>
                                    <?php endif; ?>
                                    <?php foreach ($province as $rows)
                                        echo '<option value="' . $rows->provinceid . '">' . $rows->name . '</option>'
                                    ?>
                                </select>
                            </div>
                            <div class="selec" style="padding: 5px 0;">
                                <label for="district">Quận/ Huyện</label> <br>
                                <select name="district" id="district" style="width: 100%; font-size: 16px;">
                                    <?php if (!empty($data->districtid)) : ?>

                                        <option value="<?php echo $data->districtid ?>"><?php echo $districtCustomers->name ?></option>
                                    <?php else : ?>
                                        <option value="">---Chưa chọn tỉnh---</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="selec" style="padding: 5px 0;">
                                <label for="ward">Phường/ Xã</label> <br>
                                <select name="ward" id="ward" style="width: 100%; font-size: 16px;">
                                    <?php if (!empty($data->wardid)) : ?>
                                        <option value="<?php echo $data->wardid ?>"><?php echo $wardCustomers->name ?></option>
                                    <?php else : ?>
                                        <option value="">---Chưa chọn Quận/ Huyện---</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="selec" style="padding: 5px 0;">
                                <label for="village">Thôn làng</label> <br>
                                <select name="village" id="village" style="width: 100%; font-size: 16px;">
                                    <?php if (!empty($data->villageid)) : ?>
                                        <option value="<?php echo $data->villageid ?>"><?php echo $villageCustomers->name ?></option>
                                    <?php else : ?>
                                        <option value="">---Chưa chọn Phường/ Xã---</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <!-- Script Ajax load địa chỉ -->
                            <script>
                                $(document).ready(function($) {
                                    $("#province").change(function(event) {
                                        provinceid = $("#province").val();
                                        $.get('index.php?controller=checkOut&action=ajaxSearchDistrict&provinceid=' + provinceid, function(data) {
                                            $("#district").html(data);
                                        });
                                    });
                                    $("#district").change(function(event) {
                                        districtid = $("#district").val();
                                        $.get('index.php?controller=checkOut&action=ajaxSearchWard&districtid=' + districtid, function(data) {
                                            $("#ward").html(data);
                                        });
                                    });
                                    $("#ward").change(function(event) {
                                        ward = $("#ward").val();
                                        $.get('index.php?controller=checkOut&action=ajaxSearchVillage&wardid=' + ward, function(data) {
                                            $("#village").html(data);
                                        });
                                    });
                                });
                            </script>

                        </div>


                    </div>
                    <div class="checkout_info_right">
                        <h1>Vận chuyển</h1>
                        <div class="vanchuyen_info">
                            <span>Vui lòng nhập thông tin giao hàng</span>
                        </div>
                        <div class="ThanhToan">
                            <h1>Thanh toán</h1>
                            <div class="Pay_select">
                                <input type="radio" id="radio_label" />
                                <label for="radio_label">
                                    <span>Thanh toán khi giao hàng (COD)</span>
                                    <i class="fas fa-money-bill-alt"></i>
                                    <p>Bạn chỉ phải thanh toán khi nhận được hàng</p>
                                </label>

                                <!-- <div class="hienthi">
                    
                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($_GET['action']) && $_GET['action'] == 'checkOutProduct') : ?>
                <div class="checkout_order" style="width: 40%">
                    <h1>Đơn hàng (<span> 1 sản phẩm</span>)</h1>
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 20%">
                                <img src="./assets/upload/products/<?php echo $product->photo ?>" height="100px" alt="" />
                            </td>
                            <td style="width: 60%">
                                <span class="name_shose">
                                    <input type="hidden" name="product_id" value="<?php echo $product->id ?>">

                                    <?php echo $product->name ?>
                                    <span class="size_shose">x1 </span>
                                </span>
                                <span class="size_shose" style="display: block;"> Size: <?php echo $size ?> </span>
                            </td>
                            <td style="width: 20%">
                                <span class="price_shose"> <?php echo number_format($product->price - ($product->price * $product->discount) / 100) ?> <span>đ</span></span>
                            </td>
                        </tr>
                    </table>

                    <div class="sale">
                        <div class="form_field">
                            <input class="form_input" type="text" id="sale" placeholder=" " />
                            <label class="form_label" for="sale">Nhập mã giảm giá</label>
                        </div>
                        <button class="btn_submit_sale" type="button">Áp dụng</button>
                    </div>

                    <table class="TamTinh" style="width: 100%">

                        <tr style="width: 50%; height: 55px">
                            <td style="text-align: left">Tạm tính</td>
                            <td style="text-align: right"><?php echo number_format($product->price - ($product->price * $product->discount) / 100) ?> <span style="text-decoration: underline;">đ</span></td>
                        </tr>

                        <tr style="width: 50%; height: 25px">
                            <td style="text-align: left">Phí vận chuyển</td>
                            <td style="text-align: right">30.000 đ</td>
                        </tr>
                    </table>

                    <div class="total">
                        <span class="total_left"> Tổng cộng </span>
                        <input type="hidden" name="price" value="<?php echo ($product->price - ($product->price * $product->discount) / 100) ?>">
                        <span class="total_right"> <?php echo number_format(($product->price - ($product->price * $product->discount) / 100) + 30000) ?> <span style="text-decoration: underline;">đ</span> </span>

                    </div>

                    <div class="btn_submit_total">
                        <button type="submit">
                            <span>Thanh toán</span>
                        </button>

                    </div>
                </div>
            <?php else : ?>
                <div class="checkout_order" style="width: 40%">

                    <h1>Đơn hàng (<span> <?php echo $this->cartNumber() ?> sản phẩm</span>)</h1>
                    <?php foreach ($_SESSION['cart'] as $product) : ?>
                        <?php foreach ($product as $rows) : ?>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 20%">
                                        <img src="./assets/upload/products/<?php echo $rows['photo'] ?>" height="100px" alt="" />
                                    </td>
                                    <td style="width: 60%">
                                        <span class="name_shose">
                                            <?php echo $rows['name'] ?>
                                            <span class="size_shose"><?php if ($rows['number'] > 1) echo 'x' . $rows['number']  ?> </span>
                                        </span>
                                        <span class="size_shose"> <?php echo $rows['size'] ?> </span>
                                    </td>
                                    <td style="width: 20%">
                                        <span class="price_shose"> <?php echo number_format(($rows["price"] - ($rows["price"] * $rows["discount"]) / 100) * $rows['number']) ?> <span>đ</span></span>
                                    </td>
                                </tr>
                            </table>

                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <div class="sale">
                        <div class="form_field">
                            <input class="form_input" type="text" id="sale" placeholder=" " />
                            <label class="form_label" for="sale">Nhập mã giảm giá</label>
                        </div>
                        <button class="btn_submit_sale" type="button">Áp dụng</button>
                    </div>

                    <table class="TamTinh" style="width: 100%">

                        <tr style="width: 50%; height: 55px">
                            <td style="text-align: left">Tạm tính</td>
                            <td style="text-align: right"><?php echo number_format($this->cartTotal()); ?> <span style="text-decoration: underline;">đ</span></td>
                        </tr>

                        <tr style="width: 50%; height: 25px">
                            <td style="text-align: left">Phí vận chuyển</td>
                            <td style="text-align: right">30.000 đ</td>
                        </tr>
                    </table>

                    <div class="total">
                        <span class="total_left"> Tổng cộng </span>

                        <span class="total_right"> <?php echo number_format($this->cartTotal() + 30000); ?> <span style="text-decoration: underline;">đ</span> </span>

                    </div>

                    <div class="btn_submit_total">
                        <button type="submit">
                            <span>Thanh toán</span>
                        </button>

                    </div>
                </div>
            <?php endif; ?>
        </main>
    </form>
</body>

</html>
