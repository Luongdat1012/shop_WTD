<?php 
	include "models/WishlistModel.php";
	class WishlistController extends Controller{
		//ke thua model
		use WishlistModel;
		//ham tao
		public function __construct(){
			//kiem tra xem session wishlist da ton tai chua, neu chua thi khoi tao
			if(isset($_SESSION['wishlist']) == false)
				$_SESSION['wishlist'] = array();
		}
		public function create(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$product = $this->modelGetRecord($id);			
			//them san pham vao gio hang
			if(isset($_SESSION['wishlist'][$id]) == false){				
		        //---		        
		        $_SESSION['wishlist'][$id] = array(
		            'id' => $id,
		            'name' => $product->name,
		            'photo' => $product->photo,
		            'price' => $product->price,
		            'discount' => $product->discount
		        );
		    }
		    header("location:index.php?controller=wishlist");
		}
		public function index(){
			$this->loadView("WishlistView.php");
		}
		public function delete(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			unset($_SESSION['wishlist'][$id]);
			header("location:index.php?controller=wishlist");
		}
	}
 ?>