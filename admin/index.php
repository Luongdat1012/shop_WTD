<?php
//chạy session
session_start();
//load file Connection.php
include "../application/Connection.php";
//load file Controller.php
include "../application/Controller.php";
//load file carbon
require '../assets/admin/Carbon/autoload.php';

?>

<?php
//load dong mvc dua vao tham so controller truyen len url
$controller = isset($_GET["controller"]) ? $_GET["controller"] : "Home";
$action = isset($_GET["action"]) ? $_GET["action"] : "index";
//Tạo đường dẫn vật lý của file controller trong MVC. VD: controllers/PhongBanController.php
//Hàm ucfirst(string) sẽ viết hoa ký tự đầu tiên.
$controllerFile = "controllers/" . ucfirst("$controller") . "Controller.php";
//file_exists(đường dẫn) tra ve true nếu file tồn tại ngược lại trả về false 
if (file_exists($controllerFile)) {

    include $controllerFile;
    $controllerClass = ucfirst($controller) . "Controller";
    //Khởi tạo obj của class
    $obj = new $controllerClass();
    //gọi đến action
    $obj->$action();
} else {
    die("Fiel $controllerFile không tồn tại");
}
//Hàm die("chuỗi") xuất ra thông báo chuỗi

?> 

