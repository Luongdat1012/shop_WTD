<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>

<?php
/* echo '<pre>';
print_r($data);
echo '</pre>'; */

?>
<div class="col-lg-6" style="max-width: 100%">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h4 class="header-title mb-4">Thống kê doanh thu</h4>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-5">
                            <label for="date_start">Từ ngày</label>
                            <input type="date" name="date_start" id="date_start" class="form-control" style="width: auto; display: inline;">
                        </div>
                        <div class="col-5">
                            <label for="date_end">Đến ngày</label>
                            <input type="date" name="date_end" id="date_end" class="form-control" style="width: auto; display: inline;">
                        </div>
                        <div class="col-2">
                            <input type="button" value="Tìm kiếm" onclick="location.href = 'index.php?controller=thongKe&action=searchDate&date_start=' + document.getElementById('date_start').value + '&date_end=' + document.getElementById('date_end').value;" class="btn btn-secondary waves-effect width-xs" />
                        </div>
                    </div>

                </div>

            </div>

            <div class="table-responsive">
                <table style="text-align: center;" class="table table-bordered mb-0">
                    <thead>
                        <tr style="background-color: black; color: white;">
                            <th style="max-width: 100px ;">Date</th>
                            <th>Đơn hàng</th>
                            <th>Số lượng sản phẩm</th>
                            <th>Doanh thu</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $rows) : ?>
                            <tr style="color: black; font-weight: bold;">
                                <td style="vertical-align: middle;"><?php echo date("d/m/Y", strtotime($rows->ngaydat)) ?></td>
                                <td style="vertical-align: middle;"><?php echo $rows->donhang ?></td>
                                <td style="vertical-align: middle;"><?php echo $rows->soluongban ?></td>
                                <td style="vertical-align: middle;"><?php echo number_format($rows->doanhthu) ?></td>
                                <td>
                                    <a href="index.php?controller=thongke&action=detail&ngaydat=<?php echo $rows->ngaydat ?>" class="btn btn-pink"><i class="far fa-newspaper"></i></a>
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
                <li class="page-item"><a class="page-link" href="index.php?controller=thongke&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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