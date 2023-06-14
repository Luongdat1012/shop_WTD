<?php
include "models/SearchModel.php";
class SearchController extends Controller
{
    //Kế thừa searchModel.
    use SearchModel;
    public function name()
    {
        $key = isset($_GET['key']) ? $_GET['key'] : "";
        //Quy định số bản ghi trên một trang
        $recordPerPage = 18;
        // tinh so ban ghi
        $numPage = ceil($this->modelTotalRecord() / $recordPerPage);

        $data = $this->modelRead($recordPerPage);

        $this->loadView("SearchNameView.php", ["data" => $data, "numPage" => $numPage, "key" => $key]);
    }

    public function price()
    {
        $fromPrice = isset($_GET['fromPrice']) ? $_GET['fromPrice'] : "";
        $toPrice = isset($_GET['toPrice']) ? $_GET['toPrice'] : "";
        //Quy định số bản ghi trên một trang
        $recordPerPage = 20;
        // tinh so ban ghi
        $numPage = ceil($this->modelTotalRecordSearchPrice() / $recordPerPage);
        
        $data = $this->modelReadSearchPrice($recordPerPage);

        $this->loadView("SearchPriceView.php", ["data" => $data, "numPage" => $numPage, "fromPrice"=>$fromPrice, "toPrice"=>$toPrice]);
    }

    public function ajaxSearch(){
        //echo "<h1>Controller = SearchController, action = ajaxSearch</h1>";
        $data = $this->modelAjaxSearch();
        $strResult = "";
        foreach ($data as $rows) {
            $strResult = $strResult."<li><img src='assets/upload/products/{$rows->photo}'><a href='index.php?controller=products&action=detail&id={$rows->id}'>{$rows->name}</a></li>";
        }
        echo $strResult;
    }
    
}
