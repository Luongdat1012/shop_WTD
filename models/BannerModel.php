<?php 
	trait BannersModel{
		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord(){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->prepare("select * from banners");
			//thuc thi truy van, co truyen tham so vao cau lenh sql			
			return $query->fetchAll();
		}
        	
	}
