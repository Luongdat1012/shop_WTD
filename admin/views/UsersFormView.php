<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>
<?php if (isset($_GET["notify"]) && $_GET["notify"] == "email-exists") : ?>
    <div class="alert alert-warning">Email đã tồn tại</div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h4 class="mb-3">Sửa đổi thông tin</h4>
                <form class="parsley-examples" method="POST" action="<?php echo $action; ?>">
                    <div class="form-group">
                        <label for="userName">Name</label>
                        <input type="text" name="name" parsley-trigger="change" required class="form-control" id="userName" value="<?php echo isset($record->name) ? $record->name : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email</label>
                        <input type="email" name="email" class="form-control" id="emailAddress" value="<?php echo isset($record->email) ? $record->email : ""; ?>" <?php if (isset($record->email)) : ?> disabled <?php else : ?> required <?php endif ?>>
                    </div>
                    <div class="form-group">
                        <label for="pass1">Password</label>
                        <input id="pass1" type="password" name="password" <?php if (isset($record->email)) : ?> placeholder="Không thay đổi thì không điền" <?php else : ?> required <?php endif ?> class="form-control">
                    </div>  
                    <div class="form-group">
                        <label for="chucvu">Chức vụ</label>
                        <input id="chucvu" type="text" name="chucvu" value="<?php echo isset($record->chucvu) ? $record->chucvu : ""; ?>" class="form-control">
                    </div>                   
                    <!-- rows -->
                    <?php /* echo '<pre>';
                    print_r($record);
                    echo '</pre>'; */
                    
                    ?>     
                    
                    
                    <div class="row" style="margin-top: 10px;<?php if(isset($record) && ($record->role == 1)): ?> display: none; <?php endif; ?> ">
                        <div class="col-md-2"><b>Quyền truy cập</b></div>                                           
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="checkbox" <?php if (isset($data->role_product) && $data->role_product == 1) : ?> checked <?php endif; ?> name="role_product" id="role_product"> <label for="role_product"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Quản lý sản phẩm</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" <?php if (isset($data->role_user) && $data->role_user == 1) : ?> checked <?php endif; ?> name="role_user" id="role_user"> <label for="role_user"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Quản lý tài khoản</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" <?php if (isset($data->role_banner) && $data->role_banner == 1) : ?> checked <?php endif; ?> name="role_banner" id="role_banner"> <label for="role_banner"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Quản lý banner</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" <?php if (isset($data->role_news) && $data->role_news == 1) : ?> checked <?php endif; ?> name="role_new" id="role_new"> <label for="role_new"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Quản lý tin tức</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" <?php if (isset($data->role_categories) && $data->role_categories == 1) : ?> checked <?php endif; ?> name="role_category" id="role_category"> <label for="role_category"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Quản lý danh mục</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" <?php if (isset($data->role_thongke) && $data->role_thongke == 1) : ?> checked <?php endif; ?> name="role_thongke" id="role_thongke"> <label for="role_thongke"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Thống kê doanh thu</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" <?php if (isset($data->role_order) && $data->role_order == 1) : ?> checked <?php endif; ?> name="role_order" id="role_order"> <label for="role_order"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Đơn hàng</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" <?php if (isset($data->role_create) && $data->role_create == 1) : ?> checked <?php endif; ?> name="role_create" id="role_create"> <label for="role_create"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Tạo mới</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" <?php if (isset($data->role_fix) && $data->role_fix == 1) : ?> checked <?php endif; ?> name="role_fix" id="role_fix"> <label for="role_fix"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Chỉnh sửa</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <!-- end rows -->



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