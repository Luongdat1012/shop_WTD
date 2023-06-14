<?php
//include file model vao day

use Carbon\Carbon;

include "models/ThongKeModel.php";
class ThongKeController extends Controller
{
    //ke thua class ThongKeModel
    use ThongKeModel;
    public function index()
    {
        //quy dinh so ban ghi tren mot trang
        $recordPerPage = 20;
        //tinh so trang
        $numPage = ceil($this->modelTotalRecord() / $recordPerPage);
        //lay du lieu tu model
        $data = $this->modelRead($recordPerPage);       
        

        //goi view, truyen du lieu ra view
        $this->loadView("ThongKeView.php", ["data" => $data, "numPage" => $numPage]);
    }
    public function update()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $donhang = count($this->modelGetCountOrder($now));
        $doanhthu = $this->modelGetOrderSubmit($now);
        //Tính tổng doanh thu của ngày hôm đó.
        $total = 0;
        foreach ($doanhthu as $product) {
            $total += $product->price;
        }

        if ($this->modelGetCountThongKe($now) == 0) {
            $this->modelInsertThongKe($donhang, $total, $now);
        } elseif ($this->modelGetCountThongKe($now) != 0) {
            $this->modelUpdateThongKe($donhang, $total, $now);
        }

        header("location:index.php?controller=thongKe");
    }
    public function char()
    {
        if (isset($_POST['thoigian'])) {
            $thoigian = $_POST['thoigian'];
        } else {
            $thoigian = "";
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        }

        if ($thoigian == '7ngay') {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        } else if ($thoigian == '28ngay') {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(28)->toDateString();
        } else if ($thoigian == '90ngay') {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(90)->toDateString();
        } else if ($thoigian == '365ngay') {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $demo = $this->modelThongKe($subdays, $now);

        foreach ($demo as $rows) {
            $ngaydat = $rows->ngaydat;
            $donhang = $rows->donhang;
            $doanhthu = $rows->doanhthu;
            $soluongban = $rows->soluongban;
            $char_data[] = array(
                'date' => $ngaydat,
                'order' => $donhang,
                'sales' => $doanhthu,
                'quantily' => $soluongban

            );
        }
        echo $data = json_encode($char_data);
    }

    public function detail()
    {
        $date = isset($_GET['ngaydat']) ? $_GET['ngaydat'] : "";
        //quy dinh so ban ghi tren mot trang
        $recordPerPage = 20;
        $thongke = $this->modelGetOrderDetail($date, $recordPerPage);       
        //tinh so trang
        $numPage = ceil($this->modelTotalOrderDetail($date) / $recordPerPage);

        $this->loadView("ThongKeDetailView.php", ["thongke" => $thongke, "numPage" => $numPage]);
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
		$this->loadView("ThongKeView.php", ["data" => $data, "numPage" => $numPage]);
	}
}
