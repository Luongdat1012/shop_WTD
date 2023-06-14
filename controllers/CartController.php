<?php
include "models/CartModel.php";

class CartController extends Controller
{
    use CartModel;

    public function __construct()
    {
        //kiem tra neu gio hang chua ton tai thi khoi tao no
        if(isset($_SESSION["cart"]) == false)
            $_SESSION['cart'] = array();
    }

    //hien thi danh sach cac san pham trong gio hang
    public function index()
    {
        $this->loadView("CartView.php");
    }

    //them san pham vao gio hang
    public function create()
    {
        $id = isset($_GET["id"]) ? $_GET["id"] : 3;
        $size = isset($_GET['size']) ? $_GET['size'] : 40;
        //goi ham trong model de them phan tu vao gio hang
        $this->cartAdd($id, $size);
        header("location:index.php?controller=cart");
    }

    //xoa san pham khoi gio hang
    public function delete()
    {
        $id = isset($_GET["id"]) ? $_GET["id"] : 0;
        $size = isset($_GET["size"]) ? $_GET["size"] : 40;
        //goi ham trong model de xoa phan tu khoi gio hang
        $this->cartDelete($id, $size);
        header("location:index.php?controller=cart");
    }

    //xoa tat ca cac san pham khoi gio hang
    public function destroy()
    {
        //goi ham trong model
        $this->cartDestroy();
        header("location:index.php?controller=cart");
    }

    //cap nhat so luong san pham trong gio hang
    public function update()
    {
        // echo '<pre>';
        // print_r($_SESSION['cart']);
        // echo '</pre>';

        foreach ($_SESSION['cart'] as $rows) {
            foreach ($rows as $product) {
                $name = "product_" . $product["id"] . "_" . $product['size'];
                $number = $_POST[$name];
                $this->cartUpdate($product["id"], $product['size'], $number);
            }
        }
        header("location:index.php?controller=cart");
    }
}
