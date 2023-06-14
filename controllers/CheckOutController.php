<?php
include "models/CheckOutModel.php";
class CheckOutController extends Controller
{
	//ke thua
	use CheckOutModel;
	public function index()
	{
		if (isset($_SESSION['customer_email']) == false)
			//header("location:index.php?controller=account&action=login");
			header("location:index.php?notify_confirm=login");
		else {
			$data = $this->modelGetCustomers();
			$province = $this->modelGetProvince();
			$this->loadView("CheckOutView.php", ["province" => $province, "data" => $data]);			
		}
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
	//thanh toan giỏ hàng
	public function inhoadon()
	{		
		$this->modelCheckOutCart();
		header("location:index.php?notify=success_checkout");
	}

	//Thanh toán đơn hàng
	public function thanhToanDonHang(){
		$this->modelCheckOutProduct();
		header("location:index.php?notify=success_checkout");
	}
	// Thanh toán trực tiếp sản phẩm
	public function checkOutProduct(){
		if (isset($_SESSION['customer_email']) == false)
			//header("location:index.php?controller=account&action=login");
			header("location:index.php?notify_confirm=login");
		else {
			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$size = isset($_GET['size']) ? $_GET['size'] : "";
			$data = $this->modelGetCustomers();
			$province = $this->modelGetProvince();
			$product = $this->modelGetProduct($id);
			$this->loadView("CheckOutView.php", ["province" => $province, "data" => $data, "product"=>$product, "size" => $size]);			
		}
	}
	
}
