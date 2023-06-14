<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>
<?php if ($_SESSION['email'][0]['roles']->role_create == 1) : ?>

    <div class="card-body">
        <div class="button-list" style="text-align: right; margin-right: -5px;">
            <!-- Large modal -->
            <a href="index.php?controller=products&action=create" class="btn btn-primary waves-effect waves-light">Thêm mới</a>
        </div>
    </div>
<?php endif; ?>
<div class="col-lg-6" style="max-width: 100%">
    <div class="row">
        <!-- Search Name and ID -->
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="header-title">Tìm kiếm theo tên</h3>
                    <?php $option_search = isset($_GET["option_search"]) ? $_GET["option_search"] : ""; ?>
                    <div class="row">
                        <select id="option_search" class="custom-select" style="width: 150px; display: block;">
                            <option value="0" disabled>Tìm kiếm theo</option>
                            <option <?php if ($option_search == "name_product") : ?> selected <?php endif; ?> value="name_product">Tên sản phẩm</option>
                            <option <?php if ($option_search == "id_product") : ?> selected <?php endif; ?> value="id_product">Mã sản phẩm</option>
                            <option <?php if ($option_search == "category_product") : ?> selected <?php endif; ?> value="category_product">Tên danh mục </option>
                        </select>
                        <input type="text" id="search_key" class="form-control" style="width: 300px; display: inline-block; margin: 0 5px;" onkeypress="searchForm(event);">
                    </div>
                </div>
            </div>
        </div>
        <!-- End Search Name and ID -->
        <!-- Search Price -->
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="header-title">Giá bán sản phẩm</h3>
                    <div class="row">
                        <label for="price_from" style="margin: auto 5px;">Từ</label>
                        <input type="number" min="0" name="price_from" id="price_from" class="form-control" style="width: 150px;">
                        <label for="price_end" style="margin: auto 5px;">đến</label>
                        <input type="number" min="0" name="price_end" id="price_end">
                        <button type="button" class="btn btn-outline-secondary waves-effect waves-light btn-sm" style="margin: 0 10px;" onclick="location.href = 'index.php?controller=products&action=searchPrice&fromPrice=' + document.getElementById('price_from').value + '&toPrice=' + document.getElementById('price_end').value;">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Search Price -->
    </div>
    <?php
    /* echo '<pre>';
print_r($data);
echo '</pre>'; */
    ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h3 class="header-title mb-4">Quản lý sản phẩm</h3>
                </div>
                <div class="col-3">
                    <label for="filter_category">Danh mục sản phẩm</label>
                    <select name="category_id" class="form-control" style="width:200px;" onchange="location.href = 'index.php?controller=products&action=searchCategory&id='+this.value">
                        <?php
                        $categories = $this->modelCategories();
                        ?>
                        <?php foreach ($categories as $rows) : ?>
                            <option <?php if (isset($_GET['id']) && $_GET['id'] == $rows->id) : ?> selected <?php endif; ?> value="<?php echo $rows->id ?>"><?php echo $rows->name; ?></option>
                            <?php
                            $categoriesSub = $this->modelCategoriesSub($rows->id);
                            ?>
                            <?php foreach ($categoriesSub as $rowsSub) : ?>
                                <option <?php if (isset($_GET['id']) && $_GET['id'] == $rowsSub->id) : ?> selected <?php endif; ?> value="<?php echo $rowsSub->id ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rowsSub->name; ?></option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Bộ lọc sản phẩm bán chạy -->
                <div class="col-3">
                    <label for="filter_sale">Sắp xếp</label>
                    <select name="" id="filter_sale" class="custom-select" onchange="location.href = 'index.php?controller=products&action=hotSaleDay&days='+this.value">
                        <option value="0">Sắp xếp</option>
                        <option value="index.php">Tất cả</option>
                        <option <?php if (isset($_GET['action']) && $_GET['action'] == "hotSale") : ?> selected <?php endif; ?> value="hotSale">Sản phẩm bán chạy nhất</option>
                        <option <?php if (isset($_GET['days']) && $_GET['days'] == "7days") : ?> selected <?php endif; ?> value="7days">Bán chạy nhất 7 ngày qua</option>
                        <option <?php if (isset($_GET['days']) && $_GET['days'] == "28days") : ?> selected <?php endif; ?> value="28days">Bán chạy nhất 28 ngày qua</option>
                        <option <?php if (isset($_GET['days']) && $_GET['days'] == "90days") : ?> selected <?php endif; ?> value="90days">Bán chạy nhất 90 ngày qua</option>
                        <option <?php if (isset($_GET['days']) && $_GET['days'] == "365days") : ?> selected <?php endif; ?> value="365days">Bán chạy nhất 1 năm qua</option>
                    </select>

                </div>
                <!-- End Bộ lọc sản phẩm bán chạy -->
            </div>

            <div class="table-responsive" style="margin-top: 10px;">
                <table style="text-align: center;" class="table table-bordered mb-0">
                    <thead>
                        <tr style="background-color: black; color: white;">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Sub_Image</th>
                            <th>FullName</th>
                            <th>Giá</th>
                            <th>Giảm giá</th>
                            <th>Giá bán</th>
                            <th>Categoty</th>
                            <th>Hot</th>

                            <?php if ($_SESSION['email'][0]['roles']->role_fix == 1) : ?>
                                <th></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) : ?>
                            <?php $sub_photo = $this->modelGetSubPhoto($row->id); ?>

                            <tr style="color: black; font-weight: bold;">
                                <td style="vertical-align: middle; text-align: left;"><?php echo $row->id ?></td>
                                <td style="width: 70px;"><?php if ($row->photo != "" && file_exists("../assets/upload/products/" . $row->photo)) : ?>
                                        <img style="width: 100px;" src="../assets/upload/products/<?php echo $row->photo; ?>">
                                    <?php endif; ?>
                                </td>
                                <td style="width: 150px; vertical-align: middle;">
                                    <?php foreach ($sub_photo as $value) : ?>
                                        <?php if ($value->photo != "" && file_exists("../assets/upload/products/" . $value->photo)) : ?>
                                            <img style="width: 30px;" src="../assets/upload/products/<?php echo $value->photo; ?>">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                                <td style="vertical-align: middle; text-align: left;"><?php echo $row->name ?></td>
                                <td style="vertical-align: middle; text-align: left;"><?php echo number_format($row->price) ?></td>
                                <td style="vertical-align: middle; text-align: center;"><?php echo $row->discount ?>%</td>
                                <td style="vertical-align: middle; text-align: left;"><?php echo number_format($row->price - ($row->price * $row->discount) / 100) ?></td>
                                <td style="vertical-align: middle;">
                                    <?php
                                    $category = $this->modelGetCategory($row->category_id);
                                    echo $category;
                                    ?></td>
                                <td style="vertical-align: middle;">
                                    <?php if (isset($row->hot) && $row->hot == 1) : ?>
                                        <span class="fa fa-check"></span>
                                    <?php endif; ?>
                                </td>

                                <?php if ($_SESSION['email'][0]['roles']->role_fix == 1) : ?>
                                    <td style="vertical-align: middle;">
                                        <a href="index.php?controller=products&action=update&id=<?php echo $row->id; ?>" class="btn btn-icon waves-effect waves-light btn-success"><i class="fas fa-pencil-alt"></i></a>

                                        <a href="index.php?controller=products&action=delete&id=<?php echo $row->id; ?>" class="btn btn-icon waves-effect waves-light btn-danger" onclick="return window.confirm('Ban co muon xoa san pham nay?')"><i class="fas fa-trash"></i></a>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <nav style="float: right;">
        <ul class="pagination pagination-split">
            <?php if (isset($_GET['p']) && $_GET['p'] > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?controller=products&p=<?php echo $_GET['p'] - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $numPage; $i++) : ?>
                <li class="page-item"><a class="page-link" href="index.php?controller=products&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <?php if (isset($_GET['p']) && $_GET['p'] <= $numPage - 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?controller=products&p=<?php echo $_GET['p'] + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">»</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<!-- Xử lý thông báo -->
<!-- Xử lý thông báo -->
<?php if (isset($_SESSION['notify_success'])) : ?>
    <div style="position: absolute; top: 15px; right: 15px; z-index: 100;" class="alert alert-success col-3" role="alert" id="alert">
        <strong><?php echo $_SESSION['notify_success'] ?></strong>
    </div>
<?php elseif (isset($_SESSION['notify_delete'])) : ?>
    <div style="position: absolute; top: 15px; right: 15px; z-index: 100;" class="alert alert-danger col-3" role="alert" id="alert">
        <strong><?php echo $_SESSION['notify_delete'] ?></strong>
    </div>
<?php elseif (isset($_SESSION['notify_update'])) : ?>
    <div style="position: absolute; top: 15px; right: 15px; z-index: 100;" class="alert alert-info col-3" role="alert" id="alert">
        <strong><?php echo $_SESSION['notify_update'] ?></strong>
    </div>
<?php endif; ?>

<?php
if (isset($_SESSION['notify_success']) || isset($_SESSION['notify_delete']) || isset($_SESSION['notify_update'])) : ?>
    <script>
        $(document).ready(function() {
            $("#alert").fadeIn(5000);
            $("#alert").animate({
                right: '-50px',
                opacity: "0"
            }, 4000);
        });
    </script>
<?php
    unset($_SESSION['notify_success']);
    unset($_SESSION['notify_delete']);
    unset($_SESSION['notify_update']);
endif;
?>
<script>
    function searchForm(event) {
        //phim enter co keyCode = 13
        if (event.keyCode == 13) {
            //lay gia tri cua id=key
            var key = document.getElementById("search_key").value;
            var option_search = document.getElementById("option_search").value;
            //di chuyen den url tim kiem
            location.href = "index.php?controller=products&action=search&search_key=" + key + "&option_search=" + option_search;
        }
    }
</script>