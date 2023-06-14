<?php
trait CartModel
{
	public function cartAdd($id, $size)
	{
		if (isset($_SESSION['cart'][$id][$size])) {
			//nếu đã có sp trong giỏ hàng thì số lượng lên 1
			/* echo 1;
			die; */
			$_SESSION['cart'][$id][$size]['number']++;
		} else {
			//lấy thông tin sản phẩm từ CSDL và lưu vào giỏ hàng
			//---
			//PDO
			$conn = Connection::getInstance();
			$query = $conn->prepare("select * from products where id=:id");
			$query->execute(array("id" => $id));
			$query->setFetchMode(PDO::FETCH_OBJ);
			$product = $query->fetch();
			//---
			/* echo 2;
			die; */
			$_SESSION['cart'][$id][$size] = array(
				'id' => $id,
				'size' => $size,
				'name' => $product->name,
				'photo' => $product->photo,
				'number' => 1,
				'price' => $product->price,
				'discount' => $product->discount
			);
		}
	}
	/* public function cartAddWithNumber($id, $quantity)
	{		
		if (isset($_SESSION['cart'][$id])) {
			//nếu đã có sp trong giỏ hàng thì số lượng lên 1
			$_SESSION['cart'][$id]['number'] += $quantity;
		} else {
			//lấy thông tin sản phẩm từ CSDL và lưu vào giỏ hàng
			//$product = db::get_one("select * from products where id=$id");
			//---
			//PDO
			$conn = Connection::getInstance();
			$query = $conn->prepare("select * from products where id=:id");
			$query->execute(array("id" => $id));
			$query->setFetchMode(PDO::FETCH_OBJ);
			$product = $query->fetch();
			//---

			$_SESSION['cart'][$id] = array(
				'id' => $id,
				'name' => $product->name,
				'photo' => $product->photo,
				'number' => $quantity,
				'price' => $product->price,
				'discount' => $product->discount
			);
		}
	} */
	/**
	 * Cập nhật số lượng sản phẩm
	 * @param int
	 * @param int
	 */
	public function cartUpdate($id,$size, $number)
	{
		if ($number == 0) {
			//xóa sp ra khỏi giỏ hàng
			unset($_SESSION['cart'][$id][$size]);
		} else {
			$_SESSION['cart'][$id][$size]['number'] = $number;
		}
	}
	/**
	 * Xóa sản phẩm ra khỏi giỏ hàng
	 * @param int
	 */
	public function cartDelete($id, $size)
	{
		unset($_SESSION['cart'][$id][$size]);
	}
	/**
	 * Tổng giá trị giỏ hàng
	 */
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
	/**
	 * Số sản phẩm có trong giỏ hàng
	 */
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
	/**
	 * Danh sách sản phẩm trong giỏ hàng
	 */
	public function cartList()
	{
		return $_SESSION['cart'];
	}
	/**
	 * Xóa giỏ hàng
	 */
	public function cartDestroy()
	{
		$_SESSION['cart'] = array();
	}
	//=============
	//checkout
	public function cartCheckOut()
	{
		$conn = Connection::getInstance();
		//lay id vua moi insert
		$customer_id = $_SESSION["customer_id"];
		//---
		//---
		//insert ban ghi vao orders, lay order_id vua moi insert
		//lay tong gia cua gio hang
		$price = $this->cartTotal();
		$query = $conn->prepare("insert into orders set customer_id=:customer_id, date=now(),price=:price");
		$query->execute(array("customer_id" => $customer_id, "price" => $price));

		//lay id vua moi insert
		$order_id = $conn->lastInsertId();
		//---
		//duyet cac ban ghi trong session array de insert vao orderdetails
		foreach ($_SESSION["cart"] as $product) {
			$query = $conn->prepare("insert into orderdetails set order_id=:order_id, product_id=:product_id, price=:price, quantity=:quantity");
			$price = $product["price"] - ($product["price"] * $product["discount"]) / 100;
			$query->execute(array("order_id" => $order_id, "product_id" => $product["id"], "price" => $price, "quantity" => $product["number"]));
		}


		//xoa gio hang
		unset($_SESSION["cart"]);
	}
	//=============
}
