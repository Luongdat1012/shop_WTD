<?php 
	//include file model vao day
	include "models/BannersModel.php";
	class BannersController extends Controller{
		//ke thua class BannersModel
		use BannersModel;
		public function index(){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 20;
			//tinh so trang
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("BannersView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		//sua ban ghi
		public function update(){
			//lay id truyen tu url
			//is_numeric(key) tra ve true neu key la so, nguoc lai tra ve false
			//is_numeric($_GET["id"]) <=> is_numeric($_GET["id"]) == true
			//!is_numeric($_GET["id"]) <=> is_numeric($_GET["id"]) == false
			$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
			//tao bien $action de dua vao thuoc tinh $action cua the form
			$action = "index.php?controller=banners&action=updatePost&id=$id";
			//lay mot ban ghi
			$record = $this->modelGetRecord($id);
			//goi view, truyen du lieu ra view
			$this->loadView("BannersFormView.php",["action"=>$action,"record"=>$record]);
		}
		//khi an nut submit (update ban ghi)
		public function updatePost(){			
			$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham modelUpdate de update ban ghi
			$this->modelUpdate($id);
			//quay tro lai trang banners
			header("location:index.php?controller=banners");
		}
		//create
		public function create(){
			//tao bien $action de dua vao thuoc tinh $action cua the form
			$action = "index.php?controller=banners&action=createPost";
			//goi view, truyen du lieu ra view
			$this->loadView("BannersFormView.php",["action"=>$action]);
		}
		//create - sau khi an nut submit
		public function createPost(){
			//goi ham modelCreate de insert ban ghi
			$this->modelCreate();
			header("location:index.php?controller=banners");
		}
		//xoa ban ghi
		public function delete(){
			$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham modelDelete de xoa ban ghi
			$this->modelDelete($id);
			//quay tro lai trang banners
			header("location:index.php?controller=banners");
		}
	}
