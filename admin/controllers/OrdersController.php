<?php
//include file model vao day

use Carbon\Carbon;

include "models/OrdersModel.php";
class OrdersController extends Controller
{
	//ke thua class OrdersModel
	use OrdersModel;
	public function index()
	{
		//quy dinh so ban ghi tren mot trang
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modelRead($recordPerPage);
		//goi view, truyen du lieu ra view
		$this->loadView("OrdersView.php", ["data" => $data, "numPage" => $numPage]);
	}
	public function detail()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = $this->modelOrdersDetail($id);
		//goi view, truyen du lieu ra view
		$this->loadView("OrdersDetailView.php", ["data" => $data, "id" => $id]);
	}
	//xac nhan da giao hang
	public function delivery()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;		
		$this->modelDelivery($id);

		header("location:index.php?controller=orders&action=index");
	}
	public function cancel()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$this->modelCancel($id);
		header("location:index.php?controller=orders");
	}
	public function status()
	{
		$status = isset($_GET["status"]) ? $_GET["status"] : 0;
		//tao bien $action de dua vao thuoc tinh $action cua the form
		$action = "index.php?controller=products&action=status&id=$status";
		//lay mot ban ghi
		$record = $this->modelSubmit($status);
		//goi view, truyen du lieu ra view
		$this->loadView("StatusView.php", ["action" => $action, "record" => $record]);
	}

	public function searchDate()
	{
		$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
		//quy dinh so ban ghi tren mot trang
		$date_start = isset($_GET['date_start']) ? $_GET['date_start'] : "";
		$date_end = isset($_GET['date_end']) && !empty($_GET['date_end']) ? $_GET['date_end'] : "$now";
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modeGetSearchDate($date_start, $date_end);
		//goi view, truyen du lieu ra view
		$this->loadView("OrdersView.php", ["data" => $data, "numPage" => $numPage]);
	}

	public function searchName()
	{
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		if (isset($_GET["option_search"]) && $_GET['option_search'] == 'order_id') {
			$data = $this->modeGetSearchOrderID();
			$this->loadView("OrdersView.php", ["data" => $data, "numPage" => $numPage]);
		} elseif (isset($_GET["option_search"]) && $_GET['option_search'] == 'name_customer') {
			$data = $this->modeGetSearchName();
			$this->loadView("OrdersView.php", ["data" => $data, "numPage" => $numPage]);
		}
	}

	public function searchPrice(){
		//quy dinh so ban ghi tren mot trang
		$priceFrom = isset($_GET['fromPrice']) ? $_GET['fromPrice'] : 0;
		$priceTo = isset($_GET['toPrice']) ? $_GET['toPrice'] : 0;
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modelSearchPrice($priceFrom, $priceTo);
		//goi view, truyen du lieu ra view
		$this->loadView("OrdersView.php", ["data" => $data, "numPage" => $numPage]);
	}

	public function ajaxStatus(){		
		if(($_GET['status'] != ""))
		include "views/AjaxStatusView.php";
		
	}
}
