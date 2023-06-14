<?php

use Carbon\Carbon;

trait ProductsModel
{
	//lay ve danh sach cac ban ghi
	public function modelRead($recordPerPage)
	{
		//lay bien page truyen tu url
		$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"] - 1 : 0;
		//lay tu ban ghi nao
		$from = $page * $recordPerPage;
		//---
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from products order by id desc limit $from, $recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	//tinh tong so ban ghi
	public function modelTotalRecord()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from products");
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

	//Update sản phẩm
	public function modelUpdate($id)
	{
		$name = $_POST["name"];
		$category_id = $_POST["category_id"];
		$description = $_POST["descriptions"];
		$content = $_POST["content"];
		$hot = isset($_POST["hot"]) ? 1 : 0;
		$price = $_POST["price"];
		$discount = $_POST["discount"];
		$size = $_POST['size_product'];
		$size_product = "";
		$size_quantily = "";

		/* echo '<pre>';
		print_r($size);
		print_r($size_product);
		print_r($size_quantily);
		echo '</pre>';
		die;
 */
		//update name
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->prepare("update products set name = :var_name, category_id=:var_category_id, description=:var_description,content=:var_content,hot=:var_hot,price=:var_price,discount=:var_discount where id = :var_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_name" => $name, "var_category_id" => $category_id, "var_id" => $id, "var_description" => $description, "var_content" => $content, "var_hot" => $hot, "var_price" => $price, "var_discount" => $discount]);
		//---
		$conn->query("DELETE FROM `product_size` WHERE product_id = $id");
		foreach ($size as $row) {
			$size_product = $row['size'];
			$size_quantily = $row['quantily'];
			$conn->query("INSERT INTO `product_size`(`size`, `quantily`, `product_id`) VALUES ('$size_product','$size_quantily', '$id')");
		}
		//---
		$time = time() . "_";
		//--
		//Nếu User update Avatar

		if ($_FILES['photo']['name'] != "") {
			$photo = "";
			//---
			//lay anh cu de xoa
			$oldPhoto = $conn->query("select photo from products where id=$id");
			if ($oldPhoto->rowCount() > 0) {

				$record = $oldPhoto->fetch();
				//xoa anh
				if ($record->photo != "" && file_exists("../assets/upload/products/" . $record->photo)) {

					//xoa anh
					unlink("../assets/upload/products/" . $record->photo);
				}
			}
			//---
			$photo = time() . "_" . $_FILES['photo']['name'];
			//upload file vao thuc muc upload/products
			move_uploaded_file($_FILES['photo']['tmp_name'], "../assets/upload/products/$photo");
			$query = $conn->prepare("update products set photo=:var_photo where id=:var_id");
			$query->execute(["var_photo" => $photo, "var_id" => $id]);
		}
		//---

		//Nếu User update ảnh mô tả
		//---

		if ($_FILES['sub_photo']['name'][0] != "") {
			//Xóa ảnh cũ thay bằng ảnh mới trong thư mục.
			$oldSubPhoto = $conn->query("select * from images where product_id=$id");
			if ($oldSubPhoto->rowCount() > 0) {
				$record = $oldSubPhoto->fetchAll();

				foreach ($record as $row) {
					if ($row->photo != "" && file_exists("../assets/upload/products/" . $row->photo)) {
						//xoa anh
						var_dump($row->photo);
						unlink("../assets/upload/products/" . $row->photo);
					}
				}
			}
			//---
			$file_names = $_FILES['sub_photo']['name'];
			foreach ($file_names as $key => $value) {
				//upload file vao thuc muc upload/products
				move_uploaded_file($_FILES['sub_photo']['tmp_name'][$key], "../assets/upload/products/$time$value");
			}
			//---
			$conn->query("delete from images where product_id = $id");

			foreach ($file_names as $key => $value)
				/* var_dump($time);
			var_dump($file_names);
			die();	 */
				$conn->query("INSERT INTO `images` (`product_id`, `photo`) VALUES ('$id', '$time$value')");
		}
		if ($query) {
			$_SESSION['notify_update'] = 'Cập nhật thành công';
		} else {
			$_SESSION['notify_update'] = 'Lỗi không cập nhật được';
		}
	}

	//Thêm mới sản phẩm
	public function modelCreate()
	{
		$name = $_POST["name"];
		$category_id = $_POST["category_id"];
		$description = $_POST["descriptions"];
		$content = $_POST["content"];
		$hot = isset($_POST["hot"]) ? 1 : 0;
		$price = $_POST["price"];
		$discount = $_POST["discount"];
		$size = $_POST['size_product'];
		$size_product = "";
		$size_quantily = "";

		//---
		$time = time() . "_";
		//neu user upload anh thi thuc hien upload
		$photo = "";
		if ($_FILES['photo']['name'] != "") {
			$photo = time() . "_" . $_FILES['photo']['name'];
			//upload file vao thuc muc upload/products
			move_uploaded_file($_FILES['photo']['tmp_name'], "../assets/upload/products/$photo");
		}
		//Nếu user upload nhiều ảnh thì thực hiện
		//Kiểm tra xem file có tồn tại không rồi thực hie
		if ($_FILES['sub_photo']['name'] != "") {

			$file_names = $_FILES['sub_photo']['name'];
			foreach ($file_names as $key => $value) {

				//upload file vao thuc muc upload/products				
				move_uploaded_file($_FILES['sub_photo']['tmp_name'][$key], "../assets/upload/products/$time$value");
			}
		}

		//---
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van

		$query = $conn->prepare("insert into products set name = :var_name, category_id=:var_category_id, description=:var_description,content=:var_content,hot=:var_hot,price=:var_price,discount=:var_discount,photo=:var_photo");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_name" => $name, "var_category_id" => $category_id, "var_description" => $description, "var_content" => $content, "var_hot" => $hot, "var_price" => $price, "var_discount" => $discount, "var_photo" => $photo]);
		//Lấy id bản ghi cuối cùng vừa insert dùng hàm --- lastInsertId() ---
		$id = $conn->lastInsertId();
		foreach ($file_names as $key => $value) :
			// Thực hiện truy vấn
			$conn->query("INSERT INTO `images` (`id`, `product_id`, `photo`) VALUES (NULL, '$id', '$time$value')");
		endforeach;

		foreach ($size as $rows) {
			$size_product = $rows['size'];
			$size_quantily = $rows['quantily'];
			$conn->query("INSERT INTO product_size (product_id, size, quantily) VALUES ($id, $size_product, $size_quantily)");
		}

		if ($query) {
			$_SESSION['notify_success'] = 'Thêm mới thành công';
		} else {
			$_SESSION['notify_success'] = 'Lỗi không thêm được';
		}
		header("location:index.php?controller=products");
	}

	//function Xóa sản phẩm
	public function modelDelete($id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//---
		//lay anh cu de xoa
		$oldPhoto = $conn->query("select photo from products where id=$id");
		if ($oldPhoto->rowCount() > 0) {
			$record = $oldPhoto->fetch();
			//xoa anh
			if ($record->photo != "" && file_exists("../assets/upload/products/" . $record->photo)) {
				//xoa anh
				unlink("../assets/upload/products/" . $record->photo);
			}
		}
		$oldSubPhoto = $conn->query("select photo from images where product_id=$id");
		if ($oldSubPhoto->rowCount() > 0) {
			$record = $oldSubPhoto->fetchAll();
			foreach ($record as $row) {
				if ($row->photo != "" && file_exists("../assets/upload/products/" . $row->photo)) {
					//xoa anh
					unlink("../assets/upload/products/" . $row->photo);
				}
			}
		}
		//---
		//thuc hien truy van
		$query = $conn->prepare("delete from products where id = :var_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_id" => $id]);
		$conn->query("delete from images where product_id = $id");
		$conn->query("delete from product_size where product_id = $id");

		if ($query) {
			$_SESSION['notify_delete'] = 'Xóa thành công thành công';
		} else {
			$_SESSION['notify_delete'] = 'Lỗi không xóa được ';
		}
	}

	//liet ke cac danh muc cap 1 (cap con cua cap cha)
	public function modelCategoriesSub($category_id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		$query = $conn->query("select * from categories where parent_id = $category_id order by id desc");
		//tra ve tat ca cac ket qua lay duoc
		return $query->fetchAll();
	}

	//liet ke cac danh muc cap 0
	public function modelCategories()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		$query = $conn->query("select * from categories where parent_id = 0 order by id desc");
		//tra ve tat ca cac ket qua lay duoc
		return $query->fetchAll();
	}

	//lay ten danh muc
	public function modelGetCategory($category_id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		$query = $conn->query("select * from categories where id = $category_id");
		//tra ve tat ca cac ket qua lay duoc
		$result = $query->fetch();
		return $result->name;
	}

	//Lấy sub_photo
	public function modelGetSubPhoto($id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		$query = $conn->query("select * from images where product_id = $id");
		return $query->fetchAll();
	}

	public function modelGetSaleProduct()
	{
		$conn = Connection::getInstance();
		$query = $conn->query("SELECT orderdetails.product_id,products.*, SUM(orderdetails.quantity) FROM orders INNER JOIN orderdetails ON orders.id = orderdetails.order_id INNER JOIN products ON products.id = orderdetails.product_id GROUP BY orderdetails.product_id order by SUM(orderdetails.quantity) desc");
		return $query->fetchAll();
	}

	public function modelGetSaleProductDay($thoigian)
	{
		$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
		$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
		if ($thoigian == '7days') {
			$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
		} else if ($thoigian == '28days') {
			$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(28)->toDateString();
		} else if ($thoigian == '90days') {
			$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(90)->toDateString();
		} else if ($thoigian == '365days') {
			$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
		}

		$conn = Connection::getInstance();
		$query = $conn->query("SELECT orderdetails.product_id,products.*, SUM(orderdetails.quantity) FROM orders INNER JOIN orderdetails ON orders.id = orderdetails.order_id INNER JOIN products ON products.id = orderdetails.product_id WHERE orders.date BETWEEN '$subdays' AND '$now' GROUP BY orderdetails.product_id order by SUM(orderdetails.quantity) DESC;");
		return $query->fetchAll();
	}

	public function modeGetSearchProductsID()
	{
		$key = isset($_GET["search_key"]) ? $_GET["search_key"] : "";
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from products where id like '%$key%'");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}

	public function modeGetSearchName()
	{
		$key = isset($_GET["search_key"]) ? $_GET["search_key"] : "";
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from products where name like '%$key%'");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}

	public function modelGetSearchNameCategory()
	{
		$key = isset($_GET["search_key"]) ? $_GET["search_key"] : "";
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT * FROM categories INNER JOIN products ON categories.id = products.category_id WHERE categories.name LIKE '%$key%';");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}

	public function modelGetSearchPrice($from, $to)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from products where price between '$from' and '$to' order by price desc");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}

	public function modelGetProductCategory()
	{
		$id = isset($_GET["id"]) ? $_GET["id"] : "";
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT * FROM categories INNER JOIN products ON categories.id = products.category_id WHERE categories.id = $id");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}

	public function modelGetSizeProduct($id){		
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT * FROM product_size where product_id = $id");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
}
