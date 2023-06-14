<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>

<?php
//load file Layout.php vao day
$this->fileLayout = "Layout.php";
?>

<div class="card">
    <div class="card-body">
        <div class="panel panel-default" style="margin-bottom:5px;">
            <h4 class="header-title mb-4">Thông tin khách hàng</h4>
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <tr>
                        <th>Tên khách hàng</th>
                        <th><?php echo $customer->name; ?></th>
                    </tr>
                    <tr>
                        <th style="width:150px;">Email</th>
                        <th><?php echo $customer->email; ?></th>
                    </tr>
                    <tr>
                        <th style="width:150px;">Địa chỉ</th>
                        <th>
                            <?php $address = $this->modelAddress($customer->provinceid, $customer->districtid, $customer->wardid, $customer->villageid) ?>
                            <?php echo $address->village_name . ', ' . $address->ward_name . ' , ' . $address->district_name . ' , ' . $address->province_name ?>
                        </th>
                    </tr>
                    <tr>
                        <th style="width:150px;">Điện thoại</th>
                        <th><?php echo $customer->phone; ?></th>
                    </tr>
                    <tr>
                        <th>Tổng mua sắm</th>
                        <th><?php echo number_format($totalPrice) ?> vnđ</th>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
<?php
/* echo '<pre>';
print_r($address);
echo '</pre>' */
?>
<div class="card-body"><a href="#" onclick="history.go(-1);" class="btn btn-primary">Quay lại</a></div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <h4 class="header-title mb-4">Các đơn hàng của khách</h4>
            <table style="text-align: center;" class="table table-bordered mb-0">
                <tr style="background-color: black; color: white;">

                    <th style="width: 15%;">Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                    <th>Chi tiết</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($order as $rows) : ?>
                        <tr style="color: black; font-weight: bold;">
                            <td style="vertical-align: middle;"><?php echo $rows->id ?></td>
                            <td style="vertical-align: middle;"><?php echo date("d/m/Y", strtotime($rows->date)); ?></td>
                            <td style="vertical-align: middle;"><?php echo number_format($rows->price); ?></td>
                            <td style="vertical-align: middle;"><?php if ($rows->status == 0) : ?>
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
                            <td style="vertical-align: middle;"><?php echo $rows->note ?></td>
                            <td><a href="index.php?controller=orders&action=detail&id=<?php echo $rows->id ?>" class="btn btn-pink"><i class="far fa-newspaper"></i></a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>