<?php

trait ProductsModel
{
    //lay ve danh sach cac ban ghi
    public function modelRead($recordPerPage)
    {
        $category_id = isset($_GET["id"]) ? $_GET["id"] : 0;
        //lay bien page truyen tu url
        $page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"] - 1 : 0;
        //lay tu ban ghi nao
        $from = $page * $recordPerPage;
        //---
        //---
        $sqlOrder = "";
        $order = isset($_GET["order"]) ? $_GET["order"] : "";
        switch ($order) {
            case 'priceAsc':
                $sqlOrder = "order by price asc";
                break;
            case 'priceDesc':
                $sqlOrder = "order by price desc";
                break;
            case 'nameAsc':
                $sqlOrder = "order by name asc";
                break;
            case 'nameAsc':
                $sqlOrder = "order by name desc";
                break;
        }
        //lay bien ket noi csdl
        $conn = Connection::getInstance();
        //thuc hien truy van
        $query = $conn->query("select * from products where category_id in (select id from categories where id = $category_id or parent_id = $category_id) $sqlOrder limit $from, $recordPerPage");
        //tra ve nhieu ban ghi
        return $query->fetchAll();
    }

    //tinh tong so ban ghi
    public function modelTotalRecord()
    {
        $category_id = isset($_GET["id"]) ? $_GET["id"] : 0;
        //lay bien ket noi csdl
        $conn = Connection::getInstance();
        //thuc hien truy van
        $query = $conn->query("select * from products where category_id in (select id from categories where id = $category_id or parent_id = $category_id)");
        //tra ve so luong ban ghi
        return $query->rowCount();
    }

    //lay mot ban ghi tuong ung voi id truyen vao
    public function modelGetRecord($id)
    {
        //lay bien ket noi csdl
        $conn = Connection::getInstance();
        //thuc hien truy van
        $query = $conn->prepare("select * from products where id = :var_id");
        //thuc thi truy van, co truyen tham so vao cau lenh sql
        $query->execute(["var_id" => $id]);
        //tra ve mot ban ghi
        return $query->fetch();
    }

    public function modelGetProduct()
    {
        $category_id = isset($_GET["id"]) ? $_GET["id"] : 0;
        $conn = Connection::getInstance();
        $query = $conn->query("select * from products where category_id = $category_id  order by id desc ");
        // Trả về tất cả các bản ghi truy vấn được.
        return $query->fetchAll();
    }

    //Lấy một bản ghi danh mục sản phẩm
    public function modelGetCategory($category_id)
    {
        $conn = Connection::getInstance();
        //thuc hien truy van
        $query = $conn->query("select * from categories where id = $category_id");
        return $query->fetch();
    }

    //Đánh số sao cho sản phẩm
    public function modelRating()
    {
        $id = isset($_GET['id']) ? $_GET["id"] : 0;
        $star = isset($_GET['star']) ? $_GET['star'] : 0;
        if ($star > 0 && $id > 0) {
            //Lấy biến kết nối csdl
            $conn = Connection::getInstance();
            $conn->query("insert into rating(product_id,star) values($id,$star)");
        }
    }

    //Lấy số sao để hiển thị
    public function modelGetStar($product_id, $star)
    {
        $conn = Connection::getInstance();
        $query = $conn->query("select id from rating where product_id = $product_id and star = $star");
        //Trả về số lượng bản ghi
        return $query->rowCount();
    }

    //Lấy sub_photo
    public function modelGetSubPhoto($id)
    {
        //lay bien ket noi csdl
        $conn = Connection::getInstance();
        $query = $conn->query("select * from images where product_id = $id");
        $result = $query->fetchAll();
        return $result;
    }

    //Lấy số lượng và size
    public function modelGetProductSize($id)
    {
        //lay bien ket noi csdl
        $conn = Connection::getInstance();
        $query = $conn->query("select * from product_size where product_id = $id");
        $result = $query->fetchAll();
        return $result;
    }

    //Lấy toàn bộ các sản phẩm
    public function modelGetAllProduct()
    {
        $conn = Connection::getInstance();
        $query = $conn->query("select * from products ");
        $result = $query->fetchAll();
        return $result;
    }

    public function modelGetConditionRate($customer_id, $product_id)
    {
        //Lấy biến kết nối
        $conn = Connection::getInstance();

        //Thực hiện truy vấn
        $query = $conn->query("SELECT orders.customer_id, orders.status, orderdetails.product_id, customers.id FROM `orders` INNER JOIN orderdetails on orders.id = orderdetails.order_id INNER JOIN customers ON orders.customer_id = customers.id WHERE status = 3 AND customer_id = $customer_id AND product_id = $product_id;");

        //Trả về kết quả
        return $query->fetchAll();
    }

    public function modelGetQuantilySize($id, $size)
    {
        $conn = Connection::getInstance();
        $query = $conn->query("select * from product_size where product_id = $id and size = $size ");
        return $query->fetch();
    }

    public function modelSearchSize($category_id)
    {
        $size = isset($_POST['size']) ? $_POST['size'] : [0];
        $list_size = implode(",", $size);
        $category_id = isset($_GET['id']) ? $_GET['id'] : 0;
        $conn = Connection::getInstance();
        //thuc hien truy van
        $query = $conn->query("SELECT * FROM products WHERE id in (SELECT product_id FROM product_size WHERE size IN ($list_size) AND quantily > 0 ) and products.category_id IN (SELECT id FROM categories WHERE id = $category_id or parent_id = $category_id);");
        //tra ve tat ca ket qua
        return $query->fetchAll();

    }
}
