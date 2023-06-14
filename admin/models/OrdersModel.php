<?php

use Carbon\Carbon;

trait OrdersModel
{
			/* echo '<pre>';
			print_r($demo);
			echo '</pre>';
			die; */
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
		$query = $conn->query("select * from orders order by id desc limit $from, $recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	//tinh tong so ban ghi
	public function modelTotalRecord()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from orders");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//lay mot ban ghi tuong ung voi id truyen vao
	public function modelGetCustomer($customer_id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->prepare("select * from customers where id = :var_customer_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_customer_id" => $customer_id]);
		//tra ve mot ban ghi
		return $query->fetch();
	}
	public function modelOrdersDetail($order_id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->prepare("select * from orderdetails where order_id = :var_order_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_order_id" => $order_id]);
		//tra ve mot ban ghi
		return $query->fetchAll();
	}
	public function modelGetProduct($product_id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->prepare("select * from products where id = :var_product_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_product_id" => $product_id]);
		//tra ve mot ban ghi
		return $query->fetch();
	}
	// Lấy giá trị đơn hàng
	public function modelGetPriceOrder($id)
	{
		$ngaydat = $this->modelGetDate($id)->date;
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select price from orders where date = '$ngaydat' and status = 3");

		return $query->fetchAll();
	}

	//Hàm lấy thông tinh đơn hàng theo id;
	public function modelGetDate($id)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select date from orders where id = $id");

		return $query->fetch();
	}
	// Đếm bản ghi trong thống kê thay ngày	
	public function modelGetThongKe($id)
	{
		$ngaydat = $this->modelGetDate($id)->date;
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from thongke where ngaydat = '$ngaydat'");
		return $query->fetchAll();
	}
	//Hàm lấy số lượng sản phẩm
	public function modelGetQuantity($id)
	{
		$ngaydat = $this->modelGetDate($id)->date;
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT orderdetails.quantity FROM orders INNER JOIN orderdetails ON orders.id = orderdetails.order_id WHERE orders.date = '$ngaydat'");
		return $query->fetchAll();
	}	

	//Lấy thông tin của orderdetail theo id đơn hàng.
	public function modelGetOrderDetailQuantily($id){
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from orderdetails where order_id =$id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}
	//Lấy số lượng của sẩn phẩm theo size trong bảng size.
	public function modelGetSizeQuantily($id, $size){
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select quantily from product_size where product_id = $id and size = $size");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetch();
	}
	//Hàm cập nhật trạng thái sản phẩm và update thống kê
	public function modelDelivery($id)
	{
		$status = isset($_GET['status']) ? $_GET['status'] : 0;
		$status++;
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//echo $status;
		//die;
		if ($status == 3) {
			$query = $conn->query("update orders set status = $status where id = $id");	

			//Update số lượng size của đơn vừa mua vào bảng size
			$orderdetail  = $this->modelGetOrderDetailQuantily($id);	
			$size_quantily = 0;
			$quantily = 0;
			foreach($orderdetail as $rows){	
				$size_quantily = $this->modelGetSizeQuantily($rows->product_id,$rows->size);
				$quantily = $size_quantily->quantily - $rows->quantity;				
				$conn->query("update product_size set quantily = $quantily where product_id = $rows->product_id and size = $rows->size");
			}
			
			/* echo '<pre>';
			print_r($orderdetail);
			echo '</pre>';			
			die; */
			//Cập nhật quantily
			
			//đếm xem bản ghi của ngày hôm đó > 0 thì update còn không thì insert
			if (count($this->modelGetThongKe($id)) > 0) {

				$quantity = $this->modelGetQuantity($id);
				$totalQuantity = 0;
				foreach ($quantity as $row) {
					$totalQuantity += $row->quantity;
				}
				$ngaydat = $this->modelGetDate($id)->date;
				$totalOrder = $this->modelGetPriceOrder($id);
				$doanhthu = 0;
				foreach ($totalOrder as $rows) {
					$doanhthu += $rows->price;
				}
				
				$donhang = $this->modelGetThongKe($id)[0]->donhang + 1;
				$conn->query("update thongke set doanhthu = $doanhthu, donhang = $donhang, soluongban = $totalQuantity where ngaydat = '$ngaydat'");
			} else {
				$quantity = $this->modelGetQuantity($id);
				$totalQuantity = 0;
				foreach ($quantity as $row) {
					$totalQuantity += $row->quantity;
				}
				$ngaydat = $this->modelGetDate($id)->date;
				$totalOrder = $this->modelGetPriceOrder($id);
				$doanhthu = 0;
				foreach ($totalOrder as $rows) {
					$doanhthu += $rows->price;
				}

				$query = $conn->query("insert thongke set doanhthu = $doanhthu, donhang = 1 , ngaydat = '$ngaydat', soluongban = $totalQuantity ");
			}

			if ($query) {
				$_SESSION['status_3'] = 'Xác nhận hoàn tất đơn hàng';
			} else {
				$_SESSION['status_3'] = 'Lỗi';
			}
		} else {

			//thuc hien truy van
			$query = $conn->query("update orders set status = $status where id = $id");
			if ($query && $status == 1) {
				$_SESSION['status_1'] = 'Đã xác nhận đơn hàng';
			} elseif ($query && $status == 2) {
				$_SESSION['status_' . $status] = 'Xác nhận giao hàng';
			
			} 
		}
	}
	public function modelCancel($id)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("update orders set status = 4 where id = $id");
		if ($query) {
			$_SESSION['status_4'] = 'Đã xác nhận hủy đơn';
		}
	}
	public function modelSubmit($status)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from orders where status = $status");
		return $query->fetchAll();
	}

	public function modelAddress($provinceid, $districtid, $wardid, $villageid)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT province.name AS province_name, district.name as district_name, ward.name AS ward_name, village.name AS village_name FROM village INNER JOIN ward ON village.wardid = ward.wardid INNER JOIN district ON ward.districtid = district.districtid INNER JOIN province ON province.provinceid = district.provinceid WHERE village.villageid = '$villageid' AND ward.wardid='$wardid' AND province.provinceid='$provinceid' AND district.districtid = '$districtid'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetch();
	}

	public function modelGetNumber($id)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT orderdetails.quantity as number FROM orderdetails INNER JOIN orders ON orderdetails.order_id = orders.id WHERE orderdetails.order_id = $id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}

	public function modeGetSearchDate($date_start, $date_end)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from orders where date between '$date_start' and '$date_end'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}

	public function modeGetSearchOrderID()
	{
		$key = isset($_GET["search_key"]) ? $_GET["search_key"] : "";
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from orders where id like '%$key%' ");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}

	public function modeGetSearchName()
	{
		$key = isset($_GET["search_key"]) ? $_GET["search_key"] : "";
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT orders.*, customers.name FROM `orders` INNER JOIN customers ON orders.customer_id = customers.id where customers.name like '%$key%'");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}

	public function modelSearchPrice($from, $to)
	{
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from orders where price between '$from' and '$to'");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}
}
