<?php
//load file Layout.php vao day
$this->fileLayout = "Layout.php";
?>
<?php
$conn = Connection::getInstance();
$query = $conn->query("select * from customers where id = (select customer_id from orders where id=$id limit 0,1)");
$customer = $query->fetch();
?>

<div class="card">
    <div class="card-body">
        <div class="col-md-12">
            <div class="panel panel-default" style="margin-bottom:5px;">
                <h3 class="header-title mb-4">Thông tin đơn hàng</h3>
                <div class="panel-body">
                    <table class="table table-bordered" style="color: black;">
                        <tr>
                            <th style="width:150px;">Họ tên</th>
                            <th><?php echo $customer->name; ?></th>
                        </tr>
                        <tr>
                            <th style="width:150px;">Email</th>
                            <th><?php echo $customer->email; ?></th>
                        </tr>
                        <tr>
                            <th style="width:150px;">Địa chỉ</th>
                            <th>
                                <?php
                                $address = $this->modelAddress($customer->provinceid, $customer->districtid, $customer->wardid, $customer->villageid);

                                echo $address->village_name . ',' . $address->ward_name . ' , ' . $address->district_name . ' , ' . $address->province_name
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="width:150px;">Điện thoại</th>
                            <th><?php echo $customer->phone; ?></th>
                        </tr>
                        <tr>
                            <th style="width:150px;">Mã đơn hàng</th>
                            <th><?php echo $data[0]->order_id ?></th>
                        </tr>
                        <tr>
                            <?php
                            $total = 0;
                            foreach ($data as $nb) {
                                $total += $nb->price;
                            }
                            ?>

                            <th style="width:150px;">Tổng tiền</th>
                            <th><?php echo number_format($total) ?></th>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table style="text-align: center;" class="table table-bordered mb-0">
                <tr style="background-color: black; color: white;">
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Giá gốc</th>
                    <th>Discount</th>
                    <th>Số lượng</th>
                    <th>Giá bán</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $rows) : ?>
                        <?php $product = $this->modelGetProduct($rows->product_id); ?>
                        <tr style="color: black; font-weight: bold;">
                            <td style="width: 10%;">
                                <?php if ($product->photo != "" && file_exists("../assets/upload/products/" . $product->photo)) : ?>
                                    <img src="../assets/upload/products/<?php echo $product->photo; ?>" style="width:70px;">
                                <?php endif; ?>
                            </td>
                            <td style="vertical-align: middle;"><?php echo $product->name; ?></td>
                            <td style="vertical-align: middle;"><?php echo number_format($product->price); ?></td>
                            <td style="vertical-align: middle;"><?php echo $product->discount; ?>%</td>
                            <td style="vertical-align: middle;"><?php echo $rows->quantity; ?></td>
                            <td style="vertical-align: middle;"><?php echo number_format($product->price - ($product->price * $product->discount) / 100); ?></td>
                            <td style="vertical-align: middle;"><?php echo number_format($rows->price * $rows->quantity) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>