<?php
include "models/AccountModel.php";
class AccountController extends Controller
{
    use AccountModel;
    public function register()
    {
        $province = $this->modelGetProvince();
        $this->loadView("RegisterView.php",["province" => $province]);
    }
    public function registerPost()
    {
        $this->modelRegister();
        header("location:index.php?notify=register_success");
    }
    public function login()
    {
        $this->loadView("LoginView.php");
    }
    public function loginPost()
    {
        $this->modelLogin();
        header("location:index.php?notify=login_success");
    }
    public function logout()
    {
        $this->modelLogout();
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
}
