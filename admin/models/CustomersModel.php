<?php
use Carbon\Carbon;
trait CustomersModel
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
		$query = $conn->query("select * from customers order by id desc limit $from, $recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	//tinh tong so ban ghi
	public function modelTotalRecord()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from customers");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//lay mot ban ghi tuong ung voi id truyen vao
	public function modelGetRecord($id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->prepare("select * from customers where id = :var_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_id" => $id]);
		//tra ve mot ban ghi
		return $query->fetch();
	}
	// Update thông tin khách hàng
	public function modelUpdate($id)
	{
		$name = $_POST["name"];
		$address = $_POST["address"];
		$phone = $_POST["phone"];
		$password = $_POST["password"];
		$provice = $_POST['provice'];
		$district = $_POST['district'];
		$ward = $_POST['ward'];
		$village = $_POST['village'];			
		//update name
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->prepare("update customers set name= '$name', address = '$address', phone = '$phone', provinceid = '$provice', districtid = '$district', wardid = '$ward', villageid = '$village' where id = :var_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_id" => $id]);		
		
		//neu password khong rong thi update password
		if ($password != "") {
			//ma hoa password
			$password = md5($password);
			//thuc hien truy van
			$query = $conn->prepare("update customers set password = :var_password where id = :var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_password" => $password, "var_id" => $id]);
		}
		if($query){
			$_SESSION['notify_update'] = 'Cập nhật thành công';
		}else{
			$_SESSION['notify_update'] = 'Lỗi không cập nhật được';
		}
	}
	//Thêm mới thông tin khách hàng
	public function modelCreate()
	{
		$name = $_POST["name"];
		$email = $_POST["email"];
		$password = $_POST["password"];	
		$address = $_POST['address'];
		$phone = $_POST['phone'];	
		$provice = $_POST['provice'];
		$district = $_POST['district'];
		$ward = $_POST['ward'];
		$village = $_POST['village'];
		
		//ma hoa password
		$password = md5($password);
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//kiem tra xem email co trung voi email da co trong csdl khong
		$queryEmail = $conn->prepare("select email from customers where email=:var_email");
		$queryEmail->execute(["var_email" => $email]);
		if ($queryEmail->rowCount() == 0) {
			//chuan bi truy van
			$query = $conn->prepare("insert into customers set name=:var_name,email=:var_email,password=:var_password,address=:var_address,phone=:var_phone,provinceid=:var_provinceid,districtid=:var_districtid,wardid=:var_wardid,villageid=:var_villageid");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_name" => $name, "var_email" => $email, "var_password" => $password, "var_address"=> $address, "var_phone"=>$phone, "var_provinceid"=>$provice, "var_districtid"=>$district, "var_wardid"=>$ward, "var_villageid"=>$village]);
			header("location:index.php?controller=customers");
			if($query){
				$_SESSION['notify_success'] = 'Thêm mới thành công';
			}else{
				$_SESSION['notify_success'] = 'Lỗi không thêm được';
			}
		} else
			header("location:index.php?controller=customers&action=create&notify=email-exists");
	}
	//Xóa thông tin khách hàng
	public function modelDelete($id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->prepare("delete from customers where id = :var_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_id" => $id]);
		$conn->query("delete from role where id_user = $id");
		if($query){
			$_SESSION['notify_delete'] = 'Xóa thành công thành công';
		}else{
			$_SESSION['notify_delete'] = 'Lỗi không xóa được ';
		}
	}
	
	public function modelGetTotalCustomer($id){
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select price from orders where customer_id = $id");		
		return $query->fetchAll();
	}

	public function modelGetOrder($id){
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from orders where customer_id = $id");		
		return $query->fetchAll();
	}	

	public function modelAddress($provinceid,$districtid,$wardid,$villageid){
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
		$query = $conn->query("SELECT orders.price as number FROM orders WHERE customer_id = $id and status = 3");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}

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

	//Lấy các thông tin theo giá trị đơn hàng giảm
	public function modelGetTotalPrice(){
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT ord.*, SUM(ord.price), cus.* from orders as ord right JOIN customers as cus on ord.customer_id=cus.id where ord.status = 3 group by cus.id order by sum(ord.price) desc");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}

	public function modelSearchName(){
		$key = isset($_GET["search_key"]) ? $_GET["search_key"] : "";
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from customers where name like '%$key%'");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}

	public function modelSearchEmail(){
		$key = isset($_GET["search_key"]) ? $_GET["search_key"] : "";
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from customers where email like '%$key%'");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}

	public function modeGetCusstomerOrder1month(){
		$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(28)->toDateString();
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT SUM(orderdetails.price * orderdetails.quantity) as total, cus.* from orders as ord INNER JOIN customers as cus on ord.customer_id=cus.id INNER JOIN orderdetails on orderdetails.order_id = ord.id WHERE ord.status = 3 and ord.date BETWEEN '$subdays' AND now() group by cus.id order by total DESC");
		//thuc thi truy van, co truyen tham so vao cau lenh sql		
		return $query->fetchAll();
	}
}
