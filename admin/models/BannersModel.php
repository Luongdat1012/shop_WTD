<?php 
	trait BannersModel{
		//lay ve danh sach cac ban ghi
		public function modelRead($recordPerPage){
			//lay bien page truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from banners order by id desc limit $from, $recordPerPage");
			//tra ve nhieu ban ghi
			return $query->fetchAll();
		}
		//tinh tong so ban ghi
		public function modelTotalRecord(){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from banners");
			//tra ve so luong ban ghi
			return $query->rowCount();
		}
		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord($id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->prepare("select * from banners where id = :var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id]);
			//tra ve mot ban ghi
			return $query->fetch();
		}
        //Sửa bản ghi
		public function modelUpdate($id){
			$name = $_POST["name"];			
			$view = isset($_POST["hot"]) ? 1 : 0;				
			//update name
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->prepare("update banners set name = :var_name,view=:var_view where id = :var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_name"=>$name,"var_id"=>$id,"var_view"=>$view]);
			//---
			//neu user upload anh thi thuc hien upload
			$photo = "";
			if($_FILES['photo']['name'] != ""){
				//---
				//lay anh cu de xoa
				$oldPhoto = $conn->query("select photo from banners where id=$id");
				if($oldPhoto->rowCount() > 0){
					$record = $oldPhoto->fetch();
					//xoa anh
					if($record->photo != "" && file_exists("../assets/upload/banners/".$record->photo)){
						//xoa anh
						unlink("../assets/upload/banners/".$record->photo);
					}
				}
				//---
				$photo = time()."_".$_FILES['photo']['name'];
				//upload file vao thuc muc upload/banners
				move_uploaded_file($_FILES['photo']['tmp_name'], "../assets/upload/banners/$photo");
				$query = $conn->prepare("update banners set photo=:var_photo where id=:var_id");
				$query->execute(["var_photo"=>$photo,"var_id"=>$id]);
			}			
			//---
			if($query){
				$_SESSION['notify_update'] = 'Cập nhật thành công';
			}else{
				$_SESSION['notify_update'] = 'Lỗi không cập nhật được';
			}
		}
        //Tạo mới
		public function modelCreate(){
			$name = $_POST["name"];
			$view = isset($_POST["hot"]) ? 1 : 0;
			//---
			//neu user upload anh thi thuc hien upload
			$photo = "";
			if($_FILES['photo']['name'] != ""){
				$photo = time()."_".$_FILES['photo']['name'];
				//upload file vao thuc muc upload/banners
				move_uploaded_file($_FILES['photo']['tmp_name'], "../assets/upload/banners/$photo");
			}
			//---
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->prepare("insert into banners set name = :var_name,view=:var_view,photo=:var_photo");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_name"=>$name,"var_view"=>$view,"var_photo"=>$photo]);
			if($query){
				$_SESSION['notify_success'] = 'Thêm mới thành công';
			}else{
				$_SESSION['notify_success'] = 'Lỗi không thêm được';
			}
			header("location:index.php?controller=banners");
		}
        //Xóa các bản ghi
		public function modelDelete($id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//---
			//lay anh cu de xoa
			$oldPhoto = $conn->query("select photo from banners where id=$id");
			if($oldPhoto->rowCount() > 0){
				$record = $oldPhoto->fetch();
				//xoa anh
				if($record->photo != "" && file_exists("../assets/upload/banners/".$record->photo)){
					//xoa anh
					unlink("../assets/upload/banners/".$record->photo);
				}
			}
			//---
			//thuc hien truy van
			$query = $conn->prepare("delete from banners where id = :var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id]);
			if($query){
				$_SESSION['notify_delete'] = 'Xóa thành công thành công';
			}else{
				$_SESSION['notify_delete'] = 'Lỗi không xóa được ';
			}
		}
		
	}
