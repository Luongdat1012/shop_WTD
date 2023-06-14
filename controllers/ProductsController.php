<?php
include "models/ProductsModel.php";
class ProductsController extends Controller
{
	//ke thua
	use ProductsModel;
	public function category()
	{
		$id = isset($_GET["id"]) && $_GET["id"] > 0 ? $_GET["id"] : 0;
		//quy dinh so ban ghi tren mot trang
		$recordPerPage = 18;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->modelRead($recordPerPage);
		//goi view, truyen du lieu ra view
		$this->loadView("CategoryProductsView.php", ["data" => $data, "numPage" => $numPage, "id" => $id, "recordPerPage" => $recordPerPage]);
	}
	//Lấy toàn bộ sản phẩm
	public function all()
	{

		$this->loadView("CategoryProductsView.php");
	}
	//Chi tiết sản phẩm
	public function detail()
	{
		$id = isset($_GET["id"]) && $_GET["id"] > 0 ? $_GET["id"] : 0;
		$record = $this->modelGetRecord($id);
		$sub_photo = $this->modelGetSubPhoto($id);
		$product_size = $this->modelGetProductSize($id);
		//Gọi view, truyền dữ liệu ra view.
		$this->loadView("DetailProductsView.php", ["record" => $record, "id" => $id, "sub_photo" => $sub_photo, "product_size" => $product_size]);
	}

	// Đánh số sao
	public function rating()
	{
		/* $id = isset($_GET['id']) ? $_GET["id"] : 0;
			$this->modelRating();
			//di chuyển đến trang chi tiết sản phẩm
			header("location:index.php?controller=products&action=detail&id=$id"); */
		$id = isset($_GET['id']) ? $_GET["id"] : 0;

		if (isset($_SESSION["customer_id"])) {
//			if (count($this->modelGetConditionRate($_SESSIO N["customer_id"], $id)) >= 1) {
//				$this->modelRating();
//				//di chuyển đến trang chi tiết sản phẩm
//				header("location:index.php?controller=products&action=detail&id=$id");
//			} else {
//				header("location:index.php?controller=products&action=detail&id=$id&notify=rating_err");
//			}
		} else {
			header("location:index.php?notify_confirm=login");
		}
	}

	public function demo()
	{
		$category_id = $_GET['action'];		
		$data = $this->modelSearchSize($category_id);
		$strResult = "";
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		foreach ($data as $rows) {
			$price_discount = number_format($rows->price);
			$price = number_format($rows->price - ($rows->price * $rows->discount) / 100);
			$strResult = $strResult . "
			<div class='product' id='ajax'>
				<div class='sale'>
					<span>- {$rows->discount} %</span>
				</div>
				<a href='index.php?controller=products&action=detail&id={$rows->id}'>
					<img class='product_img_fisrt' src='./assets/upload/products/{$rows->photo}' alt='' />
					<img class='product_img_last' src='./assets/upload/products/{$rows->photo}' alt='' />
					<p class='product_name'>{$rows->name};</p>
				</a>
				<div class='product_price_flex'>
					<div class='product_price'>
						<span> {$price}
							<span>đ</span>
						</span>
					</div>
					<div class='product_price_goc'>
						<span> {$price_discount}<span>đ</span></span>
					</div>
				</div>
				<p class='product_name'>
					<a href='index.php?controller=products&action=rating&id={$rows->id};&star=1'><i class='fas fa-star'></i></a>
					<a href='index.php?controller=products&action=rating&id={$rows->id};&star=2'><i class='fas fa-star'></i></a>
					<a href='index.php?controller=products&action=rating&id={$rows->id};&star=3'><i class='fas fa-star'></i></a>
					<a href='index.php?controller=products&action=rating&id={$rows->id};&star=4'><i class='fas fa-star'></i></a>
					<a href='index.php?controller=products&action=rating&id={$rows->id};&star=5'><i class='fas fa-star'></i></a>
				</p>
				<a href='index.php?controller=products&action=detail&id={$rows->id}'><button class='btn_detail'>Xem chi tiết</button></a>
			</div>
		
		";
		}
		echo $strResult;
	}
}
