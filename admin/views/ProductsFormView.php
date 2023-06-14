<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>

<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
    <div class="col-lg-6" style="max-width: 100%">
        <div class="card">
            <div class="card-body">
                <?php if ($_GET['action'] == "create") : ?>
                    <h4 class="header-title mb-4">Thêm sản phẩm mới</h4>
                <?php else : ?>
                    <h4 class="header-title mb-4">Chỉnh sửa sản phẩm</h4>
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
                    <div class="col-md-2">Sản phẩm nôi bật</div>
                    <div class="col-md-10">
                        <input type="checkbox" <?php if (isset($record->hot) && $record->hot == 1) : ?> checked <?php endif; ?> name="hot" id="hot"> <label for="hot"><span style="color: black ;font-size: 14px; font-weight: bold; margin-left: 5px;">Sản phẩm nổi bật</span></label>
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-2">Giá</div>
                    <div class="col-md-10">
                        <input type="text" value="<?php echo isset($record->price) ? $record->price : ""; ?>" name="price" class="form-control" required>
                    </div>
                </div>
                <!-- end rows -->

                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">% giảm giá</div>
                    <div class="col-md-10">
                        <input type="text" value="<?php echo isset($record->discount) ? $record->discount : ""; ?>" name="discount" class="form-control" required>
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Category</div>
                    <div class="col-md-10">
                        <select name="category_id" class="form-control" style="width:200px;">
                            <?php
                            $categories = $this->modelCategories();
                            ?>
                            <?php foreach ($categories as $rows) : ?>
                                <option <?php if (isset($record->category_id) && $record->category_id == $rows->id) : ?> selected <?php endif; ?> value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>
                                <?php
                                $categoriesSub = $this->modelCategoriesSub($rows->id);
                                ?>
                                <?php foreach ($categoriesSub as $rowsSub) : ?>
                                    <option <?php if (isset($record->category_id) && $record->category_id == $rowsSub->id) : ?> selected <?php endif; ?> value="<?php echo $rowsSub->id; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rowsSub->name; ?></option>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Size</div>
                    <div class="col-md-10" id="size">
                        <?php if (isset($size) && $_GET['action'] == 'update') : ?>
                            <!-- Dùng trong update product -->                            
                            <div class="col-12" style="padding-left: 0;">
                                <label for="">&nbsp;</label>
                                <a href="javascript:void(0);" class="btn btn-success waves-effect width-md waves-light" id="add_size">Thêm mới</a>
                            </div>
                            <?php foreach ($size as $key => $rows) : ?>
                                <div class="row" id="count_item" >
                                    <div class="col-10"></div>
                                    <div class="col-4">
                                        <label for="product_size">Size</label>
                                        <input type="number" class="form-control" name="size_product[<?php echo $key ?>][size]" id="product_size" value="<?php echo $rows->size ?>">
                                    </div>
                                    <div class="col-4">
                                        <label for="quantily_size">Số lượng</label>
                                        <input type="number" class="form-control" name="size_product[<?php echo $key ?>][quantily]" id="quantily_size" value="<?php echo $rows->quantily ?>">
                                    </div>
                                    <div class="col-2">
                                        <label for="">&nbsp;</label>
                                        <a href="javascript:void(0);" class="btn btn-danger waves-effect width-md waves-light d-block" onclick="delete_(this)">Xóa</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- Kết thúc update product -->
                        <?php elseif ($_GET['action'] == 'create') : ?>
                            <!-- Dùng trong create product -->
                            <div class="row" id="count_item">
                                <div class="col-4">
                                    <label for="product_size">Size</label>
                                    <input type="number" class="form-control" name="size_product[0][size]" id="product_size">
                                </div>
                                <div class="col-4">
                                    <label for="quantily_size">Số lượng</label>
                                    <input type="number" class="form-control" name="size_product[0][quantily]" id="quantily_size">
                                </div>
                                <div class="col-2">
                                    <label for="">&nbsp;</label>
                                    <a href="javascript:void(0);" class="btn btn-success waves-effect width-md waves-light d-block" id="add_size">Thêm mới</a>
                                </div>
                            </div>
                            <!-- Kết thúc create product -->
                        <?php endif; ?>
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
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Avatar sản phẩm</div>
                    <div class="col-md-10">
                        <input type="file" name="photo" style="margin-bottom: 15px;">
                        <div class="col-md-12" style="border: 1px solid #ccc;">
                            <?php if (isset($record)) : ?>
                                <img height="150px" width="auto" src="../assets/upload/products/<?php echo $record->photo; ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Ảnh mô tả</div>
                    <div class="col-md-10">
                        <input type="file" name="sub_photo[]" multiple style="margin-bottom: 15px;">
                        <div class="col-md-12" style="border: 1px solid #ccc;">
                            <?php if (isset($image)) : ?>
                                <?php foreach ($image as $keys) : ?>
                                    <img height="150px" width="auto" src="../assets/upload/products/<?php echo $keys->photo; ?>">
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
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

<!-- Script xử lý size -->
<script>
    function delete_(__this) {
        let count_item = document.querySelectorAll("#count_item").length - 1
        count_item--;
        $(__this).closest('#count_item').remove();
    };
    $(document).ready(function() {
        $("#add_size").click(function(e) {
            count_item = document.querySelectorAll("#count_item").length - 1
            count_item++;
            $("#size").append(
                `
                    <div class="row" id="count_item">
                        <div class="col-4">
                            <label for="product_size">Size</label>
                            <input type="number" class="form-control" name="size_product[${count_item}][size]" id="product_size">
                        </div>
                        <div class="col-4">
                            <label for="quantily_size">Số lượng</label>
                            <input type="number" class="form-control" name="size_product[${count_item}][quantily]" id="quantily_size">
                        </div>                                        
                        <div class="col-2">
                            <label for="">&nbsp;</label>
                            <a href="javascript:void(0);" class="btn btn-danger waves-effect width-md waves-light d-block" onclick="delete_(this)">Xóa</a>
                        </div>
                    </div>
                `
            )
        });
    });
</script>
<!--End Script xử lý size -->