<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>

<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit news</div>
        <div class="card-body">
            <!-- muon upload duoc anh, file thi phai co thuoc tinh enctype="multipart/form-data" -->
            <form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
                <div class="col-lg-6" style="max-width: 100%">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="notify" value="success">
                            <?php if ($_GET['action'] == "create") : ?>
                                <h4 class="header-title mb-4">Thêm sản tin tức</h4>
                            <?php else : ?>
                                <h4 class="header-title mb-4">Chỉnh sửa tin tức</h4>
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
                            <div class="row" style="margin-top:5px;">
                                <div class="col-md-2">Ảnh</div>
                                <div class="col-md-10">
                                    <input type="file" name="photo">
                                </div>
                            </div>
                            <!-- end rows -->
                            <!-- rows -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-2">Tin tức HOT</div>
                                <div class="col-md-10">
                                    <input type="checkbox" <?php if (isset($record->hot) && $record->hot == 1) : ?> checked <?php endif; ?> name="hot" id="hot"> <label for="hot"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Tin tức HOT!!!</span></label>
                                </div>
                            </div>
                            <!-- end rows -->
                            <!-- rows -->
                            <div class="row" style="margin-top:5px;">
                                <div class="col-md-2">Giới thiệu</div>
                                <div class="col-md-10">
                                    <textarea name="descriptions"><?php echo isset($record->description) ? $record->description : ""; ?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("descriptions");
                                    </script>
                                </div>
                            </div>
                            <!-- end rows -->

                            <!-- rows -->
                            <div class="row" style="margin-top:5px;">
                                <div class="col-md-2">Chi tiết</div>
                                <div class="col-md-10">
                                    <textarea name="content"><?php echo isset($record->content) ? $record->content : ""; ?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("content");
                                    </script>
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

    </div>
</div>
</div>