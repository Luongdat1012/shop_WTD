<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php";
?>
<?php if ($_SESSION['email'][0]['roles']->role_create == 1) : ?>
    <div class="card-body">
        <div class="button-list" style="text-align: right; margin-right: -5px;">
            <!-- Large modal -->
            <a href="index.php?controller=banners&action=create" class="btn btn-primary waves-effect waves-light">Thêm mới</a>
        </div>
    </div>
<?php endif; ?>
<div class="col-lg-6" style="max-width: 100%">
    <div class="card">
        <div class="card-body">


            <div class="table-responsive">
                <table style="text-align: center;" class="table table-bordered mb-0">
                    <thead>
                        <tr style="background-color: black; color: white;">
                            <th>Name</th>
                            <th>Image</th>
                            <th>Hiển thị</th>
                            <?php if ($_SESSION['email'][0]['roles']->role_fix == 1) : ?>
                                <th></th>
                            <?php endif; ?>

                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($data as $row) : ?>
                            <tr style="color: black; font-weight: bold;">
                                <td style="vertical-align: middle; text-align: left; "><?php echo $row->name ?></td>
                                <td style=""><?php if ($row->photo != "" && file_exists("../assets/upload/banners/" . $row->photo)) : ?>
                                        <img style="width: 100px;" src="../assets/upload/banners/<?php echo $row->photo; ?>">
                                    <?php endif; ?>
                                </td>
                                <td style="width: 10%;">
                                    <?php if (isset($row->view) && $row->view == 1) : ?>
                                        <span class="fa fa-check"></span>
                                    <?php endif; ?>
                                </td>
                                <?php if ($_SESSION['email'][0]['roles']->role_fix == 1) : ?>
                                    <td style="vertical-align: middle;">
                                        <a href="index.php?controller=banners&action=update&id=<?php echo $row->id; ?>" class="btn btn-icon waves-effect waves-light btn-success"><i class="fas fa-pencil-alt"></i></a>

                                        <a href="index.php?controller=banners&action=delete&id=<?php echo $row->id; ?>" class="btn btn-icon waves-effect waves-light btn-danger" onclick="return window.confirm('Ban co muon xoa Banner nay?')"><i class="fas fa-trash"></i></a>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <nav style="float: right;">
        <ul class="pagination pagination-split">
            <li class="page-item">
                <a class="page-link" href="index.php?controller=banners&p=<?php echo $i; ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $numPage; $i++) : ?>
                <li class="page-item"><a class="page-link" href="index.php?controller=banners&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="index.php?controller=banners&p=<?php echo $i; ?>" aria-label="Next">
                    <span aria-hidden="true">»</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- Xử lý thông báo -->
<!-- Xử lý thông báo -->
<?php if (isset($_SESSION['notify_success'])) : ?>
    <div style="position: absolute; top: 15px; right: 15px; z-index: 100;" class="alert alert-success col-3" role="alert" id="alert">
        <strong><?php echo $_SESSION['notify_success'] ?></strong>
    </div>
<?php elseif (isset($_SESSION['notify_delete'])) : ?>
    <div style="position: absolute; top: 15px; right: 15px; z-index: 100;" class="alert alert-danger col-3" role="alert" id="alert">
        <strong><?php echo $_SESSION['notify_delete'] ?></strong>
    </div>
<?php elseif (isset($_SESSION['notify_update'])) : ?>
    <div style="position: absolute; top: 15px; right: 15px; z-index: 100;" class="alert alert-info col-3" role="alert" id="alert">
        <strong><?php echo $_SESSION['notify_update'] ?></strong>
    </div>
<?php endif; ?>

<?php
if (isset($_SESSION['notify_success']) || isset($_SESSION['notify_delete']) || isset($_SESSION['notify_update'])) : ?>
    <script>
        $(document).ready(function() {
            $("#alert").fadeIn(5000);
            $("#alert").animate({
                right: '-50px',
                opacity: "0"
            }, 4000);
        });
    </script>
<?php
    unset($_SESSION['notify_success']);
    unset($_SESSION['notify_delete']);
    unset($_SESSION['notify_update']);
endif;
?>