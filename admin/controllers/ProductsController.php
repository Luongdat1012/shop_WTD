<?php
//include file model vao day

include "models/ProductsModel.php";

use Carbon\Carbon;

class ProductsController extends Controller
{
	//ke thua class ProductsModel
	use ProductsModel;
	public function index()
	{
		//quy dinh so ban ghi tren mot trang
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modelRead($recordPerPage);
		//goi view, truyen du lieu ra view
		$this->loadView("ProductsView.php", ["data" => $data, "numPage" => $numPage]);
	}
	//sua ban ghi
	public function update()
	{
		//lay id truyen tu url
		//is_numeric(key) tra ve true neu key la so, nguoc lai tra ve false
		//is_numeric($_GET["id"]) <=> is_numeric($_GET["id"]) == true
		//!is_numeric($_GET["id"]) <=> is_numeric($_GET["id"]) == false
		$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
		//tao bien $action de dua vao thuoc tinh $action cua the form
		$action = "index.php?controller=products&action=updatePost&id=$id";
		//lay mot ban ghi
		$size = $this->modelGetSizeProduct($id);
		$record = $this->modelGetRecord($id);
		$image = $this->modelGetSubPhoto($id);
		//goi view, truyen du lieu ra view
		$this->loadView("ProductsFormView.php", ["action" => $action, "record" => $record, "image" => $image, "size" => $size]);
	}
	//update ban ghi
	public function updatePost()
	{
		$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
		//goi ham modelUpdate de update ban ghi
		$this->modelUpdate($id);
		//quay tro lai trang products
		header("location:index.php?controller=products");
	}
	//create
	public function create()
	{
		//tao bien $action de dua vao thuoc tinh $action cua the form
		$action = "index.php?controller=products&action=createPost";
		$size[] = "";
		//goi view, truyen du lieu ra view
		$this->loadView("ProductsFormView.php", ["action" => $action, "size" => $size]);
	}
	//createPost
	public function createPost()
	{
		//goi ham modelCreate de insert ban ghi
		$this->modelCreate();
		header("location:index.php?controller=products");
	}
	//xoa ban ghi
	public function delete()
	{
		$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
		//goi ham modelDelete de xoa ban ghi
		$this->modelDelete($id);
		//quay tro lai trang products
		header("location:index.php?controller=products");
	}

	public function hotSale()
	{
		//quy dinh so ban ghi tren mot trang
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modelGetSaleProduct();

		//goi view, truyen du lieu ra view
		$this->loadView("ProductsView.php", ["data" => $data, "numPage" => $numPage]);
	}

	public function hotSaleDay()
	{
		if (isset($_GET['days']) && $_GET['days'] == 'index.php') {
			header("location:index.php?controller=products");
		} else {
			$days = isset($_GET['days']) ? $_GET['days'] : "7days";
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 20;
			//tinh so trangs
			$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
			//lay du lieu tu model
			$data = $this->modelGetSaleProductDay($days);
			//goi view, truyen du lieu ra view
			$this->loadView("ProductsView.php", ["data" => $data, "numPage" => $numPage]);
		}
	}

	public function search(){
		if(isset($_GET['option_search']) && $_GET['option_search'] == 'name_product'){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 20;
			//tinh so trangs
			$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
			//lay du lieu tu model
			$data = $this->modeGetSearchName();
			//goi view, truyen du lieu ra view
			$this->loadView("ProductsView.php", ["data" => $data, "numPage" => $numPage]);
		}elseif(isset($_GET['option_search']) && $_GET['option_search'] == 'id_product'){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 20;
			//tinh so trangs
			$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
			//lay du lieu tu model
			$data = $this->modeGetSearchProductsID();
			//goi view, truyen du lieu ra view
			$this->loadView("ProductsView.php", ["data" => $data, "numPage" => $numPage]);
		}elseif(isset($_GET['option_search']) && $_GET['option_search'] == 'category_product'){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 20;
			//tinh so trangs
			$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
			//lay du lieu tu model
			$data = $this->modelGetSearchNameCategory();
			//goi view, truyen du lieu ra view
			$this->loadView("ProductsView.php", ["data" => $data, "numPage" => $numPage]);
		}
	}

	public function searchPrice(){
		$priceFrom = isset($_GET['fromPrice']) ? $_GET['fromPrice'] : 0;
		$priceTo = isset($_GET['toPrice']) ? $_GET['toPrice'] : 0;
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modelGetSearchPrice($priceFrom, $priceTo);
		//goi view, truyen du lieu ra view
		$this->loadView("ProductsView.php", ["data" => $data, "numPage" => $numPage]);
	}

	public function searchCategory()
	{
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modelGetProductCategory();
		//goi view, truyen du lieu ra view
		$this->loadView("ProductsView.php", ["data" => $data, "numPage" => $numPage]);
	}
}
