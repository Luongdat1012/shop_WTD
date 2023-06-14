<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>

<div class="col-lg-6" style="max-width: 100%">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Thống kê chi tiết đơn hàng:  </h4>

            <div class="table-responsive" >
                <table style="text-align: center;" class="table table-bordered mb-0">
                    <thead>
                        <tr style="background-color: black; color: white;">
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá bán sản phẩm</th>
                            <th>Giá trị đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($thongke as $rows) : ?>
                            <tr style="color: black; font-weight: bold;">
                                <td style="vertical-align: middle;"><?php echo $rows->madonhang ?></td>
                                <td style="vertical-align: middle;"><?php echo $rows->tenkhachhang ?></td>
                                <td style="vertical-align: middle;"><?php echo $rows->tensanpham ?></td>
                                <td><?php if ($rows->photo != "" && file_exists("../assets/upload/products/" . $rows->photo)) : ?>
                                        <img style="width: 100px;" src="../assets/upload/products/<?php echo $rows->photo; ?>">
                                    <?php endif; ?></td>
                                <td style="vertical-align: middle;"><?php echo $rows->soluong ?></td>
                                <td style="vertical-align: middle;"><?php echo number_format($rows->dongia) ?></td>
                                <td style="vertical-align: middle;"><?php echo number_format($rows->giatridonhang) ?></td>                                
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
                <li class="page-item"><a class="page-link" href="index.php?controller=thongke&action=detail&ngaydat=<?php echo $_GET['ngaydat'] ?>&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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