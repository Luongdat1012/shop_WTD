<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>

<?php
/* echo '<pre>';
print_r($_SESSION['email'][0]['roles']);
echo '</pre>'; */

?>

<div class="col-lg-6" style="max-width: 100%">
    <!-- Khung tìm kiếm đầu trang -->
    <div class="row">
        <!-- Start search name -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="header-title">Tìm kiếm theo tên</h3>
                    <?php $option_search = isset($_GET["option_search"]) ? $_GET["option_search"] : ""; ?>
                    <div class="row">
                        <select class="custom-select" style="width: 150px; display: block;" id="option_search">
                            <option value="0">Tìm kiếm theo</option>
                            <option <?php if ($option_search == "name_customer") : ?> selected <?php endif; ?> value="name_customer">Tên khách hàng</option>
                            <option <?php if ($option_search == "order_id") : ?> selected <?php endif; ?> value="order_id">Mã hóa đơn</option>
                        </select>
                        <input type="text" id="search_key" class="form-control" style="width: 300px; display: inline-block;" onkeypress="searchForm(event);">
                    </div>
                </div>
            </div>
        </div>
        <!-- End search name -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="header-title">Giá trị đơn hàng</h3>
                    <div class="row">
                        <label for="price_from" style="margin: auto 5px; color: black;">Từ</label>
                        <input type="number" min="0" name="price_from" id="price_from" class="form-control" style="width: 150px;">
                        <label for="price_end" style="margin: auto 5px;">đến</label>
                        <input type="number" min="0" name="price_end" id="price_end">
                        <button type="button" class="btn btn-outline-secondary waves-effect waves-light btn-sm" style="margin: 0 10px;" onclick="location.href = 'index.php?controller=orders&action=searchPrice&fromPrice=' + document.getElementById('price_from').value + '&toPrice=' + document.getElementById('price_end').value;">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- kết thúc khung tìm kiếm đầu trang -->

    <!-- Search date -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <label for="date_start">Từ ngày</label>
                    <input type="date" name="date_start" id="date_start" class="form-control" style="width: auto; display: inline;">
                </div>
                <div class="col-3">
                    <label for="date_end">Đến ngày</label>
                    <input type="date" name="date_end" id="date_end" class="form-control" style="width: auto; display: inline;">
                </div>
                <div class="col-3">
                    <input type="button" value="Tìm kiếm" onclick="location.href = 'index.php?controller=orders&action=searchDate&date_start=' + document.getElementById('date_start').value + '&date_end=' + document.getElementById('date_end').value;" class="btn btn-outline-secondary waves-effect waves-light btn-md" />
                </div>
                <div class="col-3">

                    <select class="custom-select" id="order_status">
                        <option value="">Tìm kiếm theo</option>
                        <option value="0">Chờ xác nhận</option>
                        <option value="1">Đã xác nhận</option>
                        <option value="2">Đang giao hàng</option>
                        <option value="3">Đã giao hàng</option>
                        <option value="4">Đã hũy</option>
                    </select>
                </div>

            </div>
        </div>
    </div>
    <!-- End search date -->

    <div class="card">
        <div class="card-body">
            <div class="col-md-3">
                <h3 class="header-title mb-4" id="Order_name">Tất cả đơn hàng</h3>
            </div>
            <div class="table-responsive" id="demo">
                <table style="text-align: center;" class="table table-bordered mb-0">
                    <tr style="background-color: black; color: white;">
                        <th>Mã đơn</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Ngày mua</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <?php if ($_SESSION['email'][0]['roles']->role_fix == 1) : ?>
                            <th>Hủy đơn</th>
                            <th></th>
                        <?php endif; ?>

                    </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($data as $rows) : ?>
                            <?php
                            $customer = $this->modelGetCustomer($rows->customer_id);
                            $number = $this->modelGetNumber($rows->id);
                            $total = 0;
                            foreach ($number as $nb) {
                                $total += $nb->number;
                            }

                            ?>
                            <tr style="color: black; font-weight: bold;">
                                <td><?php echo $rows->id ?></td>
                                <td><?php echo isset($customer->name) ? $customer->name : ""; ?></td>
                                <td><?php echo isset($customer->email) ? $customer->email : ""; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($rows->date)); ?></td>
                                <td><?php echo $total ?></td>
                                <td><?php echo number_format($rows->price); ?></td>
                                <td>
                                    <?php if ($rows->status == 0) : ?>
                                        <div class="badge badge-warning">Chờ xác nhận</div>
                                    <?php elseif ($rows->status == 1) : ?>
                                        <div class="badge badge-primary">Đã xác nhận</div>
                                    <?php elseif ($rows->status == 2) : ?>
                                        <div class="badge badge-pink">Đang giao hàng</div>
                                    <?php elseif ($rows->status == 3) : ?>
                                        <div class="badge badge-success">Hoàn Thành</div>
                                    <?php elseif ($rows->status == 4) : ?>
                                        <div class="badge badge-danger">Đã hủy</div>
                                    <?php endif; ?>
                                </td>
                                <?php if ($_SESSION['email'][0]['roles']->role_fix == 1) : ?>
                                    <td>
                                        <?php if (($rows->status) < 3) : ?>
                                            <a href="index.php?controller=orders&action=cancel&id=<?php echo $rows->id; ?>" id="submit_huy" class="badge badge-danger">Hủy đơn</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($rows->status <= 2) : ?>
                                            <a href="index.php?controller=orders&action=delivery&id=<?php echo $rows->id; ?>&status=<?php echo $rows->status ?>" class="label label-info">
                                                <?php if ($rows->status == 0) : ?>
                                                    <span class="badge badge-primary">Xác nhận</span>
                                                <?php elseif ($rows->status == 1) : ?>
                                                    <span class="badge badge-pink">Giao hàng</span>
                                                <?php elseif ($rows->status == 2) : ?>
                                                    <span class="badge badge-success">Hoàn thành</span>
                                                <?php endif; ?>
                                            </a>
                                        <?php endif; ?>
                                        <a href="index.php?controller=orders&action=detail&id=<?php echo $rows->id; ?>" class="badge badge-dark">Chi tiết</a>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="" style="float: right; margin-top: 10px;">
                <nav style="float: right;">
                    <ul class="pagination pagination-split">
                        <li class="page-item">
                            <a class="page-link" href="index.php?controller=orders&p=<?php echo $i; ?>" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $numPage; $i++) : ?>
                            <li class="page-item"><a style="color: black;" class="page-link" href="index.php?controller=orders&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?controller=orders&p=<?php echo $i; ?>" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Xử lý tìm kiếm form tìm kiếm JS -->
<script>
    function searchForm(event) {
        //phim enter co keyCode = 13
        if (event.keyCode == 13) {
            //lay gia tri cua id=key
            var key = document.getElementById("search_key").value;
            var option_search = document.getElementById("option_search").value;
            //di chuyen den url tim kiem
            location.href = "index.php?controller=orders&action=searchName&search_key=" + key + "&option_search=" + option_search;
        }
    }
</script>
<!-- Script ajax trạng thái đơn hàng -->
<script>
    $(document).ready(function() {
        $('#order_status').change(function(event) {
            status = $('#order_status').val();
            if (status == 0) {
                $('#Order_name').html('Đơn hàng chờ xác nhận');
            } else if (status == 1) {
                $('#Order_name').html('Đơn hàng đã xác nhận');
            } else if (status == 2) {
                $('#Order_name').html('Đơn hàng đang giao');
            } else if (status == 3) {
                $('#Order_name').html('Đơn hàng đã hoàn thành');
            } else if (status == 4) {
                $('#Order_name').html('Đơn hàng đãh');
            }
            $.get('index.php?controller=orders&action=ajaxStatus&status=' + status, function(data) {
                $("#demo").html(data);
            });
        })
    });
</script>
<!-- Xử lý thông báo -->
<?php if (isset($_SESSION['status_1'])) : ?>
    <div style="position: absolute; top: 15px; right: 15px; z-index: 100;" class="alert alert-success col-3" role="alert" id="alert">
        <strong><?php echo $_SESSION['status_1'] ?></strong>
    </div>
<?php elseif (isset($_SESSION['status_4'])) : ?>
    <div style="position: absolute; top: 15px; right: 15px; z-index: 100;" class="alert alert-danger col-3" role="alert" id="alert">
        <strong><?php echo $_SESSION['status_4'] ?></strong>
    </div>
<?php elseif (isset($_SESSION['status_2'])) : ?>
    <div style="position: absolute; top: 15px; right: 15px; z-index: 100;" class="alert alert-info col-3" role="alert" id="alert">
        <strong><?php echo $_SESSION['status_2'] ?></strong>
    </div>
<?php elseif (isset($_SESSION['status_3'])) : ?>
    <div style="position: absolute; top: 15px; right: 15px; z-index: 100;" class="alert alert-primary col-3" role="alert" id="alert">
        <strong><?php echo $_SESSION['status_3'] ?></strong>
    </div>
<?php endif; ?>

<?php
if (isset($_SESSION['status_1']) || isset($_SESSION['status_2']) || isset($_SESSION['status_3']) || isset($_SESSION['status_4'])) : ?>
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
    unset($_SESSION['status_1']);
    unset($_SESSION['status_2']);
    unset($_SESSION['status_3']);
    unset($_SESSION['status_4']);
endif;
?>

<script>
    $(document).ready(function() {
        
        $("#submit_huy").click(function(event) {
            confirm("Bạn có chắc chắn muốn hủy đơn");
        });

    });
</script>