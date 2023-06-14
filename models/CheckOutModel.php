<?php

use Carbon\Carbon;

trait CheckOutModel
{
	//Lấy thông tin người đặt.
	public function modelGetCustomers()
	{
		$id = isset($_SESSION["customer_id"]) ? $_SESSION["customer_id"] : "";
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from customers where id= $id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetch();
	}
	//Lấy tên các tỉnh thành
	public function modelGetProvince()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from province");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchALl();
	}
	//Lấy tên các huyện trực thuộc thành phố
	public function modelGetDistrict($provinceid)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from district where provinceid ='$provinceid'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}
	//Lấy tên các TT/Phường trực thuộc quận/ huyện.
	public function modelGetWard($districtid)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from ward where districtid ='$districtid'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}
	//Lấy tên các Tổ/Xã Trực thuộc TT/ Phường.
	public function modelGetVillage($ward)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from village where wardid ='$ward'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}
	// Tính tổng số tiền của đơn hàng
	public function cartTotal()
	{
		$total = 0;
		foreach ($_SESSION['cart'] as $rows) {
			foreach ($rows as $product) {
				$total += ($product['price'] - $product['price'] * $product['discount'] / 100) * $product['number'];
			}
		}
		return $total;
	}

	//Checkout cart
	public function modelCheckOutCart()
	{
		$conn = Connection::getInstance();
		//lay id vua moi insert
		$customer_id = $_SESSION["customer_id"];
		$note = isset($_POST['note']) ? $_POST['note'] : "";
		//---
		$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
		//---

		//Insert các thông tin địa chỉ khách hàng
		$name = isset($_POST['name']) ? $_POST['name'] : "";
		$email = isset($_POST['email']) ? $_POST['email'] : "";
		$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
		$address = isset($_POST['address']) ? $_POST['address'] : "";
		$provinceid = isset($_POST['provice']) ? $_POST['provice'] : "";
		$districtid = isset($_POST['district']) ? $_POST['district'] : "";
		$wardid = isset($_POST['ward']) ? $_POST['ward'] : "";
		$villageid = isset($_POST['village']) ? $_POST['village'] : "";

		$conn->query("UPDATE `customers` SET `name`='$name',`email`='$email',`address`='$address',`phone`='$phone',`provinceid`='$provinceid',`districtid`='$districtid',`wardid`='$wardid',`villageid`='$villageid' WHERE id = $customer_id");

		//lay tong gia cua gio hang
		$price = $this->cartTotal();
		
		$query = $conn->prepare("insert into orders set customer_id=:customer_id, date='$now', price=:price, note = '$note'");
		$query->execute(array("customer_id" => $customer_id, "price" => $price));


		/* echo '<pre>';
		echo print_r($_POST);
		echo '</pre>';				
		die(); */
		//insert các thông số vào database customers

		//insert ban ghi vao orders, lay order_id vua moi insert
		$order_id = $conn->lastInsertId();
		//---
		//duyet cac ban ghi trong session array de insert vao orderdetails
		foreach ($_SESSION["cart"] as $rows) {
			foreach ($rows as $product) {
				
				$query = $conn->prepare("insert into orderdetails set order_id=:order_id, product_id=:product_id, price=:price, quantity=:quantity, size =:size");
				$price = $product["price"] - ($product["price"] * $product["discount"]) / 100;
				$query->execute(array("order_id" => $order_id, "product_id" => $product["id"], "price" => $price, "quantity" => $product["number"], "size" => $product['size']));
			}
		}
		//xoa gio hang
		unset($_SESSION["cart"]);
	}
	//=============
	//Checkout products
	public function modelCheckOutProduct()
	{
		$conn = Connection::getInstance();
		//lay id vua moi insert
		$customer_id = $_SESSION["customer_id"];
		$note = isset($_POST['note']) ? $_POST['note'] : "";
		//---
		$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
		//---


		//Insert các thông tin địa chỉ khách hàng
		$name = isset($_POST['name']) ? $_POST['name'] : "";
		$email = isset($_POST['email']) ? $_POST['email'] : "";
		$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
		$address = isset($_POST['address']) ? $_POST['address'] : "";
		$provinceid = isset($_POST['provice']) ? $_POST['provice'] : "";
		$districtid = isset($_POST['district']) ? $_POST['district'] : "";
		$wardid = isset($_POST['ward']) ? $_POST['ward'] : "";
		$villageid = isset($_POST['village']) ? $_POST['village'] : "";

		$conn->query("UPDATE `customers` SET `name`='$name',`email`='$email',`address`='$address',`phone`='$phone',`provinceid`='$provinceid',`districtid`='$districtid',`wardid`='$wardid',`villageid`='$villageid' WHERE id = $customer_id");

		//lay tong gia cua gio hang
		$price = isset($_POST['price']) ? $_POST['price'] : "";
		$query = $conn->prepare("insert into orders set customer_id=:customer_id, date='$now', price=:price, note = '$note'");
		$query->execute(array("customer_id" => $customer_id, "price" => $price));


		//insert ban ghi vao orders, lay order_id vua moi insert
		$order_id = $conn->lastInsertId();
		//---
		//duyet cac ban ghi trong session array de insert vao orderdetails
		$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : "";
		$query = $conn->prepare("insert into orderdetails set order_id=:order_id, product_id=:product_id, price=:price, quantity = 1");
		$query->execute(array("order_id" => $order_id, "product_id" => $product_id, "price" => $price));
	}
	//=============

	//Lấy tên các Tỉnh/ Thành phố bằng id
	public function modelGetProvinceUser($provinceid)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from province where provinceid ='$provinceid'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetch();
	}
	//Lấy tên các Tỉnh/ Thành phố bằng id
	public function modelGetDistrictUser($district)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from district where districtid ='$district'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetch();
	}
	//Lấy tên các Phường/ Xã phố bằng id
	public function modelGetWardUser($Ward)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from ward where wardid ='$Ward'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetch();
	}
	//Lấy tên các TT/ Tổ bằng id
	public function modelGetVillageUser($village)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from village where villageid ='$village'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetch();
	}

	//Lấy thông tin sản phẩm khi thanh toán.
	public function modelGetProduct($id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from products where id = $id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetch();
	}

	public function cartNumber()
	{
		$number = 0;
		foreach ($_SESSION['cart'] as $rows) {
			foreach ($rows as $product) {
				$number += $product['number'];
			}
		}
		return $number;
	}
}
