<?php
trait HomeModel
{
    //sản phẩm nổi bật
    public function modelHotProduct()
    {
        $conn = Connection::getInstance();
        $query = $conn->query("select * from products where hot = 1 order by id desc limit 0,12");
        // Trả về tất cả các bản ghi truy vấn được.
        return $query->fetchAll();
    }

    //Lây các danh mục có chứa các sản phẩm
    public function modelCategories()
    {
        $conn = Connection::getInstance();
        $query = $conn->query("select * from categories where id in (select category_id from products)");
        //trả về tất cả bản ghi
        return $query->fetchAll();
    }
    // Lấy 10 bản tin nổi bật để hiển thị ở trang chủ
    public function modelHotNews()
    {
        $conn = Connection::getInstance();
        $query = $conn->query("select * from news where hot = 1 order by id desc limit 0,6");
        //trả về tất cả bản ghi
        return $query->fetchAll();
    }
    // Lấy các sản phẩm thuộc danh mục
    public function modelProducts($categories_id)
    {
        $conn = Connection::getInstance();
        $query = $conn->query("select * from products where category_id=$categories_id order by id desc limit 0,6");

        return $query->fetchAll();
    }

    public function modelGetNewProduct(){
        $conn = Connection::getInstance();
        $query = $conn->query("select * from products order by id desc limit 0,12");
        // Trả về tất cả các bản ghi truy vấn được.
        return $query->fetchAll();
    }
}
