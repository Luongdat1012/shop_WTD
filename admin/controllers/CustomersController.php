<?php
//include file model vao day
include "models/CustomersModel.php";
class CustomersController extends Controller
{
	//ke thua class CustomersModel
	use CustomersModel;
	public function index()
	{
		//quy dinh so ban ghi tren mot trang
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modelRead($recordPerPage);

		//goi view, truyen du lieu ra view
		$this->loadView("CustomersView.php", ["data" => $data, "numPage" => $numPage]);
	}

	//sua ban ghi
	public function update()
	{
		$province = $this->modelGetProvince();
		//lay id truyen tu url
		//is_numeric(key) tra ve true neu key la so, nguoc lai tra ve false
		//is_numeric($_GET["id"]) <=> is_numeric($_GET["id"]) == true
		//!is_numeric($_GET["id"]) <=> is_numeric($_GET["id"]) == false
		$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
		//tao bien $action de dua vao thuoc tinh $action cua the form
		$action = "index.php?controller=customers&action=updatePost&id=$id";
		//lay mot ban ghi
		$data = $this->modelGetRecord($id);
		//goi view, truyen du lieu ra view
		$this->loadView("CustomersFormView.php", ["action" => $action, "data" => $data, "province" => $province]);
	}
	//Chi tiết khách hàng
	public function detail()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 1;
		$customer = $this->modelGetRecord($id);
		$totalPrice = $this->modelGetTotalCustomer($id);
		$total = 0;
		foreach ($totalPrice as $price) {
			$total += $price->price;
		}
		$order = $this->modelGetOrder($id);
		$this->loadView("CustomersDetail.php", ["customer" => $customer, "totalPrice" => $total, "order" => $order]);
	}

	//khi an nut submit (update ban ghi)
	public function updatePost()
	{
		$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
		//goi ham modelUpdate de update ban ghi
		$this->modelUpdate($id);
		//quay tro lai trang customers
		header("location:index.php?controller=customers");
	}
	//create
	public function create()
	{
		$province = $this->modelGetProvince();
		//tao bien $action de dua vao thuoc tinh $action cua the form
		$action = "index.php?controller=customers&action=createPost";
		//goi view, truyen du lieu ra view
		$this->loadView("CustomersFormView.php", ["action" => $action, "province" => $province]);
	}
	//create - sau khi an nut submit
	public function createPost()
	{
		//goi ham modelCreate de insert ban ghi
		$this->modelCreate();
		header("location:index.php?controller=customers");
	}
	//xoa ban ghi
	public function delete()
	{
		$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
		//goi ham modelDelete de xoa ban ghi
		$this->modelDelete($id);
		//quay tro lai trang customers
		header("location:index.php?controller=customers");
	}
	public function ajaxSearchDistrict()
	{
		//echo "<h1>Controller = SearchController, action = ajaxSearch</h1>";			
		$districtid = isset($_GET['provinceid']) ? $_GET['provinceid'] : 0;
		$data = $this->modelGetDistrict($districtid);
		$strResult = "";
		foreach ($data as $rows) {
			$strResult = $strResult . '<option value="' . $rows->districtid . '">' . $rows->name . '</option>';
		}
		echo $strResult;
	}
	public function ajaxSearchWard()
	{
		//echo "<h1>Controller = SearchController, action = ajaxSearch</h1>";
		$ward = isset($_GET['districtid']) ? $_GET['districtid'] : 0;
		$data = $this->modelGetWard($ward);
		$strResult = "";
		foreach ($data as $rows) {

			$strResult = $strResult . '<option value="' . $rows->wardid . '">' . $rows->name . '</option>';
		}
		echo $strResult;
	}

	public function ajaxSearchVillage()
	{
		//echo "<h1>Controller = SearchController, action = ajaxSearch</h1>";
		$village = isset($_GET['wardid']) ? $_GET['wardid'] : 0;
		$data = $this->modelGetVillage($village);
		$strResult = "";
		foreach ($data as $rows) {
			$strResult = $strResult . '<option value="' . $rows->villageid . '">' . $rows->name . '</option>';
		}
		echo $strResult;
	}

	public function orderList()
	{
		//quy dinh so ban ghi tren mot trang
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modelGetTotalPrice();
		//goi view, truyen du lieu ra view
		$this->loadView("CustomersView.php", ["data" => $data, "numPage" => $numPage]);
	}

	public function search()
	{
		//quy dinh so ban ghi tren mot trang
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);

		if (isset($_GET['option_search']) && $_GET['option_search'] == 'name_customer') {
			//lay du lieu tu model
			$data = $this->modelSearchName();
			//goi view, truyen du lieu ra view
			$this->loadView("CustomersView.php", ["data" => $data, "numPage" => $numPage]);
		} elseif (isset($_GET['option_search']) && $_GET['option_search'] == 'email_customer') {
			//lay du lieu tu model
			$data = $this->modelSearchEmail();
			//goi view, truyen du lieu ra view
			$this->loadView("CustomersView.php", ["data" => $data, "numPage" => $numPage]);
		}
	}

	public function order1month(){
		//quy dinh so ban ghi tren mot trang
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modeGetCusstomerOrder1month();
		//goi view, truyen du lieu ra view
		$this->loadView("CustomersView.php", ["data" => $data, "numPage" => $numPage]);
	}
}
