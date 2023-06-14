<?php 
    trait LoginModel{
        public function modelLogin(){
            $email = $_POST['email'];
            $password = $_POST['password'];
            //mã hóa password
            $password = md5($password);
            //Lấy biến kết nối csdl
            $conn = Connection::getInstance();
            //Chuẩn bị truy vấn.
            $query = $conn->prepare("select email from users where email=:var_email and password=:var_password");
            //Thực thi truy vấn, truyền các tham số.
            $query->execute(["var_email"=>$email,"var_password"=>$password]);
            if($query->rowCount() > 0){
                //dang nhập thành công
                $role = $conn->query("select * from users where email = '$email'") ;               
                $result = $role->fetch();
                $role = $conn->query("select * from role where user_email = '$email'")->fetch();                
                $_SESSION['email'][] = array(
                    'email' => $email,
                    'role' => $result->role,
                    'roles'=> $role
                );
                /* echo '<pre>';
                print_r($_SESSION['email']);
                echo '</pre>';
                die(); */
                header("location:index.php");
            }else
            header("location:index.php?controller=login");
        }
    }
