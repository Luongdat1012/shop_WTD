<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>

<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
    <div class="col-lg-6" style="max-width: 100%">
        <div class="card">
            <div class="card-body">

                <?php if ($_GET['action'] == "create") : ?>
                    <h4 class="header-title mb-4">Thêm Banner mới</h4>
                <?php else : ?>
                    <h4 class="header-title mb-4">Chỉnh sửa Banner</h4>
                <?php endif; ?>
                <!-- rows -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-2">Name</div>
                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" parsley-trigger="change" required value="<?php echo isset($record->name) ? $record->name : ""; ?>">
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-2">Hiển thị</div>
                    <div class="col-md-10">
                        <input type="checkbox" <?php if (isset($record->view) && $record->view == 1) : ?> checked <?php endif; ?> name="hot" id="hot"> <label for="hot"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Hiển thị banner</span></label>                     
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Ảnh</div>
                    <div class="col-md-10">
                        <input type="file" name="photo">
                    </div>
                </div>
                <!-- end rows -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</form>