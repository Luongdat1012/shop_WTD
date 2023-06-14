<?php 
    class HomeController extends Controller{
        //Hàm tạo được gọi đầu tiên
        public function __construct(){
            //Kiểm tra xem user đã đăng nhập chưa.
            $this->authentication(); //Hàm này trong file Controller.php
        }
        

        public function index(){
            //load View
            $this->loadView("HomeView.php");
        }
    }
?>