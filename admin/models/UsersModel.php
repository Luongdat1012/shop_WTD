<?php
trait UsersModel
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
		$query = $conn->query("select users.*, roles.name_role from users inner join roles on users.role = roles.role order by id desc limit $from, $recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	//tinh tong so ban ghi
	public function modelTotalRecord()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from users");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//lay mot ban ghi tuong ung voi id truyen vao
	public function modelGetRecord($id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->prepare("select users.*, roles.name_role from users inner join roles on users.role = roles.role where users.id= :var_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_id" => $id]);
		//tra ve mot ban ghi
		return $query->fetch();
	}
	public function modelUpdate($id)
	{
		$name = $_POST["name"];
		$password = $_POST["password"];
		$chucvu = $_POST['chucvu'];
		$role_product = isset($_POST["role_product"]) ? 1 : 0;
		$role_user = isset($_POST["role_user"]) ? 1 : 0;
		$role_banner = isset($_POST["role_banner"]) ? 1 : 0;
		$role_new = isset($_POST["role_new"]) ? 1 : 0;
		$role_category = isset($_POST["role_category"]) ? 1 : 0;
		$role_thongke = isset($_POST["role_thongke"]) ? 1 : 0;
		$role_order = isset($_POST["role_order"]) ? 1 : 0;
		$role_create = isset($_POST["role_create"]) ? 1 : 0;
		$role_fix = isset($_POST["role_fix"]) ? 1 : 0;
		//update name
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->prepare("update users set name = :var_name, chucvu ='$chucvu' where id = :var_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_name" => $name, "var_id" => $id]);

		$conn->query("UPDATE `role` SET `role_categories`='$role_category',`role_news`='$role_new',`role_product`='$role_product',`role_banner`='$role_banner',`role_create`='$role_create',`role_fix`='$role_fix',`role_order`='$role_order',`role_user`='$role_user',`role_thongke`='$role_thongke' WHERE id_user = $id");
		//neu password khong rong thi update password
		if ($password != "") {
			//ma hoa password
			$password = md5($password);
			//thuc hien truy van
			$query = $conn->prepare("update users set password = :var_password where id = :var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_password" => $password, "var_id" => $id]);
		}
		if ($query) {
			$_SESSION['notify_update'] = 'Cập nhật thành công';
		} else {
			$_SESSION['notify_update'] = 'Lỗi không cập nhật được';
		}
	}
	public function modelCreate()
	{
		$name = $_POST["name"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$role_product = isset($_POST["role_product"]) ? 1 : 0;
		$role_user = isset($_POST["role_user"]) ? 1 : 0;
		$role_banner = isset($_POST["role_banner"]) ? 1 : 0;
		$role_new = isset($_POST["role_new"]) ? 1 : 0;
		$role_category = isset($_POST["role_category"]) ? 1 : 0;
		$role_thongke = isset($_POST["role_thongke"]) ? 1 : 0;
		$role_order = isset($_POST["role_order"]) ? 1 : 0;
		$role_create = isset($_POST["role_create"]) ? 1 : 0;
		$role_fix = isset($_POST["role_fix"]) ? 1 : 0;
		$chucvu = $_POST['chucvu'];
		//ma hoa password
		$password = md5($password);
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//kiem tra xem email co trung voi email da co trong csdl khong
		$queryEmail = $conn->prepare("select email from users where email=:var_email");
		$queryEmail->execute(["var_email" => $email]);
		if ($queryEmail->rowCount() == 0) {
			//chuan bi truy van
			$query = $conn->prepare("insert into users set name=:var_name,email=:var_email,password=:var_password, chucvu = '$chucvu'");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_name" => $name, "var_email" => $email, "var_password" => $password]);
			$id = $conn->lastInsertId();
			$conn->query("INSERT INTO `role`( `user_email`, `role_categories`, `role_news`, `role_product`, `role_banner`, `role_create`, `role_fix`, `role_order`, `role_user`, `role_thongke`, `id_user`) VALUES ('$email','$role_category','$role_new','$role_product','$role_banner','$role_create','$role_fix','$role_order','$role_user','$role_thongke', '$id')");
			if($query){
				$_SESSION['notify_success'] = 'Thêm mới thành công';
			}else{
				$_SESSION['notify_success'] = 'Lỗi không thêm được';
			}
			header("location:index.php?controller=users");
		} else
			header("location:index.php?controller=users&action=create&notify=email-exists");
	}
	public function modelDelete($id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->prepare("delete from users where id = :var_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_id" => $id]);
		$conn->query("delete from role where id_user = $id");
		if($query){
			$_SESSION['notify_delete'] = 'Xóa thành công thành công';
		}else{
			$_SESSION['notify_delete'] = 'Lỗi không xóa được ';
		}
	}
	//Phân quyền tài khoản.
	public function modelGetRoles($id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from role where id_user = $id");
		//Trả về kết quả
		return $query->fetch();
	}
}
