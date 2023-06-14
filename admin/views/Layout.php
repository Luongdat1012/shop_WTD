<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Amin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="Responsive bootstrap 4 admin template" name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="../assets/admin/layout1/images/favicon.ico" />

  <!-- Plugins css-->
  <link href="../assets/admin/layout1/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="../assets/admin/layout1/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
  <link href="../assets/admin/layout1/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/admin/layout1/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />


  <!-- Load file css Moris -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <!-- load file ckeditor vao day -->
  <script type="text/javascript" src="../assets/admin/ckeditor/ckeditor.js"></script>

  <!-- Boostrap 4 -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
  <!-- Begin page -->
  <div id="wrapper">
    <!-- Topbar Start -->
    <div class="navbar-custom">
      <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list">
          <div class="dropdown-menu dropdown-menu-right dropdown-lg">
            <!-- item-->
            <div class="dropdown-item noti-title">
              <h5 class="font-16 m-0">
                <span class="float-right">
                  <a href="" class="text-dark">
                    <small>Clear All</small>
                  </a> </span>Chat
              </h5>
            </div>

            <div class="slimscroll noti-scroll">
              <div class="inbox-widget">
                <a href="#">
                  <div class="inbox-item">
                    <div class="inbox-item-img">
                      <img src="../assets/admin/layout1/images/users/avatar.jpg" class="rounded-circle" alt="" />
                    </div>
                    <p class="inbox-item-author">Cristina Pride</p>
                    <p class="inbox-item-text text-truncate">
                      Hi, How are you? What about our next meeting
                    </p>
                  </div>
                </a>
                <a href="#">
                  <div class="inbox-item">
                    <div class="inbox-item-img">
                      <img src="../assets/admin/layout1/images/users/avatar-2.jpg" class="rounded-circle" alt="" />
                    </div>
                    <p class="inbox-item-author">Sam Garret</p>
                    <p class="inbox-item-text text-truncate">
                      Yeah everything is fine
                    </p>
                  </div>
                </a>
                <a href="#">
                  <div class="inbox-item">
                    <div class="inbox-item-img">
                      <img src="../assets/admin/layout1/images/users/avatar-3.jpg" class="rounded-circle" alt="" />
                    </div>
                    <p class="inbox-item-author">Karen Robinson</p>
                    <p class="inbox-item-text text-truncate">
                      Wow that's great
                    </p>
                  </div>
                </a>
                <a href="#">
                  <div class="inbox-item">
                    <div class="inbox-item-img">
                      <img src="../assets/admin/layout1/images/users/avatar-4.jpg" class="rounded-circle" alt="" />
                    </div>
                    <p class="inbox-item-author">Sherry Marshall</p>
                    <p class="inbox-item-text text-truncate">
                      Hi, How are you? What about our next meeting
                    </p>
                  </div>
                </a>
                <a href="#">
                  <div class="inbox-item">
                    <div class="inbox-item-img">
                      <img src="../assets/admin/layout1/images/users/avatar-5.jpg" class="rounded-circle" alt="" />
                    </div>
                    <p class="inbox-item-author">Shawn Millard</p>
                    <p class="inbox-item-text text-truncate">
                      Yeah everything is fine
                    </p>
                  </div>
                </a>
              </div>
              <!-- end inbox-widget -->
            </div>
            <!-- All-->
            <a href="javascript:void(0);" class="
                  dropdown-item
                  text-center text-primary
                  notify-item notify-all
                ">
              View all
              <i class="fi-arrow-right"></i>
            </a>
          </div>
        </li>

        <li class="dropdown notification-list">
          <a class="nav-link dropdown-toggle waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <i class="mdi mdi-bell-outline noti-icon"></i>
            <span class="badge badge-pink rounded-circle noti-icon-badge">4</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-lg">
            <!-- item-->
            <div class="dropdown-item noti-title">
              <h5 class="font-16 m-0">
                <span class="float-right">
                  <a href="" class="text-dark">
                    <small>Clear All</small>
                  </a> </span>Notification
              </h5>
            </div>

            <div class="slimscroll noti-scroll">
              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon">
                  <i class="mdi mdi-comment-account-outline text-info"></i>
                </div>
                <p class="notify-details">
                  Caleb Flakelar commented on Admin
                  <small class="noti-time">1 min ago</small>
                </p>
              </a>

              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon text-success">
                  <i class="mdi mdi-account-plus text-primary"></i>
                </div>
                <p class="notify-details">
                  New user registered.
                  <small class="noti-time">5 hours ago</small>
                </p>
              </a>

              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon text-danger">
                  <i class="mdi mdi-heart text-danger"></i>
                </div>
                <p class="notify-details">
                  Carlos Crouch liked
                  <small class="noti-time">3 days ago</small>
                </p>
              </a>

              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon text-warning">
                  <i class="mdi mdi-comment-account-outline text-primary"></i>
                </div>
                <p class="notify-details">
                  Caleb Flakelar commented on Admi
                  <small class="noti-time">4 days ago</small>
                </p>
              </a>

              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon text-purple">
                  <i class="mdi mdi-account-plus text-danger"></i>
                </div>
                <p class="notify-details">
                  New user registered.
                  <small class="noti-time">7 days ago</small>
                </p>
              </a>

              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon text-danger">
                  <i class="mdi mdi-heart text-danger"></i>
                </div>
                <p class="notify-details">
                  Carlos Crouch liked <b>Admin</b>.
                  <small class="noti-time">Carlos Crouch liked</small>
                </p>
              </a>
            </div>

            <!-- All-->
            <a href="javascript:void(0);" class="dropdown-item text-center notify-item notify-all">
              See all notifications
            </a>
          </div>
        </li>

        <li class="dropdown notification-list">
          <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <img src="./../assets/admin/layout1/images/users/Avatar.jpg" alt="user-image" class="rounded-circle" />
            <span class="pro-user-name ml-1">
              <?php foreach ($_SESSION['email'] as $key) echo $key['email'] ?> <i class="mdi mdi-chevron-down"></i>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right profile-dropdown">
            <!-- item-->
            <div class="dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome !</h6>
            </div>

            <!-- item-->
            <a href="../index.php" class="dropdown-item notify-item">
              <i class="mdi mdi-settings-outline"></i>
              <span>Chuyển sang trang khách hàng</span>
            </a>

            <div class="dropdown-divider"></div>

            <!-- item-->
            <a href="index.php?controller=login&action=logout" class="dropdown-item notify-item">
              <i class="mdi mdi-logout-variant"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>

        <li class="dropdown notification-list">
          <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">
            <i class="mdi mdi-settings-outline noti-icon"></i>
          </a>
        </li>
      </ul>

      <!-- LOGO -->
      <div class="logo-box">

        <a href="index.html" class="logo text-center logo-light">
          <span class="logo-lg">
            <img src="./../assets/admin/layout1/images/logo_admin.png" alt="" height="70px" />
            <!-- <span class="logo-lg-text-dark">Velonic</span> -->
          </span>
          <span class="logo-sm">
            <!-- <span class="logo-lg-text-dark">V</span> -->
            <img src="../assets/admin/layout1/logo_admin.png" alt="" height="22" />
          </span>
        </a>
      </div>

      <!-- LOGO -->

      <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
          <button class="button-menu-mobile waves-effect">
            <i class="mdi mdi-menu"></i>
          </button>
        </li>
        <ol style="margin: 0; padding: 0; line-height: 70px ;" class="breadcrumb mb-3">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Library</a></li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </ul>
    </div>

    <!-- end Topbar -->
    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu">
      <div class="slimscroll-menu">
        <!--- Sidemenu -->

        <div id="sidebar-menu">
          <ul class="metismenu" id="side-menu">
            <!-- Danh mục Home -->
            <li>
              <a href="index.php" class="waves-effect">
                <i class="ion ion-ios-home"></i>
                <span> Home </span>
              </a>
            </li>
            <!-- end danh mục Home -->



            <!-- Danh mục Quản lý đơn hàng -->
            <li style="<?php if (isset($_SESSION['email'][0]['roles']->role_order) && $_SESSION['email'][0]['roles']->role_order == 0) : ?> display: none; <?php endif; ?>">
              <a href="javascript: void(0);" class="waves-effect">
                <i class="ion ion-md-cart"></i>
                <span> Quản lý đơn hàng </span>
                <span class="menu-arrow"></span>
              </a>

              <ul class="nav-second-level" aria-expanded="false">
                <li><a href="index.php?controller=orders">Tất cả</a></li>
                <li><a href="index.php?controller=orders&action=status&status=0">Chờ xác nhận</a></li>
                <li><a href="index.php?controller=orders&action=status&status=1">Đã xác nhận</a></li>
                <li><a href="index.php?controller=orders&action=status&status=2">Đang giao hàng</a></li>
                <li><a href="index.php?controller=orders&action=status&status=3">Đã giao hàng</a></li>
                <li><a href="index.php?controller=orders&action=status&status=4">Đã hủy</a></li>
              </ul>
            </li>
            <!-- end danh mục Quản lý đơn hàng -->

            <!-- Danh mục Quản lý danh mục -->
            <li style="<?php if (isset($_SESSION['email'][0]['roles']->role_categories) && $_SESSION['email'][0]['roles']->role_categories == 0) : ?> display: none; <?php endif; ?>">
              <a href="index.php?controller=categories" class="waves-effect">
                <i class="ion-ios-list"></i>
                <span> Quản lý danh mục </span>
              </a>
            </li>
            <!-- end danh mục Quản lý danh mục -->

            <!-- Danh mục Quản lý tin tức -->
            <li style="<?php if (isset($_SESSION['email'][0]['roles']->role_news) && $_SESSION['email'][0]['roles']->role_news == 0) : ?> display: none; <?php endif; ?>">
              <a href="index.php?controller=news" class="waves-effect">
                <i class="ion-ios-apps"></i>
                <span> Quản lý tin tức </span>
              </a>
            </li>
            <!-- end danh mục Quản lý tin tức -->

            <!-- Danh mục Quản lý tài khoản -->
            <li style="<?php if (isset($_SESSION['email'][0]['roles']->role_user) && $_SESSION['email'][0]['roles']->role_user == 0) : ?> display: none; <?php endif; ?>">
              <a href="javascript: void(0);" class="waves-effect">
                <i class="ion-ios-apps"></i>
                <span> Quản lý tài khoản </span>
                <span class="menu-arrow"></span>
              </a>
              <ul class="nav-second-level" aria-expanded="false">
                <li><a href="index.php?controller=users">Admin</a></li>
                <li><a href="index.php?controller=customers">Khách hàng</a></li>
              </ul>
            </li>
            <!-- end danh mục -->


            <!-- Danh mục Thống kê doanh thu-->
            <li style="<?php if (isset($_SESSION['email'][0]['roles']->role_thongke) && $_SESSION['email'][0]['roles']->role_thongke == 0) : ?> display: none; <?php endif; ?>">
              <a href="index.php?controller=thongKe" class="waves-effect">
                <i class="fas fa-dollar-sign"></i>
                <span> Thống kê doanh thu </span>
              </a>

            </li>
            <!-- end danh mục -->

            <!-- Danh mục Quản lý sản phẩm -->

            <li style="<?php if (isset($_SESSION['email'][0]['roles']->role_product) && $_SESSION['email'][0]['roles']->role_product == 0) : ?> display: none; <?php endif; ?>">
              <a href="index.php?controller=products" class="waves-effect">
                <i class="ion-ios-apps"></i>
                <span> Quản lý sản phẩm </span>
                <!-- <span class="menu-arrow"></span> -->
              </a>
              <!-- <ul class="nav-second-level" aria-expanded="false">
                <li><a href="./Product_All.html">Tất cả</a></li>
                <li><a href="./Product_Add.html">Thêm</a></li>
              </ul> -->
            </li>
            <!-- end danh mục Quản lý đơn hàng -->


            <!-- Danh mục Quản lý bannner -->

            <li style="<?php if (isset($_SESSION['email'][0]['roles']->role_banner) && $_SESSION['email'][0]['roles']->role_banner == 0) : ?> display: none; <?php endif; ?>">
              <a href="index.php?controller=banners" class="waves-effect">
                <i class="ion-ios-apps"></i>
                <span> Quản lý Banner </span>
                <!-- <span class="menu-arrow"></span> -->
              </a>

            </li>
            <!-- end danh mục -->

          </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
      </div>
      <!-- Sidebar -left -->
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
      <div class="content">
        <!-- Start Content-->
        <div class="container-fluid" style="margin-top: 15px">
          <?php
          echo $this->view;
          ?>
        </div>
        <!-- end container-fluid -->
      </div>
      <!-- end content -->
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
  </div>
  <!-- END wrapper -->

  <!-- Right Sidebar -->
  <div class="right-bar">
    <div class="rightbar-title">
      <a href="javascript:void(0);" class="right-bar-toggle float-right">
        <i class="mdi mdi-close"></i>
      </a>
      <h4 class="font-17 m-0 text-white">Theme Customizer</h4>
    </div>
    <div class="slimscroll-menu">
      <div class="p-4">
        <div class="alert alert-warning" role="alert">
          <a href="index.php?controller=login&action=logout">Logout</a>
        </div>
        <div class="mb-2">
          <img src="../assets/admin/layout1/images/layouts/light.png" class="img-fluid img-thumbnail" alt="" />
        </div>
        <div class="custom-control custom-switch mb-3">
          <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked="" />
          <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
        </div>

        <div class="mb-2">
          <img src="../assets/admin/layout1/images/layouts/dark.png" class="img-fluid img-thumbnail" alt="" />
        </div>
        <div class="custom-control custom-switch mb-3">
          <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsstyle="../assets/admin/layout1/css/bootstrap-dark.min.css" data-appstyle="../assets/admin/layout1/css/app-dark.min.css" />
          <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
        </div>

        <div class="mb-2">
          <img src="../assets/admin/layout1/images/layouts/rtl.png" class="img-fluid img-thumbnail" alt="" />
        </div>
        <div class="custom-control custom-switch mb-5">
          <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appstyle="../assets/admin/layout1/css/app-rtl.min.css" />
          <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
        </div>
      </div>
    </div>
    <!-- end slimscroll-menu-->
  </div>
  <!-- /Right-bar -->

  <!-- Right bar overlay-->
  <div class="rightbar-overlay"></div>



  <script src="../assets/admin/layout1/libs/moment/moment.min.js"></script>
  <script src="../assets/admin/layout1/libs/jquery-scrollto/jquery.scrollTo.min.js"></script>
  <script src="../assets/admin/layout1/libs/sweetalert2/sweetalert2.min.js"></script>

  <!-- Chat app -->
  <script src="../assets/admin/layout1/js/pages/jquery.chat.js"></script>

  <!-- Todo app -->
  <script src="../assets/admin/layout1/js/pages/jquery.todo.js"></script>

  <!--Form Wizard-->
  <script src="../assets/admin/layout1/libs/jquery-steps/jquery.steps.min.js"></script>
  <!-- Sparkline charts -->
  <script src="../assets/admin/layout1/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

  <!-- Dashboard init JS -->
  <script src="../assets/admin/layout1/js/pages/dashboard.init.js"></script>
  <script src="../assets/admin/layout1/js/pages/form-wizard.init.js"></script>

  <!-- Biểu đồ morrisjs -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <!-- Vendor js -->
  <script src="../assets/admin/layout1/js/vendor.min.js"></script>
  <!-- App js -->
  <script src="../assets/admin/layout1/js/app.min.js"></script>

  


</body>

</html>