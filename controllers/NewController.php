<?php
include "models/NewModel.php";
class NewController extends Controller
{
	//ke thua
	use NewModel;
    public function index(){
        //quy dinh so ban ghi tren mot trang
        $recordPerPage = 20;
        //tinh so trang
        //ham ceil(so) se lay gia tri lam tron tren cua so do. VD: ceil(3.1) = 4
        $numPage = ceil($this->modelTotalRecord()/$recordPerPage);
        //lay du lieu tu model
        $data = $this->modelRead($recordPerPage);
        //goi view, truyen du lieu ra view
        $this->loadView("NewsView.php",["data"=>$data,"numPage"=>$numPage]);
    }
    public function detail(){
        $recordPerPage = 20;
        $data = $this->modelRead($recordPerPage);
        $new = $this->modelGetRecord();
        $this->loadView("NewsDetailView.php",["new"=>$new, "data"=>$data]);
    }
	
}
