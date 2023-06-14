<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>

<div class="card-body">
    <div class="card">
        <div class="card-body">
            <h3 class="header-title">Tìm kiếm</h3>
            <?php $option_search = isset($_GET["option_search"]) ? $_GET["option_search"] : ""; ?>
            <div class="row">
                <div class="col-10">
                    <div class="row">
                        <select id="option_search" class="custom-select" style="width: 200px; display: block;">
                            <option value="0">Tìm kiếm theo</option>
                            <option <?php if ($option_search == "name_customer") : ?> selected <?php endif; ?> value="name_customer">Tên khách hàng</option>
                            <option <?php if ($option_search == "email_customer") : ?> selected <?php endif; ?> value="email_customer">Email khách hàng</option>
                        </select>
                        <input type="text" id="search_key" class="form-control" style="width: 300px; display: inline-block; margin: 0 10px;" onkeypress="searchForm(event);">
                        <button class="btn btn-outline-dark waves-effect width-md waves-light" type="button" onclick="search()">Tìm kiếm</button>
                    </div>
                </div>
                <div class="col-2" style="text-align: right;">
                    <a href="index.php?controller=customers&action=create" class="btn btn-primary waves-effect waves-light">Thêm mới</a>
                </div>
            </div>
        </div>
    </div>


</div>

<?php
/* echo '<pre>';
print_r($data);
echo '</pre>'; */

?>
<div class="col-lg-6" style="max-width: 100%">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h4 class="header-title mb-4">Tài khoản Khách hàng</h4>
                </div>
                <div class="col-4">
                    <select name="" id="" class="custom-select" onchange="location.href = 'index.php?controller=customers&action='+this.value">
                        <option value="0">Sắp xếp</option>
                        <option value="index">Tất cả</option>
                        <option <?php if (isset($_GET['action']) && $_GET['action'] == "orderList") : ?> selected <?php endif; ?> value="orderList">Giá trị hóa đơn giảm dần</option>
                        <option <?php if (isset($_GET['action']) && $_GET['action'] == "order1month") : ?> selected <?php endif; ?> value="order1month">Mua nhiều nhất trong 1 tháng qua</option>
                    </select>

                </div>
            </div>
            <div class="table-responsive">
                <table style="text-align: center;" class="table table-bordered mb-0">
                    <thead>
                        <tr style="background-color: black; color: white;">
                            <th>ID</th>
                            <th style="max-width: 100px ;">FullName</th>
                            <th>Email</th>
                            <th>Tiền đã mua (vnđ)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) :
                            $number = $this->modelGetNumber($row->id);
                            $total = 0;
                            foreach ($number as $nb) {
                                $total += $nb->number;
                            }
                        ?>
                            <tr style="color: black; font-weight: bold;">
                                <td style="vertical-align: middle;"><?php echo $row->id ?></td>
                                <td style="vertical-align: middle;"><?php echo $row->name ?></td>
                                <td style="vertical-align: middle;"><?php echo $row->email ?></td>
                                <td style="vertical-align: middle;">
                                    <?php
                                    if (isset($_GET['action']) && $_GET['action'] == 'order1month') {
                                        echo number_format($row->total);
                                    } else {
                                        echo number_format($total);
                                    }
                                    ?>
                                </td>
                                <td style="vertical-align: middle; max-width: 100px">
                                    <a href="index.php?controller=customers&action=update&id=<?php echo $row->id; ?>" class="btn btn-icon waves-effect waves-light btn-success"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="index.php?controller=customers&action=detail&id=<?php echo $row->id; ?>" class="btn btn-pink"><i class="far fa-newspaper"></i></a>
                                    <a href="index.php?controller=customers&action=delete&id=<?php echo $row->id; ?>" class="btn btn-icon waves-effect waves-light btn-danger" onclick="return window.confirm('Ban co muon xoa tai khoan nay?')"><i class="fas fa-trash"></i></a>


                                </td>
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
            <li class="page-item">
                <a class="page-link" href="" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $numPage; $i++) : ?>
                <li class="page-item"><a class="page-link" href="index.php?controller=customers&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">»</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
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

<!-- Xử lý tìm kiếm form tìm kiếm JS -->
<script>
    function searchForm(event) {
        //phim enter co keyCode = 13
        if (event.keyCode == 13) {
            //lay gia tri cua id=key
            var key = document.getElementById("search_key").value;
            var option_search = document.getElementById("option_search").value;
            //di chuyen den url tim kiem
            location.href = "index.php?controller=customers&action=search&search_key=" + key + "&option_search=" + option_search;
        }
    }

    function search() {
        //lay gia tri cua id=key
        var key = document.getElementById("search_key").value;
        var option_search = document.getElementById("option_search").value;
        //di chuyen den url tim kiem
        location.href = "index.php?controller=customers&action=search&search_key=" + key + "&option_search=" + option_search;
    }
</script>