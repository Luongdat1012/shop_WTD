<?php
$status = isset($_GET["status"]) ? $_GET["status"] : 0;
//tao bien $action de dua vao thuoc tinh $action cua the form
$action = "index.php?controller=products&action=status&id=$status";
//lay mot ban ghi
$record = $this->modelSubmit($status);
?>
<div class="table-responsive">
    <table style="text-align: center;" class="table table-bordered mb-0">
        <tr style="background-color: black; color: white;">
            <th>Họ và tên</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Ngày mua</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th>Hủy đơn</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

            <?php foreach ($record as $rows) : ?>
                <?php $customer = $this->modelGetCustomer($rows->customer_id); ?>
                <tr style="color: black; font-weight: bold;">
                    <td><?php echo isset($customer->name) ? $customer->name : ""; ?></td>
                    <td><?php echo isset($customer->address) ? $customer->address : ""; ?></td>
                    <td><?php echo isset($customer->phone) ? $customer->phone : ""; ?></td>
                    <td><?php echo date("d/m/Y", strtotime($rows->date)); ?></td>
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
                    <td><?php if (($rows->status) < 3) : ?>
                            <a href="index.php?controller=orders&action=cancel&id=<?php echo $rows->id; ?>" class="badge badge-danger">Hủy đơn</a>
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
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>