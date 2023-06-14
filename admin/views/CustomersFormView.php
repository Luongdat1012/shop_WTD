<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>
<?php if (isset($_GET["notify"]) && $_GET["notify"] == "email-exists") : ?>
    <div class="alert alert-warning">Email đã tồn tại</div>
<?php endif; ?>

<?php
/* echo '<pre>';
print_r ($data);
echo '</pre>' */
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h4 class="mb-3">Sửa đổi thông tin</h4>
                <form class="parsley-examples" method="POST" action="<?php echo $action; ?>">
                    <div class="form-group">
                        <label for="userName">Name</label>
                        <input type="text" name="name" parsley-trigger="change" required class="form-control" id="userName" value="<?php echo isset($data->name) ? $data->name : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" parsley-trigger="change" required class="form-control" id="address" value="<?php echo isset($data->address) ? $data->address : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" parsley-trigger="change" required class="form-control" id="phone" value="<?php echo isset($data->phone) ? $data->phone : ""; ?>">
                    </div>

                    <?php
                    if(isset($_GET['action']) && $_GET['action'] == 'update'){
                    $provinceCustomers = $this->modelGetProvinceUser($data->provinceid);
                    $districtCustomers = $this->modelGetDistrictUser($data->districtid);
                    $wardCustomers = $this->modelGetWardUser($data->wardid);
                    $villageCustomers = $this->modelGetVillageUser($data->villageid);
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-3">
                            Tỉnh
                            <select name="provice" id="province" class="form-control">
                                <?php if (isset($data->provinceid) && !empty($data->provinceid)) : ?>
                                    <option value="<?php echo $data->provinceid ?>"><?php echo $provinceCustomers->name ?></option>
                                <?php else : ?>
                                    <option value="">---Chọn tỉnh---</option>
                                <?php endif; ?>
                                <?php foreach ($province as $rows)
                                    echo '<option value="' . $rows->provinceid . '">' . $rows->name . '</option>'
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            Quận/ Huyện
                            <select name="district" id="district" class="form-control">
                                <?php if (!empty($data->districtid)) : ?>
                                    <option value="<?php echo $data->districtid ?>"><?php echo $districtCustomers->name ?></option>
                                <?php else : ?>
                                    <option value="">---Chưa chọn tỉnh---</option>
                                <?php endif; ?>
                                
                            </select>
                        </div>
                        <div class="col-md-3">
                            Phường/ Xã
                            <select name="ward" id="ward" class="form-control">
                                <?php if (!empty($data->wardid)) : ?>
                                    <option value="<?php echo $data->wardid ?>"><?php echo $wardCustomers->name ?></option>
                                <?php else : ?>
                                    <option value="">---Chưa chọn Quận/ Huyện---</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            Tổ/ Thôn
                            <select name="village" id="village" class="form-control">
                                <?php if (!empty($data->villageid)) : ?>
                                    <option value="<?php echo $data->villageid ?>"><?php echo $villageCustomers->name ?></option>
                                <?php else : ?>
                                    <option value="">---Chưa chọn Phường/ Xã---</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Script Ajax load địa chỉ -->
                    <script>
                        $(document).ready(function() {
                            $("#province").change(function(event) {
                                alert('1');
                                provinceid = $("#province").val();
                                $.get('index.php?controller=customers&action=ajaxSearchDistrict&provinceid=' + provinceid, function(data) {
                                    $("#district").html(data);
                                });
                            });
                            $("#district").change(function(event) {
                                districtid = $("#district").val();
                                $.get('index.php?controller=customers&action=ajaxSearchWard&districtid=' + districtid, function(data) {
                                    $("#ward").html(data);
                                });
                            });
                            $("#ward").change(function(event) {
                                ward = $("#ward").val();
                                $.get('index.php?controller=customers&action=ajaxSearchVillage&wardid=' + ward, function(data) {
                                    $("#village").html(data);
                                });
                            });
                        });
                    </script>

                    <div class="form-group">
                        <label for="emailAddress">Email</label>
                        <input type="email" name="email" class="form-control" id="emailAddress" value="<?php echo isset($data->email) ? $data->email : ""; ?>" <?php if (isset($data->email)) : ?> disabled <?php else : ?> required <?php endif ?>>
                    </div>
                    <div class="form-group">
                        <label for="pass1">Password</label>
                        <input id="pass1" type="password" name="password" <?php if (isset($data->email)) : ?> placeholder="Không thay đổi thì không điền" <?php else : ?> required <?php endif ?> class="form-control">
                    </div>

                    <div class="form-group text-right mb-0">
                        <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->


</div>