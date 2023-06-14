<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>

<form method="post" action="<?php echo $action; ?>">
    <div class="col-lg-6" style="max-width: 100%">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Tài khoản Admin</h4>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-2">Name</div>
                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" parsley-trigger="change" required value="<?php echo isset($record->name) ? $record->name : ""; ?>">
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-2">Category</div>
                    <div class="col-md-2">
                        <select name="parent_id" class="custom-select">
                            <option value="0"></option>
                            <?php
                            $category_id = isset($record->id) ? $record->id : 0;
                            $categories = $this->modelCategories($category_id);
                            ?>
                            <?php foreach ($categories as $rows) : ?>
                                <option <?php if (isset($record->parent_id) && $record->parent_id == $rows->id) : ?> selected <?php endif; ?> value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                    <button class="btn btn-success waves-effect width-md waves-light" type="submit">
                        Submit
                    </button>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</form>