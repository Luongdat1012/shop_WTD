<?php
trait AccountModel
{
	public function modelRegister()
	{
		$name = $_POST["name"];
		$email = $_POST["email"];
		$address = $_POST["address"];
		$phone = $_POST["phone"];
		$password = $_POST["password"];
		$provice = $_POST['provice'];
		$district = $_POST['district'];
		$ward = $_POST['ward'];
		$village = $_POST['village'];
		//ma hoa password
		$password = md5($password);
		//---
		$conn = Connection::getInstance();
		//kiem tra neu email chua ton tai thi insert ban ghi
		$queryCheck = $conn->prepare("select email from customers where email=:var_email");
		$queryCheck->execute(["var_email" => $email]);
		if ($queryCheck->rowCount() > 0)
			header("location:index.php?controller=account&action=register&notify=error");
		else {
			$query = $conn->prepare("insert into customers set name=:var_name,email=:var_email,password=:var_password,address=:var_address,phone=:var_phone,provinceid=:var_provinceid,districtid=:var_districtid,wardid=:var_wardid,villageid=:var_villageid");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_name" => $name, "var_email" => $email, "var_password" => $password, "var_address" => $address, "var_phone" => $phone, "var_provinceid" => $provice, "var_districtid" => $district, "var_wardid" => $ward, "var_villageid" => $village]);
			header("location:index.php?controller=account&action=login");
		}
	}
	public function modelLogin()
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		//ma hoa password
		$password = md5($password);
		//---
		$conn = Connection::getInstance();
		$query = $conn->prepare("select id, email, password from customers where email=:var_email");
		$query->execute(["var_email" => $email]);
		if ($query->rowCount() > 0) {
			//lay mot ban ghi
			$result = $query->fetch();
			if ($password == $result->password) {
				$_SESSION['customer_id'] = $result->id;
				$_SESSION['customer_email'] = $result->email;
				header("location:index.php");
			} else
				header("location:index.php?controller=account&action=login");
		}
		//---
	}
	public function modelLogout()
	{
		//huy cac bien session
		unset($_SESSION["customer_id"]);
		unset($_SESSION["customer_email"]);
		header("location:index.php?controller=account&action=login");
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
}
