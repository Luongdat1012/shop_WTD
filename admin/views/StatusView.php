<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>


<div class="col-lg-6" style="max-width: 100%">
    <div class="card">
        <div class="card-body">
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
            <?php
            $recordPerPage = 20;
            $page = $this->modelRead($recordPerPage);
            $numPage = ceil($this->modelTotalRecord() / $recordPerPage);
            ?>
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