<?php 
    //load LoginModel.php
    include "models/LoginModel.php";
    class LoginController extends Controller{
        //Kế thừa class LoginModel
        use LoginModel;
        public function index(){
            //gọi view
            $this->loadView("LoginView.php");
        }
        public function login(){
            //Gọi hàm modelLogin trong class LoginModel
            $this->modelLogin();
        }
        //Đăng xuất
        public function logout(){
            //Hủy biến session
            unset($_SESSION['email']);
            //Di chuyển đến url khác
            header("location:index.php");
        }
    }
?>