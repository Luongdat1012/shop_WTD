<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;

trait ThongKeModel
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
		$query = $conn->query("select * from thongke order by id desc limit $from, $recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	//tinh tong so ban ghi
	public function modelTotalRecord()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from thongke");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}	

	public function modelThongKe($subdays, $now)
	{

		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from thongke where ngaydat between '$subdays' and '$now' order by ngaydat asc");

		//tra ve mot ban ghi
		return $query->fetchAll();
	}

	//Lấy các đơn hàng đã hoàn tất
	public function modelGetOrderSubmit($now)
	{
		$conn = Connection::getInstance();
		//thuc hien truy 
		$query = $conn->query("select * from orders where status = 3 and date = '$now'");
		return $query->fetchAll();
	}

	//Kiểm tra xem có đơn hàng nào chưa ở bàng thống kê
	public function modelGetCountThongKe($now)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from thongke where ngaydat = '$now'");
		
		return count($query->fetchAll());
	}

	public function modelGetCountOrder($now)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from orders where date = '$now' and status = 3");
		return $query->fetchAll();
	}

	public function modelUpdateThongKe($donhang, $doanhthu, $now)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$conn->query("UPDATE `thongke` SET `donhang`='$donhang',`doanhthu`='$doanhthu' WHERE ngaydat = '$now'");
	}

	public function modelInsertThongKe($donhang, $doanhthu, $now)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$conn->query("INSERT INTO `thongke`(`ngaydat`, `donhang`, `doanhthu`) VALUES ('$now','$donhang','$doanhthu')");
	}

	public function modelGetOrderDetail($date, $recordPerPage){
		$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"] - 1 : 0;
		//lay tu ban ghi nao
		$from = $page * $recordPerPage;
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT orders.id as madonhang, orders.price as giatridonhang, customers.name as tenkhachhang, products.name as tensanpham, orderdetails.quantity as soluong, orderdetails.price as dongia, products.photo FROM orders INNER JOIN orderdetails on orders.id = orderdetails.order_id INNER JOIN customers ON orders.customer_id=customers.id INNER JOIN products ON products.id = orderdetails.product_id WHERE orders.date = '$date' limit $from, $recordPerPage");
		return $query->fetchAll();
	}

	public function modelTotalOrderDetail($date){
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT orders.id as madonhang, orders.price as giatridonhang, customers.name as tenkhachhang, products.name as tensanpham, orderdetails.quantity as soluong, orderdetails.price as dongia, products.photo FROM orders INNER JOIN orderdetails on orders.id = orderdetails.order_id INNER JOIN customers ON orders.customer_id=customers.id INNER JOIN products ON products.id = orderdetails.product_id WHERE orders.date = '$date'");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	
	public function modeGetSearchDate($date_start, $date_end)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from thongke where ngaydat between '$date_start' and '$date_end'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}
	
}
