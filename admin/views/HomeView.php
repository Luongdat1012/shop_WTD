<?php
//Load file Layout.php vào đây
$this->fileLayout = "Layout.php"
?>
<div class="card-body">

</div>
<div class="card">
  <div class="card-header">
    <h5 class="header-title mb-0">Thống kê đơn hàng theo: <span id="giatri_date"></span></h5>
    <div class="card-col-md" style="margin-top: 15px;">
      <div class="col-2">
      <select id="select_date" class="custom-select">
        <option value="365ngay">365 ngày qua</option>
        <option value="7ngay">7 ngày qua</option>
        <option value="28ngay">28 ngày qua</option>
        <option value="90ngay">90 ngày qua</option>
      </select>
      </div>

    </div>
  </div>

  <div class="card-body">

    <div id="char" class="morris-charts"></div>
  </div>
</div>

<!-- Load Ajax thông tin biểu đồ -->
<script>
  $(document).ready(function() {
    thongke();
    var char = new Morris.Area({

      element: 'char',

      xkey: 'date',

      ykeys: ['order', 'sales', 'quantily'],

      labels: ['Đơn hàng', 'Doanh thu', 'Số lượng bán ra']
    });
    $('#select_date').change(function() {
      var thoigian = $(this).val();
      if (thoigian == "7ngay") {
        var text = "7 ngày qua";
      } else if (thoigian == '28ngay') {
        var text = "28 ngày qua";
      } else if (thoigian == "90ngay") {
        var text = "90 ngày qua";
      } else {
        var text = "365 ngày qua";
      }

      $.ajax({
        url: "index.php?controller=thongke&action=char",
        method: "POST",
        dataType: "JSON",
        data: {
          thoigian: thoigian
        },

        success: function(data) {
          char.setData(data);
          $('#giatri_date').text(text);
        }
      });
    })

    function thongke() {
      var text = "365 ngày qua";
      $('#text_date').text(text);
      $.ajax({
        url: "index.php?controller=thongke&action=char",
        method: "POST",
        dataType: "JSON",

        success: function(data) {
          char.setData(data);
          $('#giatri_date').text(text);
        }
      })
    }
  });
</script>