<section class="selection">
    <div class="selection_product" style="height: 20px;">
        <a href="./index.html">
            <i class="fas fa-home"></i>
            <span" style="padding: 0 5px; font-weight: 0;">Trang chủ</span>
        </a>
        <i class="fas fa-chevron-right" style="font-size: 13px; font-weight: normal; padding: 0 5px;"></i>
        <span style="font-weight: bold;">
            Tìm kiếm theo tên
        </span>
    </div>
</section>

<?php
//Load file layout vao day
$this->fileLayout = "LayoutTrangTrong.php"
?>

<main class="main">
    <!-- Phần thông tin tìm kiếm -->
    <div class="main_info">
        <h2>theo size giày</h2>
        <div class="main_info_content">
            <ul>
                <li>
                    <input type="checkbox" name="" class="main_info_list" id="list_size_36">
                    <label for="list_size_36">36</label>
                </li>
                <li>
                    <input type="checkbox" name="" class="main_info_list" id="list_size_37">
                    <label for="list_size_37">37</label>
                </li>
                <li>
                    <input type="checkbox" name="" class="main_info_list" id="list_size_38">
                    <label for="list_size_38">38</label>
                </li>
                <li>
                    <input type="checkbox" name="" class="main_info_list" id="list_size_39">
                    <label for="list_size_39">39</label>
                </li>
                <li>
                    <input type="checkbox" name="" class="main_info_list" id="list_size_40">
                    <label for="list_size_40">40</label>
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
            <input class="form_input" type="number" min="0" value="" id="fromPrice" name="fromPrice" placeholder=" " />
            <label class="form_label" for="fromPrice">Giá nhỏ nhất</label>
        </div>

        <div class="form_field">
            <input class="form_input" type="number" min="0" value="" id="toPrice" name="fromPrice" placeholder=" " />
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
                <span>Hiển thị 1 - 18 trong tổng số <span>123</span> sản phẩm</span>
            </div>

        </div>

        <div class="main_product_list">

            <?php
            foreach ($data as $rows) :
            ?>
                <div class="product">
                    <div class="sale">
                        <span>-<?php echo $rows->discount; ?>%</span>
                    </div>
                    <a href="index.php?controller=products&action=detail&id=<?php echo $rows->id; ?>">
                        <img class="product_img_fisrt" src="./assets/upload/products/<?php echo $rows->photo; ?>" alt="" />
                        <img class="product_img_last" src="./assets/upload/products/<?php echo $rows->photo; ?>" alt="" />
                        <p class="product_name"><?php echo $rows->name; ?></p>
                    </a>
                    <div class="product_price_flex">
                        <div class="product_price">
                            <span><?php echo number_format($rows->price - ($rows->price * $rows->discount) / 100); ?>
                                <span>đ</span>
                            </span>
                        </div>
                        <div class="product_price_goc">
                            <span><?php echo number_format($rows->price); ?><span>đ</span></span>
                        </div>
                    </div>
                    <p class="product_name">
                        <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=1"><i class="fas fa-star"></i></a>
                        <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=2"><i class="fas fa-star"></i></a>
                        <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=3"><i class="fas fa-star"></i></a>
                        <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=4"><i class="fas fa-star"></i></a>
                        <a href="index.php?controller=products&action=rating&id=<?php echo $rows->id; ?>&star=5"><i class="fas fa-star"></i></a>
                    </p>
                    <a href="./ProductDetail.html"><button class="btn_detail">Xem chi tiết</button></a>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="page">
            <ul>
                <li>
                    <a href="">
                        << </a>
                </li>
                <?php for ($i = 1; $i <= $numPage; $i++) : ?>
                    <li><a href="index.php?controller=search&action=name&key=<?php echo $key; ?>&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <li>
                    <a href="">>></a>
                </li>
            </ul>

        </div>
    </div>
    <!-- Phần kết thúc thông tin hiển thị -->
</main>