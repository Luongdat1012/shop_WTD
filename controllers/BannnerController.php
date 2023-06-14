<?php 
	//include file model vao day
	include "models/BannersModel.php";
	class BannersController extends Controller{
		//ke thua class BannersModel
		use BannersModel;
		public function index(){
			$this->modelGetRecord();
		}
		
	}
